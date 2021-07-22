<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Firewall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $retcode = 404;
    protected const LOCK_TIME = 5;

    public function checkAuthCode(Request $request)
    {
        $type = $request->request->get('type');
        $key = base64_decode($request->request->get('keyhash'));

        if (Cache::has($key)) {                                 // Checking presence of the key in our cache
            $user = Cache::pull($key);

            if ($user != null) {                          // All the next actions for true user only
                switch (strtolower($type)) {
                    case 'authentication':
                        $session = $request->session();
                        $this->prepareSession($user, $session);
                        return redirect()->route('cms.root');
                    default:
                }
                dd($user);
            }
        }

        abort(404);
    }

    public function authConfirm(Request $request)
    {
        $_response = [];
        $auth_type = $request->request->get('auth_type');
        $key = base64_decode($request->request->get('keyhash'));

        if (Cache::has($key)) {
            $user = Cache::pull($key);

            if ($user != null) {
                switch (strtolower($auth_type)) {
                    case 'login':
                        if (md5($request->request->get('keyhash') . $user['passhash']) == $request->request->get('passw')) {
                            $session = $request->session();
                            $this->prepareSession($user, $session);
                            $_response['retcode'] = 304;
                            $_response['cms_redirect'] = base64_encode(route('cms.root'));
                        } else {
                            $user['tries'] -= 1;
                            if ($user['tries']) {
                                $key_hash = Hash::make(microtime(true), ['rounds' => 14]);
                                $this->setCache($user, $key_hash);
                                $authtypes = $user['authtype'];
                                $tries = $user['tries'];
                                $_response['message_panel'] = view('services.auth_pass_wrong', compact([
                                    'authtypes',
                                    'tries',
                                    'key_hash'
                                ]))->render();
                            } else {
                                $ltm = $this::LOCK_TIME;
                                $user_model = User::valid()->find($user['id']);

                                DB::table('users')
                                    ->where('id', '=', $user_model->id)
                                    ->update([
                                        'locked_till' => DB::raw("DATE_ADD(NOW(), INTERVAL {$ltm} MINUTE)"),
                                        'updated_at' => DB::raw("NOW()")
                                ]);

                                $_response['message_panel'] = view('services.user_locked', compact([
                                    'ltm'
                                ]))->render();
                            }

                            $_response['retcode'] = 200;
                        }

                        break;
                    case 'email':
                        $key_hash = Hash::make(microtime(true), ['rounds' => 14]);
                        $this->setCache($user, $key_hash);
                        $this->sendMail($user, $key_hash);
                        $_response['retcode'] = 200;
                        $_response['message_panel'] = view('services.auth_mail_sent')->render();
                        break;
                }
            }
        }

        return response()->json($_response);
    }

    public function listenRequest(Request $request)
    {
        $_response = [];

        if ($request->method() == 'POST') {
            if ($request->session()->has('user')) {
                $_response['message_panel'] = view('services.auth_already_exists')->render();
                $this->retcode = 200;
            } elseif (User::valid()->count() > 0) {
                $fwl = $this->checkFirewall();
                if ($fwl['bitmask'] && $fwl['authtype']) {
                    $user = $this->pickUser($request, $fwl);
                    if ($user && $user['authtype']) {
                        $key_hash = Hash::make(microtime(true), ['rounds' => 14]);
                        $this->setCache($user, $key_hash);
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
                    'locked_till',
                    'status',
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

    private function setCache(&$user, $key)
    {
        $expiresAt = now()->addMinutes(3);
        Cache::put($key, $user, $expiresAt);
    }

    private function prepareSession(&$user_array, $session)
    {
        $user = $user_array->only([
            'id',
            'name',
            'email',
            'bip',
            'userdir'
        ]);

        $session->put('user', $user);
    }

    private function checkFirewall()
    {
        return Firewall::scan();
    }

    protected function sendMail($user, $key)
    {
        Mail::send('services.auth_request', ['user' => $user, 'key' => $key], function ($message) use ($user) {
            $message->from(config('mail.from')['address'], config('mail.from')['name']);
            $message->to($user['email']);
            $message->subject(trans('auth.auth_ref', [], 'ru'));
        });
    }

    public function logoff(Request $request)
    {
        if ($request->session()->exists('user')) {
            $request->session()->forget('user');
        }

        return redirect()->route('guest.lvl1.sections');
    }

}
