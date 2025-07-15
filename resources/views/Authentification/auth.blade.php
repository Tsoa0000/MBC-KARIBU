@extends('app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/style.css') }}">


@endsection

@section('body')
<div class="container" id="container">
    <div class="overlay-container">
        <div class="overlay overlay-left">
            <h1><span>Bonjour</span></h1>
            <p>Bienvenue dans l'univers de </p>
            <img src="{{ asset('assets/image/LOGO.png') }}" class="overlay-left-img" alt="flower">
            <p class="account">Vous avez déjà un compte?</p>
            <button type="button" class="btn" id="sign-in-btn">Se connecter</button>
        </div>
        <div class="overlay overlay-right">
            <h1><span>Bonjour</span></h1>
            <p>Bienvenue dans l'univers de </p>
            <img src="{{ asset('assets/image/LOGO.png') }}" class="overlay-right-img" alt="flower">
            <p class="account">Vous n'avez pas de compte?</p>
            <button type="button" class="btn" id="sign-up-btn">S'inscrire</button>
        </div>
    </div>

    <!-- Connexion chauffeur -->
    <div class="form-container sign-in-container">
        <h1>Connexion</h1>
        <form action="{{ route('login.chauffeur') }}" method="POST" autocomplete="on">
            @csrf

            <div class="input-floating">
                <input type="text" name="email" id="email-chauffeur" placeholder=" " required>
                <label for="email-chauffeur">Email</label>
            </div>

            <div class="input-floating">
                <input type="password" name="password" id="password-chauffeur" placeholder=" " required>
                <label for="password-chauffeur">Mot de passe</label>
            </div>

            <button type="submit" class="btn btn-submit">Se connecter</button>
        </form>
    </div>

    <!-- Inscription chauffeur -->
    <div class="form-container sign-up-container">
        <h1>Inscription</h1>
        <form action="{{ route('register.chauffeur') }}" method="POST" autocomplete="on">
            @csrf

            @error('password')
                <div style="color: red">{{ $message }}</div>
            @enderror
            @error('password_confirm')
                <div style="color: red">{{ $message }}</div>
            @enderror

            <div class="input-floating">
                <input type="text" name="name" id="name-register" placeholder=" " required>
                <label for="name-register">Nom</label>
            </div>

            <div class="input-floating">
                <input type="text" name="first_name" id="first-name-register" placeholder=" " required>
                <label for="first-name-register">Prénom(s)</label>
            </div>

            <div class="input-floating">
                <input type="email" name="email" id="email-register" placeholder=" " required>
                <label for="email-register">Email</label>
            </div>

            <div class="input-floating">
                <input type="text" name="numeroPermis" id="numero-permis" placeholder=" " required>
                <label for="numero-permis">Numéro de permis</label>
            </div>


            <div class="input-floating">
                <input type="date" name="dateValidite" id="date-validite" placeholder=" " required>
                <label for="date-validite">Date de validité</label>
            </div>

          <div class="input-floating-checkbox">
    <label id="label-categorie" class="label-floating-toggle-left" for="toggleCheckbox">Catégorie du permis</label>

    <input type="checkbox" id="toggleCheckbox" hidden>

    <div class="checkbox-group espace" id="checkboxGroup">
        @foreach($typePermis as $type)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="permis_{{ $type }}" name="typePermis[]" value="{{ $type }}">
                <label class="form-check-label" for="permis_{{ $type }}">{{ $type }}</label>
            </div>
        @endforeach
    </div>
</div>


            <div class="input-floating">
                <input type="password" name="password" id="password-register" placeholder=" " required>
                <label for="password-register">Mot de passe</label>
            </div>

            <div class="input-floating">
                <input type="password" name="password_confirmation" id="password-confirm" placeholder=" " required>
                <label for="password-confirm">Confirmer le mot de passe</label>
            </div>

            <button type="submit" class="btn btn-submit">S'inscrire</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/login/main.js') }}"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const toasts = document.querySelectorAll('.toast-message');
    toasts.forEach((toast) => {
        setTimeout(() => {
            toast.style.display = 'none';
        }, 6000);
    });
});
</script>
@endsection
