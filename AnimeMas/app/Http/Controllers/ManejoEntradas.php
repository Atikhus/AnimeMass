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
        return view('sesion_iniciada');
    }





    public function login(Request $request)
{
         // Validación de credenciales
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Intento de autenticación
    if (Auth::attempt($credentials)) {
        // Autenticación exitosa
        return redirect()->intended('sesion_iniciada'); 
    } else {
        // Fallo en la autenticación
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            
        ]);
    }
}


    public function sign(Request $request){
    
             // Validar los datos
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:Users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Aquí es donde agregas el dd()
     // Esto mostrará los datos validados y detendrá la ejecución

    // Crear el nuevo usuario utilizando el modelo
    User::create([
        'name' => $validatedData['name'],
        'lastname' => $validatedData['lastname'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // Redirigir después del registro
    return redirect()->route('sesion_iniciada'); 
        
    }
}
