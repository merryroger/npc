<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Firewall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $retcode = 404;

    public function listenRequest(Request $request)
    {
        $_response = [];

        if ($request->method() == 'POST') {
            if ($request->session()->has('user')) {

            } elseif (User::valid()->count() > 0) {
                $fwl = $this->checkFirewall();
                if ($fwl['bitmask'] && $fwl['authtype']) {
                    $user = $this->pickUser($request, $fwl);
                    if ($user && $user['authtype']) {
                        $key_hash = Hash::make(microtime(true), ['rounds' => 14]);
                        $this->setCache($user['id'], $key_hash);
                        if (count($user['authtype']) == 1 && in_array('email', $user['authtype'])) {
                            $this->sendMail($user, $key_hash);
                            $_response['message_panel'] = view('services.auth_mail_sent')->render();
                        } else {
                            $authtypes = $user['authtype'];
                            $_response['message_panel'] = view('services.auth_type_selector', compact([
                                'authtypes',
                                'key_hash'
                            ]))->render();
                        }

                        $this->retcode = 200;
                    }
                } else {
                    $this->retcode = 406; // No auth conditions found
                }
            }
        } else {
            $this->retcode = 405; // Wrong request method
        }

        $_response['retcode'] = $this->retcode;

        return response()->json($_response);
    }

    private function pickUser($request, $fwl)
    {
        $users = User::valid()->byCheckHash($request->request->get('cd'), $request->request->get('_token'))->applyFirewall($fwl['bitmask'])->get();
        if ($users) {
            return $users->reduce(function ($carry = [], $item) use ($fwl) {
                $item->bip &= $fwl['bitmask'];
                $authtypes = preg_split("/,/", $fwl['authtype']);
                $_authtypes = [];

                foreach ($authtypes as $authtype) {
                    switch (strtolower($authtype)) {
                        case 'login':
                            if ($item->passhash != null)
                                $_authtypes[] = $authtype;
                            break;
                        case 'email':
                            if ($item->email)
                                $_authtypes[] = $authtype;
                            break;
                    }
                }

                $item->authtype = $_authtypes;

                $item = collect($item)->except([
                    'checkhash',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]);

                return $item;
            });
        } else {
            return null;
        }
    }

    private function setCache($userId, $key) {
        $expiresAt = now()->addMinutes(3);
        Cache::put($key, $userId, $expiresAt);
    }

    private function checkFirewall()
    {
        return Firewall::scan();
    }

}
