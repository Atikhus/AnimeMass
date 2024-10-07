<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use App\Models\User; // Si no lo utilizas, puedes omitirlo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManejoEntradas extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showSignForm()
    {
        return view('sign'); // Asegúrate de que 'sign' sea el nombre correcto de tu vista
    }

    public function showForm(){
        return view('control_panel');
    }





    public function login(Request $request){

         // Validación de credenciales
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Intento de autenticación
    if (Auth::attempt($credentials)) {
        // Autenticación exitosa
        return view('index'); 
    } else {
        // Fallo en la autenticación
        return back()->withErrors([
            'email' && 'password'=> 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            
        ]);
    }
}


    public function sign(Request $request){
    
             // Validar los datos
            $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255', 
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            // Crea el usuario
            User::create([
                'name' => $request->name,
                'lastname' => $request->lastname, 
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
    // Redirigir después del registro
    return view('index'); 
        
    }
}
