@extends('app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/login/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-p6U8xEUtD2lVwrfxRlI5g6VZ2G3PVpuf58I6Wq+g0EyIbfz1m+8TC0vU8srr8RzE2y6iUq6v6YHdqzJCRAPUPA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" />
@endsection

@section('body')

    {{-- TOAST MESSAGES --}}
    @if (session('success'))
        <div class="toast-message toast-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="toast-message toast-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="toast-message toast-error">{{ $error }}</div>
        @endforeach
    @endif

    <div class="container" id="container">
        {{-- OVERLAY --}}
        <div class="overlay-container">
            <div class="overlay overlay-left">
                <h1><span>Bonjour</span></h1>
                <p>Bienvenue dans l'univers de </p>
                <img src="{{ asset('assets/image/LOGO.png') }}" class="overlay-left-img" alt="logo">
                <p class="account">Vous avez déjà un compte ?</p>
                <button type="button" class="btn" id="sign-in-btn">Se connecter</button>
            </div>
            <div class="overlay overlay-right">
                <h1><span>Bonjour</span></h1>
                <p>Bienvenue dans l'univers de </p>
                <img src="{{ asset('assets/image/LOGO.png') }}" class="overlay-right-img" alt="logo">
                <p class="account">Vous n'avez pas encore de compte ?</p>
                <button type="button" class="btn" id="sign-up-btn">S'inscrire</button>
            </div>
        </div>

        {{-- CONNEXION --}}
        <div class="form-container sign-in-container">
            <h1>Connexion</h1>
            <form action="{{ route('login') }}" method="POST" autocomplete="on">
                @csrf
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email-login" placeholder=" " required>
                    <label for="email-login">Email</label>
                </div>
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password-login" placeholder=" " required>
                    <label for="password-login">Mot de passe</label>
                    <span class="toggle-password" data-target="password-login" title="Afficher / masquer le mot de passe"
                        role="button" tabindex="0">
                        <i class="fas fa-eye-slash"></i>
                    </span>

                </div>
                <button type="submit" class="btn btn-submit">Se connecter</button>
            </form>
        </div>

        {{-- INSCRIPTION --}}
        <div class="form-container sign-up-container">
            <h1>Inscription</h1>
            <form action="{{ route('register') }}" method="POST" autocomplete="on">
                @csrf
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" id="name-register" placeholder=" " required>
                    <label for="name-register">Nom</label>
                </div>
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="first_name" id="first-name-register" placeholder=" " required>
                    <label for="first-name-register">Prénom(s)</label>
                </div>
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email-register" placeholder=" " required>
                    <label for="email-register">Email</label>
                </div>
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password-register" placeholder=" " required>
                    <label for="password-register">Mot de passe</label>
                    <span class="toggle-password" data-target="password-register" title="Afficher / masquer le mot de passe"
                        role="button" tabindex="0">
                        <i class="fas fa-eye-slash"></i>
                    </span>

                </div>
                <div class="input-floating">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password-confirm-register" placeholder=" "
                        required>
                    <label for="password-confirm-register">Confirmer le mot de passe</label>
                    <span class="toggle-password" data-target="password-confirm-register"
                        title="Afficher / masquer le mot de passe" role="button" tabindex="0">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <button type="submit" class="btn btn-submit">S'inscrire</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.toast-message').forEach(el => el.style.display = 'none');
            }, 6000);

            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const input = document.getElementById(toggle.dataset.target);
                    const isVisible = input.type === 'text';
                    input.type = isVisible ? 'password' : 'text';
                    toggle.innerHTML = isVisible ? '<i class="fas fa-eye-slash"></i>' :
                        '<i class="fas fa-eye"></i>';
                });
            });

            document.getElementById('sign-up-btn')?.addEventListener('click', () => {
                document.getElementById('container')?.classList.add("sign-up-mode");
            });

            document.getElementById('sign-in-btn')?.addEventListener('click', () => {
                document.getElementById('container')?.classList.remove("sign-up-mode");
            });
        });
    </script>
@endsection
