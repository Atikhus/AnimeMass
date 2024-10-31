<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="icon" href="Assets/4043233-anime-away-face-no-nobody-spirited_113254.png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <!-- Poster Section -->
    <div class="container-poster">
        <img src="Assets/4043233-anime-away-face-no-nobody-spirited_113254.ico" alt="">
        <h1 id="title" >AnimeMas</h1>
        <p>Recupera tu contraseña</p>
    </div>
    <style>
        #title{
            color: aqua;
        }
    </style>
    <!-- Formulario Section -->
    <div class="container-formulario">
        <h2>Recuperación de Contraseña</h2>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No te preocupes. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecerla.') }}
        </div>

        <!-- Estado de la Sesión -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Dirección de Email -->
            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email"  class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                
            </div>

            <!-- Botón de Envío -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn">Enviar Enlace de Recuperación</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
