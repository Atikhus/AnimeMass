<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ManejoEntradas extends Controller
{
    public function showLoginForm()
    {
        return view('login-me');
    }

    public function showSignForm()
    {
        return view('sign'); // Asegúrate de que 'sign' sea el nombre correcto de tu vista
    }

    public function showForm()
    {
        return view('control_panel');
    }

public function showIndex()
{
    return view('index');
}

    
public function mostrarSesionIniciada()
{
    return view('sesion_iniciada'); // Asegúrate de que el nombre de la vista sea correcto
}


    public function login(Request $request)
    {
        // Validar las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirigir a la vista de sesión iniciada
            //return redirect('sesion_iniciada');
            return redirect()->route('index');
        }

        // Si la autenticación falla, redirigir de nuevo a la página de inicio de sesión
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }


    //save here
    public function sign(Request $request)
    {
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
        return redirect('/'); // Cambia esto si tienes una página específica después del registro
    }

    public function showProfile(){
        $user = Auth::user();
        return view('user.usuario', compact('user'))->render(); // Esto retornará el HTML de la vista
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showFavoriteList(){
        return view('user.lista_favoritos');
    }

    public function showCategories(Request $request){
        $genreNun = $request->input('genre');
        $genreName = '';
        switch ($genreNun) {
            case '1':
                // Lógica específica para shonen
                $genreName = 'shonen';
                break;

            case '2':
                // Lógica específica para seinen
                $genreName = 'shojo';
                break;

            case '3':
                // Lógica específica para shojo
                $genreName = 'seinen';
                break;

            case '4':
                $genreName = 'graphic novel';
                break;

            case '5':
                $genreName = 'boy love';
                break;

            case '6':
                $genreName = 'ecchi';
                break;
                
            case '7':
                $genreName = 'sport';
                break;
                
            case '8':
                $genreName = 'comics';

                break;
        
            case '9':
                $genreName = 'yuri';
                break;

            case '10':
                $genreName = 'romcom';
            break;

            default:
                
                $genreName = "Género no encontrado"; 
                break;
        }

        //dd($genreName);
        return view('categories',compact('genreName'));
    }

}
