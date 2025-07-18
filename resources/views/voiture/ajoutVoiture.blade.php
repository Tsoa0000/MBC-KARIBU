@extends('app')
@include('partials.navbar')

@section('style')
    <link rel="stylesheet" href="{{ asset('asset/css/voiture/style.css') }}">
    <style>
        .custom-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.8px solid #33897f;
            border-radius: 12px;
            background-color: #ffffff;
            font-family: 'Skia', sans-serif;
            font-size: 14px;
            color: #2d5c4a;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
            appearance: none;
        }

        .custom-select:focus {
            outline: none;
            border-color: #2d5c4a;

            background-color: #f9fcfb;
            color: #1b3a31;
        }

        .custom-select option {
            color: #2d5c4a;
            background-color: #fff;
            font-family: 'Skia', sans-serif;
            font-size: 14px;
        }

        .custom-select option:checked {
            background-color: #33897f;
            color: white;
        }

        .custom-select option:hover {
            background-color: #2d5c4a;
            color: white;
        }

        .custom-select option:disabled {
            color: #c0c0c0;
        }

        /* Form Floating Range */

        .form-floating-range {
            position: relative;
            width: 100%;
            margin-bottom: 1.25rem;
            font-family: 'Inter', sans-serif;
        }

        .form-floating-range label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #33897f;
            font-size: 1.05rem;
            user-select: none;
        }

        input[type="range"].form-floating-range-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 14px;
            border-radius: 10px;
            background: #d8edea;
            box-shadow: inset 0 1.5px 4px rgba(51, 137, 127, 0.25);
            cursor: pointer;
            outline: none;
            margin: 0;
            transition: background-color 0.3s ease;
        }

        input[type="range"].form-floating-range-slider::-webkit-slider-runnable-track {
            height: 14px;
            border-radius: 10px;
            background: #d8edea;
            box-shadow: inset 0 1.5px 4px rgba(51, 137, 127, 0.25);
        }

        input[type="range"].form-floating-range-slider::-moz-range-track {
            height: 14px;
            border-radius: 10px;
            background: #d8edea;
            box-shadow: inset 0 1.5px 4px rgba(51, 137, 127, 0.25);
        }

        input[type="range"].form-floating-range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #33897f;
            border: 2.5px solid #2d5c4a;
            box-shadow: 0 0 8px rgba(51, 137, 127, 0.6);
            cursor: pointer;
            margin-top: -6px;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        input[type="range"].form-floating-range-slider::-moz-range-thumb {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #33897f;
            border: 2.5px solid #2d5c4a;
            box-shadow: 0 0 8px rgba(51, 137, 127, 0.6);
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        input[type="range"].form-floating-range-slider:focus::-webkit-slider-thumb,
        input[type="range"].form-floating-range-slider:focus::-moz-range-thumb {
            transform: scale(1.25);
            box-shadow: 0 0 14px #33897fff;
        }

        .form-floating-range output {
            margin-top: 0.3rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: #33897f;
            text-align: right;
            font-family: 'Inter', sans-serif;
            user-select: none;
        }

        /* Places badges */

        .places-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            width: 100%;
            font-family: 'Skia', sans-serif;
            justify-content: flex-start;
        }

        .badge-place {
            min-width: 44px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px;
            border: 1.5px solid #cfe3df;
            background-color: #ffffff;
            color: #2d5c4a;
            cursor: pointer;
            user-select: none;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.05);
            transition: all 0.25s ease;
        }

        .badge-place:hover {
            background-color: #d8edea;
            border-color: #33897f99;
            box-shadow: 0 2px 6px rgba(51, 137, 127, 0.25);
        }

        .badge-place.active {
            background-color: #33897f;
            color: #fff;
            border-color: #2d5c4a;
            box-shadow: 0 3px 8px rgba(51, 137, 127, 0.5);
        }

        .place-label {
            margin-bottom: 0.4rem;
            font-weight: 700;
            color: #33897f;
            font-size: 1rem;
        }

        /* Form wrapper */

        .form-wrapper {
            max-width: 480px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .form-title {
            font-family: 'Skia', serif;
            font-weight: 700;
            font-size: 2.25rem;
            color: #2d5c4a;
            margin-bottom: 1.75rem;
            text-align: center;
        }
    </style>
@endsection

@section('body')
    <main id="main" class="main py-5">
        <div class="form-wrapper">
            <h3 class="form-title">Ajouter une voiture</h3>
            <form method="POST" action="{{ route('voiture.store') }}" class="row g-3">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control text-uppercase" name="matricule" id="immat"
                        placeholder="Immatriculation" required pattern="^[0-9]{4}[A-Z]{3}$"
                        title="Exemple : 1205TBG (4 chiffres + 3 lettres)" />
                    <label for="immat">Immatriculation</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="modele" id="modele" placeholder="Modèle"
                        required />
                    <label for="modele">Modèle</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select text-uppercase custom-select" name="typeVehi" id="type" required>
                        <option value="" disabled {{ old('typeVehi') ? '' : 'selected' }}>Choisir un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ old('typeVehi') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    <label for="type">Type de véhicule</label>
                </div>

                <div class="form-floating-range">
                    <label for="etat">État (1-10)</label>
                    <input type="range" class="form-floating-range-slider" name="etat" id="etat" min="1"
                        max="10" step="1" value="5"
                        oninput="this.nextElementSibling.value = this.value;" />
                    <output>5</output>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="conso" id="consommation" placeholder="Consommation"
                        required />
                    <label for="consommation">Consommation (L/100km)</label>
                </div>

                <div class="mb-3">
                    <label class="place-label">Nombre de places</label>
                    <div class="places-badges" id="placeBadges">
                        @foreach ([5, 7, 9, 15, 18, 22, 29, 32] as $place)
                            <div class="badge-place" data-value="{{ $place }}">{{ $place }}</div>
                        @endforeach
                    </div>
                    <input type="hidden" name="nbrPlace" id="nbrPlaceInput" required value="{{ old('nbrPlace', 5) }}">
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-custom">Valider</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const badges = document.querySelectorAll('.badge-place');
            const input = document.getElementById('nbrPlaceInput');

            function activateBadge(value) {
                badges.forEach(b => b.classList.toggle('active', b.dataset.value === value));
            }

            badges.forEach(badge => {
                badge.addEventListener('click', () => {
                    input.value = badge.dataset.value;
                    activateBadge(badge.dataset.value);
                });
            });

            // Activation initiale
            activateBadge(input.value);

            const immat = document.getElementById('immat');
            if (immat) {
                immat.addEventListener('input', function() {
                    this.value = this.value.toUpperCase().replace(/[^0-9A-Z]/g, '').substring(0, 7);
                });
            }
        });
    </script>
@endsection
