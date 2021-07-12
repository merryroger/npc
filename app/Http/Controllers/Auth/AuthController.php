<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Firewall;
use App\Models\User;
use Illuminate\Http\Request;

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
                    if ($user && $user['email']) {
                        
                        $_response['user'] = $user;
                    }
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
                $item->authtype = $fwl['authtype'];

                $item = collect($item)->except([
                    'passhash',
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

    private function checkFirewall()
    {
        return Firewall::scan();
    }

}
