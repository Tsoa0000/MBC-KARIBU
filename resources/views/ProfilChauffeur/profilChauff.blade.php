@extends('app')
@include('partials.navbar')
@section('style')
<style>

    body {
    background: linear-gradient(135deg, #e8f1f0, #d1e3e1);
    font-family: 'Skia', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    }
    .container {
            width: 100%;
            max-width: 960px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 1.5rem;
            padding: 40px;
            margin-top: 80px;
        }
    .form-container h2 {
    text-align: center;
    color: #2d5c4a;
    margin-bottom: 20px;
    }

    .form-group {
    margin-bottom: 20px;
    }

    .form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #2d5c4a;
    margin-bottom: 6px;
    gap: 10px;
    }

    .form-label svg {
    width: 20px;
    height: 20px;
    fill: #33897f;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="tel"] {
    width: 100%;
    height: 40px;
    padding: 8px;
    border-radius: 10px;
    border: none;
    background: #f0f7f6;
    box-shadow: inset 2px 2px 5px #d1dddb, inset -2px -2px 5px #ffffff;
    font-size: 1rem;
    transition: 0.3s ease;
    }

    .form-group input:focus {
    outline: none;
    box-shadow: inset 2px 2px 4px #c0ccca, inset -2px -2px 4px #ffffff;
    }

    .checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
    }

    .checkbox-group label {
    display: flex;
    align-items: center;
    background-color: #f0f7f6;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 500;
    box-shadow: inset 1px 1px 3px #d1dddb, inset -1px -1px 3px #ffffff;
    cursor: pointer;
    }

    .checkbox-group input {
        height: 20px;
        width: 20px;
    margin-right: 6px;
    }

    .btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #33897f, #2d5c4a);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    box-shadow: 0 6px 12px rgba(45, 92, 74, 0.3);
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 18px rgba(45, 92, 74, 0.35);
    }
    </style>
@endsection
@section('body')
    <main id="main" class="main">
        <div class="container">
        <div class="form-container">
            <h2>Profil Chauffeur</h2>
            <form action="{{ route('profil.chauffeur', $user->id) }}" method="POST">
                @csrf
                <!-- Nom -->
                <div class="form-group">
                    <label class="form-label">
                        <!-- user icon -->
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                        </svg>
                        Nom complet kncklsdncljsdnclj
                    </label>
                    <input type="text" name="nom" value="{{ $user->name }} {{ $user->first_name }}"
                        placeholder="Jean Rakoto" readonly>
                </div>
                <!-- Numéro de permis -->
                <div class="form-group">
                    <label class="form-label">
                        <!-- ID icon -->
                        <svg viewBox="0 0 24 24">
                            <path d="M2 4v16h20V4H2zm2 2h16v3H4V6zm0 5h10v2H4v-2zm0 4h7v2H4v-2z" />
                        </svg>
                        Numéro de permis
                    </label>
                    <input type="text" name="numeroPermis" placeholder="B123456789" required>
                </div>

                <!-- Date de validité -->
                <div class="form-group">
                    <label class="form-label">
                        <!-- calendar icon -->
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                        </svg>
                        Date de validité
                    </label>
                    <input type="date" name="dateValidite" required>
                </div>

                <!-- Catégories -->
                <div class="form-group">
                    <label class="form-label">
                        <!-- check icon -->
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.17l-3.88-3.88L4 13.41l5 5 10-10-1.41-1.41z" />
                        </svg>
                        Catégorie(s) du permis
                    </label>
                    <div class="checkbox-group espace" id="checkboxGroup">
                        @foreach ($typePermis as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permis_{{ $type }}"
                                    name="typePermis[]" value="{{ $type }}">
                                <label class="form-check-label" for="permis_{{ $type }}">{{ $type }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- CIN -->
                    <div class="form-group">
                        <label class="form-label">
                            <!-- badge icon -->
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                            </svg>
                            Numéro CIN
                        </label>
                        <input type="text" name="cin" placeholder="123456789012" required>
                    </div>

                    <button type="submit" class="btn">Enregistrer</button>
            </form>
        </div>
        </div>
    </main>
@endsection
@section('scripts')
@endsection
