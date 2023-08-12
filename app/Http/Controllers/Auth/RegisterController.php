<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::LOGIN;

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
            'nombreusuario' => ['required', 'string', 'max:50', 'unique:usuario'],
            'fechanacimiento' => ['required', 'string', 'date'],
            'contrasena' => ['required', 'string', 'min:8'],
            'paisresidencia' => ['required','string','max:50'],
            'tiposuscripcion' => ['required','string','max:50'],
        ],[
            'nombreusuario.unique'=>'Este nombre de usuario ya esta registrado',
            'nombreusuario.required'=>'El usuario es requerido',
            'nombreusuario.max'=>'El usuario no debe tener mas de 50 caracteres',
            'fechanacimiento.required'=>'La fecha de nacimiento es requerida',
            'fechanacimiento.date'=>'La fecha de nacimiento debe ser de tipo fecha',
            'contrasena.required'=>'El contraseña es requerida',
            'contrasena.min'=>'La contraseña debe tener al menos 8 caracteres',
            'paisresidencia.required'=>'El pais de residencia es requerido',
            'paisresidencia.max'=>'El pais de residencia no debe tener mas de 50 caracteres',
            'tiposuscripcion.required'=>'El Tipo de suscripción es requerido',
            'tiposuscripcion.max'=>'El tipo de suscripción no debe tener mas de 50 caracteres',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombreusuario' => $data['nombreusuario'],
            'fechanacimiento' =>date("Y-m-d H:i:s", strtotime($data['fechanacimiento'])),
            'fecharegistro' => date("Y-m-d H:i:s"),
            'paisresidencia' => $data['paisresidencia'],
            'tiposuscripcion' => $data['tiposuscripcion'],
            'contrasena' => bcrypt($data['contrasena']),
        ]);
    }
}
