<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ManejoEntradas extends Controller
{
    //
    public function showLoginForm(){
        return view('login');
    }

    public function showSignForm(){
        return view('sign');
    }

    //manejo de las solicitudes para el servidor

    public function login(Request $request){
        
        //vamos a validar la monda que llegue aqui
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si es exitoso, redirigir a la página de dashboard o a otra ruta
            return redirect()->intended('dashboard');
        } else {
            // Si falla, regresar al formulario con un mensaje de error
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
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Crear el nuevo usuario
    $user = User::create([
        'name' => $validatedData['name'],
        'lastname' => $validatedData['lastname'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // Redirigir después del registro
    return redirect()->route('dashboard'); // Cambia 'dashboard' por la ruta que desees
    }

    


}
