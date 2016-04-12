<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Config;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use App\OAuth\Component;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToProvider()
    {
        // TODO: Oauthドライバー名が固定されている
        $driver = Socialite::driver('google');
        $domain = Config::get('services.google.apps_domain');
        if ($domain != '') {
            $driver->with(['hd' => $domain]);
        }
        return $driver->redirect();
    }

    public function callbackFromProvider(Request $request, Guard $auth)
    {
        // TODO: Oauthドライバー名が固定されている
        $component = Component::factory('google');

        $user = User::query()->where('email', '=', $component->getEmail())->first();
        if ( is_null($user) ) {
            $user = User::create([
                'name' => $component->getName(),
                'email' => $component->getEmail(),
                'password' => password_hash('password', CRYPT_BLOWFISH),
            ]);
            $user->save();
        }
        $auth->login($user);
        return redirect('/dashboard');
    }
}
