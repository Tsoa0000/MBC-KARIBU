@extends('app')
@include('partials.navbar')
@section('style')
    <style>
         @import url('https://fonts.cdnfonts.com/css/skia');
    :root {
      --bg: #e0e5ec;
      --shadow-light: #ffffff;
      --shadow-dark: #a3b1c6;
      --text: #2a2a2a;
      --accent: #2a736d;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Skia', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 1rem;
    }
    main.main {
    display: flex;
    justify-content: center;
    padding: 4rem 1rem;
  }
    @media (max-width: 768px) {
      main.main {
        padding: 2rem 1rem;
      }
    }
    @media (max-width: 480px) {
      main.main {
        padding: 1rem;
      }
    }
    .main {
      width: 100%;
      max-width: 1200px;
      margin: auto;
      padding: 2rem;
      background-color: var(--bg);
      border-radius: 20px;

    }
    .main h1 {
      text-align: center;
      color: var(--accent);
      margin-bottom: 1rem;
      font-size: 2rem;
    }
    .main p {
      text-align: center;
      color: var(--text);
      margin-bottom: 1rem;
      font-size: 1.2rem;
    }
    .main a {
      color: var(--accent);
      text-decoration: none;
      font-weight: bold;
    }
    .main a:hover {
      text-decoration: underline;
    }
    .main a:focus {
      outline: 2px solid var(--accent);
      outline-offset: 2px;
    }
    .form-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;

    }
    .form-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 20px;
      max-width: 960px;
      width: 100%;
    }

    h2 {
      text-align: center;
      color: var(--accent);
      margin-bottom: 2rem;
      font-size: 1.8rem;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
    }

    .item {
      display: flex;
      flex-direction: column;
      position: relative;
    }

    label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #444;
    }

    .input-icon {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon svg {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      fill: var(--accent);
      pointer-events: none;
    }

    .input-icon input,
    .input-icon select {
      padding: 0.6rem 1rem 0.6rem 36px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
      background-color: #fff;
      box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #ffffff;
      font-family: 'Skia', sans-serif;
      color: var(--text);
      width: 100%;
      transition: box-shadow 0.2s ease, border 0.2s ease;
    }

    .input-icon input:focus,
    .input-icon select:focus {
      border-color: var(--accent);
      outline: none;
      box-shadow: inset 1px 1px 3px #ccc, inset -1px -1px 3px #fff;
    }

    .submit-btn {
      text-align: center;
      margin-top: 2rem;
    }

    button {
      background-color: var(--bg);
      color: var(--accent);
      font-weight: bold;
      border: none;
      padding: 0.8rem 2.5rem;
      font-size: 1rem;
      border-radius: 12px;
      cursor: pointer;
      font-family: 'Skia', sans-serif;
      margin: 0 0.5rem;
      box-shadow: 5px 5px 12px var(--shadow-dark), -5px -5px 12px var(--shadow-light);
      transition: transform 0.2s ease;
    }

    button:hover {
      transform: translateY(-2px);
    }

  </style>
 @endsection
 @section('body')
<main id="main" class="main">
  <div class="form-wrapper">
    <div class="form-container">
      <h2>Tableau de bord Chauffeur</h2>

      {{-- Affichage des erreurs --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Message de succès --}}
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('tabbord.store') }}">
        @csrf
        <div class="grid">

          <div class="item"><label for="date">Date</label>
            <div class="input-icon">
              <svg viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 14H5V9h14z"/></svg>
              <input type="date" id="date" name="date" required>
            </div>
          </div>

          {{-- Champ chauffeur (en hidden) --}}
          <input type="hidden" name="idChauff" value="{{ $user->id }}">
          <div class="item"><label for="chauffeur">Chauffeur</label>
            <div class="input-icon">
              <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
              <input type="text" value="{{ $user->name }} {{ $user->first_name }}" readonly>
            </div>
          </div>

                    <div class="item">
              <label for="depart">Départ</label>
              <div class="input-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7zm0 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                <input type="text" id="depart" name="point_depart" required>
              </div>
            </div>

            <div class="item">
              <label for="destination">Destination</label>
              <div class="input-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7zm0 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                <input type="text" id="destination" name="destination" required>
              </div>
            </div>

          <div class="item"><label for="motif">Motif</label>
            <div class="input-icon">
              <svg viewBox="0 0 24 24"><path d="M3 17v4h4l11-11-4-4-11 11zM20.7 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
              <input type="text" id="motif" name="motif">
            </div>
          </div>

            <div class="item">
              <label for="dep_km">Km départ</label>
              <div class="input-icon">
                <svg viewBox="0 0 24 24"><path d="M5 12h14v2H5z"/></svg>
                <input type="number" id="dep_km" name="dep_km" min="0" step="0.01" required>
              </div>
            </div>

            <div class="item">
              <label for="arr_km">Km arrivée</label>
              <div class="input-icon">
                <svg viewBox="0 0 24 24"><path d="M5 12h14v2H5z"/></svg>
                <input type="number" id="arr_km" name="arr_km" min="0" step="0.01" required>
              </div>
            </div>
          <div class="item"><label for="heure_depart">Heure de départ</label>
            <div class="input-icon">
              <input type="time" id="heure_depart" name="heure_depart" required>
            </div>
          </div>

          <div class="item"><label for="heure_arrivee">Heure d'arrivée</label>
            <div class="input-icon">
              <input type="time" id="heure_arrivee" name="heure_arrivee" required>
            </div>
          </div>

          <div class="item"><label for="km_effec">Km effectué</label>
            <div class="input-icon">
              <svg viewBox="0 0 24 24"><path d="M5 12h14v2H5z"/></svg>
              <input type="number" id="km_effec" name="km_effec" step="0.01" readonly>
            </div>
          </div>

          <div class="item"><label for="signature">Signature</label>
            <div class="input-icon">
              <svg viewBox="0 0 24 24"><path d="M9 16.2l-3.5-3.5 1.42-1.42L9 13.36l7.09-7.09L17.5 7.5z"/></svg>
              <select id="signature" name="signature" required>
                <option value="1">Signé</option>
                <option value="0">Non signé</option>
              </select>
            </div>
          </div>
        </div>

        <div class="submit-btn">
          <button type="submit">Soumettre</button>
          <button type="reset">Réinitialiser</button>
        </div>
      </form>
    </div>
  </div>


  <script>
    document.getElementById("date").value = new Date().toISOString().split("T")[0];

    const depInput = document.getElementById("dep_km");
    const arrInput = document.getElementById("arr_km");
    const effInput = document.getElementById("km_effec");

    function calcKM() {
      const dep = parseFloat(depInput.value);
      const arr = parseFloat(arrInput.value);
      if (!isNaN(dep) && !isNaN(arr)) {
        effInput.value = (arr - dep).toFixed(2);
      } else {
        effInput.value = '';
      }
    }

    depInput.addEventListener("input", calcKM);
    arrInput.addEventListener("input", calcKM);


  function validateKM() {
    const regex = /^\d+(\.\d{1,2})?$/;
    const depKm = document.getElementById('dep_km').value.trim();
    const arrKm = document.getElementById('arr_km').value.trim();

    if (!regex.test(depKm) || !regex.test(arrKm)) {
      alert("Veuillez entrer un nombre valide (positif, sans lettre) pour les kilomètres.");
      return false;
    }

    return true;
  }
  </script>
</main>

@endsection
