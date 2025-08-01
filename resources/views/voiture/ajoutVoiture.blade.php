@extends('app')
@include('partials.navbar')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
     @import url('https://fonts.cdnfonts.com/css/skia');
    @font-face {
      font-family: 'Skia';
      src: local('Skia'), local('Skia-Regular');
    }


    .form-container {
      background: #ffffffcc;
      backdrop-filter: blur(10px);
      padding: 2rem 2rem 2.5rem;
      border-radius: 20px;
      box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.1);
      width: 350px;
      margin-left: 220px;
    }

    .form-header {
      font-size: 20px;
      font-weight: bold;
      color: #33897F;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-header span {
      display: inline-block;
      border-bottom: 2px solid #E2A346;
      padding-bottom: 5px;
    }

    .form-group {
      position: relative;
      margin-bottom: 2rem;
    }

    .form-group svg {
      position: absolute;
      top: 50%;
      left: 0.8rem;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      fill: #33897F;
    }

    .form-group input {
      width: 100%;
      padding: 0.9rem 0.75rem 0.9rem 2.8rem;
      font-size: 1rem;
      border: 2px solid #33897F;
      border-radius: 12px;
      outline: none;
      background-color: transparent;
      color: #000;
    }

    .form-group label {
      position: absolute;
      left: 2.8rem;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      background:rgb(230, 230, 230);
      pointer-events: none;
      transition: 0.3s;
      padding: 0 0.25rem;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -2px;
      left: 2.2rem;
      font-size: 15px;
      color: #E2A346;
    }

    .submit-btn {
      font-family: 'Skia', sans-serif;
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 12px;
      background-color: #33897F;
      color: #ffffff;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #2a6f67;
    }
    </style>
@endsection

@section('body')
    <main id="main" class="main">
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
                   <input type="text" class="form-control" name="modele" id="modele" placeholder="Modèle" required maxlength="30" pattern=".{1,30}" title="Le modèle doit contenir entre 1 et 50 caractères." />
                   <label for="modele">Modèle</label>
                </div>

               <div class="form-floating mb-3">
                <select class="form-select text-uppercase custom-select" name="typeVehi" id="type" required onchange="handleTypeChange(this)">
                    <option value="" disabled {{ old('typeVehi') ? '' : 'selected' }}>Choisir un type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ old('typeVehi') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                    <option value="autre">Ajouter...</option>
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
                <input type="number" class="form-control" name="conso" id="consommation" min="1" max="20" step="0.1" placeholder="Consommation" required />
                <label for="consommation">Consommation (L/100km)</label>
                </div>


                <div class="mb-3">
                    <label class="place-label">Nombre de places</label>
                    <div class="places-badges" id="placeBadges">
                        @foreach ([2, 5, 7, 9, 15, 18, 22, 29, 32] as $place)
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
<div class="modal fade" id="ajoutTypeModal" tabindex="-1" aria-labelledby="ajoutTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: transparent; border: none; box-shadow: none;">
      <div class="modal-body p-0">
        <form class="form-container" method="POST" action="{{ route('car_types.store') }}">
          @csrf
          <div class="form-header"><span>Ajouter un type de voiture</span></div>

          @if(session('success'))
            <p style="color: green; text-align:center;">{{ session('success') }}</p>
          @endif

          <div class="form-group">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M5 11l1.5-4.5h11L19 11h1a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-1v1a1 1 0 1 1-2 0v-1H7v1a1 1 0 1 1-2 0v-1H4a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1h1zm2.16-3L6.5 11h11l-.66-3H7.16zM6 14a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
            <input type="text" id="name" name="name" required placeholder=" " />
            <label for="name">Type de voiture</label>
          </div>

          <button type="submit" class="submit-btn">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function handleTypeChange(select) {
        if (select.value === "autre") {
            const modal = new bootstrap.Modal(document.getElementById('ajoutTypeModal'));
            modal.show();
            select.value = '';
        }
    }

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

