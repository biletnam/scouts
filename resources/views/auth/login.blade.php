@extends('layout.app')
@section('title', 'Aanmelden')
@section('content')
    <main>
        <h2 class="title">Aanmelden</h2>
        <div class="login">
            <p>Welkom op de leidingspagina van den 18! Gelieve in te loggen met je 18bp e-mailadres.</p>
            <div id="login_form" class="center">
                @include('auth.login-form')
                <sub><a href="http://www.youtube.com/watch?v=dQw4w9WgXcQ">Wachtwoord vergeten?</a></sub>
            </div>
        </div>
    </main>
@stop