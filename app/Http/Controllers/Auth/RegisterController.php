<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|max:100|confirmed',
        ],[
            'name.required' => 'O campo Nome é obrigatório.',
            'name.max' => 'O campo Nome deve ter no máximo :max caracteres.',
            'name.min' => 'O campo Nome deve ter no mínimo :min caracteres.',

            'email.required' => 'O campo E-mail é obrigatório.',
            'email.max' => 'O campo E-mail deve ter no máximo :max caracteres.',
            'email.unique' => 'Este E-mail já está em uso. Tente outro.',
            'email.email' => 'O E-mail deve ser um endereço de e-mail válido.',

            'password.required' => 'O campo Senha é obrigatório.',
            'password.max' => 'O campo Senha deve ter no máximo :max caracteres.',
            'password.min' => 'O campo Senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'Essas senhas não coincidem.',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
