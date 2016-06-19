<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
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
            'nombre' => 'required|max:30',
            'apellidos' => 'required|max:60',
            'telefono' => 'required|max:15',
            'email' => 'required|email|max:255|unique:usuario',
            'password' => 'required|min:6|confirmed',
            'fechaNacimiento' => 'required|max:10',
            'sexo' => 'required|max:1',
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
        $user = User::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'fechaNacimiento' => $data['fechaNacimiento'],
            'sexo' => $data['sexo'],
        ]);

        /*Mail::raw('prueba', function($message) use ($user){
            $message->from(env('CONTACT_MAIL'), env('MAIL_NAME'));

            $message->to($user->email, $user->nombre);

            $message->subject('Registro exitoso');

        });*/

         return $user;

    }
}
