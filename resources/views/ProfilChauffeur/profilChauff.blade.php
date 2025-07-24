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
            max-width: 600px;
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
            gap: 60px;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .form-check-input:checked {
            background-color: #2d5c4a;
            border-color: #2d5c4a;
        }

        .checkbox-group .label {
            display: flex;
            align-items: center;
            gap: 8px;
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
            color: #e2a346;
        }
    </style>
@endsection



@section('body')
    <main id="main" class="main">
        <div class="container">
            <div class="form-container">
                <h2>Profil Chauffeur</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form
                    action="{{ $detailChauff ? route('profil.chauffeur.update', $detailChauff->id) : route('profil.chauffeur.store', $user->id) }}"
                    method="POST">
                    @csrf
                    @if ($detailChauff)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label class="form-label">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                            </svg>
                            Nom complets
                        </label>
                        <input type="text" name="nom" value="{{ $user->name }} {{ $user->first_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <svg viewBox="0 0 24 24">
                                <path d="M2 4v16h20V4H2zm2 2h16v3H4V6zm0 5h10v2H4v-2zm0 4h7v2H4v-2z" />
                            </svg>
                            Numéro de permis
                        </label>
                        <input type="text" name="numeroPermis"
                            value="{{ old('numeroPermis', $detailChauff->numeroPermis ?? '') }}" required>
                    </div>
                    @php
                        use Carbon\Carbon;
                        $today = Carbon::now()->format('Y-m-d');
                        $dateValue = old('dateValidite', $detailChauff->dateValidite ?? $today);
                    @endphp

                    <div class="form-group">
                        <label class="form-label">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                            </svg>
                            Date de validité
                        </label>
                        <input type="date" name="dateValidite" value="{{ $dateValue }}" min="{{ $today }}"
                            required>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="form-label" style="width: 100%;">
                            <svg  class="w-5 h-5 text-[#33897f]" viewBox="0 0 24 24"
                                fill="none">
                                <path fill="currentColor" d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17Z" />
                            </svg>
                            Catégorie(s) du permis</label>
                        @foreach ($typePermis as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permis_{{ $type }}"
                                    name="typePermis[]" value="{{ $type }}"
                                    @if (isset($detailChauff) && is_array($detailChauff->typePermis) && in_array($type, $detailChauff->typePermis)) checked @endif>
                                <label class="label" for="permis_{{ $type }}">{{ $type }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                            </svg>
                            Numéro CIN
                        </label>
                        <input type="text" name="cin" inputmode="numeric" maxlength="12" minlength="12"
                            pattern="\d{12}" title="Le numéro CIN doit contenir exactement 12 chiffres"
                            value="{{ old('cin', $detailChauff->cin ?? '') }}" required>

                    </div>

                    <button type="submit" class="btn">
                        {{ $detailChauff ? 'Modifier mon profil' : 'Créer mon profil' }}
                    </button>
                </form>

            </div>
        </div>
    </main>
@endsection

@section('scripts')
@endsection
