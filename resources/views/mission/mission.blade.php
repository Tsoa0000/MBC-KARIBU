@extends('app')

@section('style')
<style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #e0f2f1, #c8e6c9);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 1rem;
      overflow: hidden;
    }

    form {
      background: #ffffff;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      padding: 1.8rem;
      border-radius: 20px;

      max-width: 640px;
      width: 100%;
    }

    h2 {
      text-align: center;
      color: #2d5c4a;
      margin-bottom: 1.2rem;
      font-size: 1.4rem;
    }

    .grid-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .width {
      grid-column: span 2;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.3rem;
      font-size: 0.92rem;
      color: #2d5c4a;
    }

    input, select, textarea {
      width: 100%;
      padding: 0.65rem 0.9rem;
      border-radius: 14px;
      border: none;
      box-shadow: inset 2px 1px 4px #c1d1db, inset -3px -3px 6px #ffffff;
      font-size: 0.95rem;
    }

    input:focus, select:focus, textarea:focus {
      outline: none;
      box-shadow: 0 0 0 2px #33897f;
      background: #f0fbff;
    }

    select:hover, input:hover, textarea:hover {
      border: 1px solid #33897f;
    }

    textarea {
      resize: none;
      height: 60px;
    }

    button {
      margin-top: 1rem;
      width: 100%;
      padding: 0.8rem;
      background: #2d5c4a;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 16px;
      cursor: pointer;
      box-shadow: 0 5px 14px rgba(45, 92, 74, 0.4);
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #e2a346;
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(226, 163, 70, 0.4);
    }

    @media (max-width: 640px) {
      .grid-2col {
        grid-template-columns: 1fr;
      }
      .full-width {
        grid-column: span 1;
      }
    }
  </style>
@endsection
@section('body')
<main id="main" class="main">
<form id="trajetForm">
  <h2> Mission</h2>
  <div class="grid-2col">
    <div>
      <label for="dateDepart"> Date de départ</label>
      <input type="date" id="dateDepart" name="date_depart" required>
    </div>
    <div>
      <label for="dateArrivee">Date d'arrivée</label>
      <input type="date" id="dateArrivee" name="date_arrive" required>
    </div>

 <div>
  <label for="lieuDepart">De</label>
  <select id="lieuDepart" name="lieuDepart" required>
    <option value="" disabled selected>-- Choisir --</option>
    @foreach ($trajet as $t)
      <option value="{{ $t->lieu_depart_id }}">{{ $t->nomLieuDepart }}</option>
    @endforeach
  </select>
</div>

<div>
  <label for="lieuArrivee">À</label>
  <select id="lieuArrivee" name="lieuArrivee" required>
    <option value="" disabled selected>-- Choisir --</option>
    @foreach ($trajet as $t)
      <option value="{{ $t->lieu_arrive_id }}">{{ $t->nomLieuArrivee }}</option>
    @endforeach
  </select>
</div>

    <div class="width">
      <label for="voiture">Voiture</label>
        <select name="voiture_id" required>
          <option value="" disabled selected>Choisir une immatriculation</option>
          @foreach ($voiture as $v)
            <option value="{{ $v->id }}">{{ $v->matricule }}</option>
          @endforeach
        </select>
    </div>

    <div class="width">
      <label for="objet">Objet</label>
      <textarea id="objet" name="objet" placeholder="Motif..." required></textarea>
    </div>

    <div class="width">
      <button type="submit">Envoyer</button>
    </div>
  </div>
</form>
</main>
@endsection
@section('script')

@endsection


