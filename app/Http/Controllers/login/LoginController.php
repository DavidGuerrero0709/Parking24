<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRetrieveRequest;
use App\Http\Requests\ValidateCredentialsRequest;
use App\Mail\RetrievePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCredentials(ValidateCredentialsRequest $request, Redirector $redirect)
    {
        
        $credentials = $request->validated();
        $remember = $request->filled('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $redirect->intended('home')->with('status', 'Bienvenido, ahora podra iniciar con su proceso diario');
        }
        
        throw ValidationException::withMessages([
            'email'  =>  __('auth.failed')
        ]);
        
    }

    public function logOutSession(Request $request, Redirector $redirect)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $redirect->to('/')->with('status', 'Usted finalizo su sesion');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function retrievePassword(EmailRetrieveRequest $request, Redirector $redirect)
    {
        $validate = $request->validated();
        $user = User::where('email', $request->email)->get();
        $password = rand(5, 500000000);
        $passwordEncrypted = Hash::make($password);

        User::where('email', $request->email)->update([ 'password'  =>  $passwordEncrypted ]);

        $mailData = [ 
            'title'    => 'Recuperar Contraseña', 
            'name'     =>  $user[0]->name. ' '. $user[0]->last_name, 
            'email'    =>  $user[0]->email,
            'password' =>  $password
        ];

        if ($user->count() > 0) {
            Mail::to($request->email)->send(new RetrievePassword($mailData));
            return $redirect->to('/')->with('status', 'Correo enviado exitosamente, por favor verifique');
        } else {
            return $redirect->to('/')->with('status', 'El usuario no existe, por favor verifique');
        }

    }

}
