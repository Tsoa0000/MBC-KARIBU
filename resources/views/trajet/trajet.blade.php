@extends('app')
@include('partials.navbar')

@section('style')
  <style>
    @import url('https://fonts.cdnfonts.com/css/skia');
    :root {
      --primary: #33897f;
      --dark: #2d5c4a;
      --bg: #f5f9f8;
      --white: #fff;
      --radius: 1.5rem;
      --shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    body {
      font-family: 'Skia', sans-serif;
      background: var(--bg);
      color: var(--dark);
      padding: 2rem;
    }

    .container {
      width: 100%;
      max-width: 960px;
      margin: auto;
    }

    .card {
      background: var(--white);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 2rem;
    }

    .form {
      display: flex;
      flex-wrap: nowrap;
      gap: 1.25rem;
      align-items: flex-end;
      margin-bottom: 2rem;
    }

    .form-group {
      flex: 1 1 220px;
      position: relative;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 1.2rem 1rem 0.6rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: var(--white);
    }

    .form-group label {
      position: absolute;
      top: 1rem;
      left: 1rem;
      font-size: 1rem;
      color: #888;
      background: var(--white);
      padding: 0 0.25rem;
      transition: 0.2s;
      pointer-events: none;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label,
    .form-group select:focus + label,
    .form-group select:not([value=""]) + label {
      top: -0.6rem;
      left: 0.8rem;
      font-size: 0.8rem;
      color: var(--primary);
    }

    .form-action {
      display: flex;
      align-items: center;
      height: 100%;
    }

    button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.9rem 2rem;
      font-size: 1rem;
      border-radius: 999px;
      cursor: pointer;
    }
    button:hover{
        background:#e2a346;
    }

    .divider {
      height: 1px;
      background: #e0e5e3;
      margin: 2rem 0 1rem;
    }

  .page-title {

    font-size: 1.8rem;
    width: 200px;
    font-weight: 600;
    color: #2a736d;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e2a346;

    padding-bottom: 0.3rem;


  }

.table-wrapper {
  overflow-x: auto;
  border-radius: 1rem;
  margin-top: 2rem;
}

table.voiture-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0 14px;
}

    thead th {
    background: #2d5c4a !important;
    color: #fff !important;
    padding: 1.1rem;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.7px;
  }
      thead th, td {
      padding: 0.75rem;
      font-size: 15px;
    }


  thead th:first-child {
    border-top-left-radius: 0.85rem;
  }

  thead th:last-child {
    border-top-right-radius: 0.85rem;
  }
  td {
  padding: 1rem;
  color: #2d5c4a !important;


}

tbody tr {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  transition: 0.3s ease;
}

tbody tr:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
}

td {

  text-align: center;
  vertical-align: middle;
}

.btn-delete {
    height: 30px;
    width: 30px;
    border: 1px #e2a346 solid;
  color: #e2a346 ;

}
.text-uppercase {
  text-transform: uppercase;
}


@media (max-width: 768px) {
  .header-top {
    flex-direction: column;
    align-items: flex-start;
  }

  table, thead, tbody, th, td, tr {
    font-size: 0.9rem;
  }
}
.form-wrapper {
  max-width: 520px;
  margin: auto;
  padding: 35px 30px;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
  border-top: 6px solid #33897f;
}

.form-title {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 30px;
  color: #2d5c4a;
  text-align: center;
}

.form-floating input,
.form-floating select {
  border-radius: 10px;
  border: 1px solid #dcdcdc;
}

.form-floating label {
  color: #2d5c4a;
}

.form-floating input:focus {
  border-color: #33897f;
  box-shadow: 0 0 0 0.2rem rgba(51, 137, 127, 0.25);
}

.btn-primary {
  background-color: #33897f;
  border-color: #33897f;
  border-radius: 10px;
}

.btn-primary:hover {
  background-color: #2d5c4a;
  border-color: #2d5c4a;
}

.btn-outline-secondary {
  border-color: #e2a346;
  color: #e2a346;
  border-radius: 10px;
}

.btn-outline-secondary:hover {
  background-color: #e2a346;
  color: #fff;
}


  </style>
@endsection

@section('body')
<main id="main" class="main">
  <div class="container">
    <div class="card">
      <h2>Ajouter un Trajet</h2>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('trajet.store') }}" method="POST" class="form">
        @csrf

        <div class="form-group">
          <input type="text" name="lieu_depart" placeholder=" " required autocomplete="off">
          <label for="lieu_depart">Lieu de départ</label>
        </div>

        <div class="form-group">
          <input type="text" name="lieu_arrivee" placeholder=" " required autocomplete="off">
          <label for="lieu_arrivee">Lieu d’arrivée</label>
        </div>

        <div class="form-group">
          <select name="typeRoute" required>
            <option value="" disabled selected hidden></option>
            <option value="Asphaltée">Secondaire</option>
            <option value="Piste">Piste</option>
            <option value="Mixte">Pavée</option>
            <option value="Mixte">Autoroute</option>
          </select>
          <label for="typeRoute">Type de route</label>
        </div>

        <div class="form-group">
          <input type="number" id="km" name="km" placeholder=" " step="0.1" required>
          <label for="km">Kilométrage</label>
        </div>

        <div class="form-action">
          <button type="submit">Valider</button>
        </div>
      </form>

      <div class="divider"></div>

     <h2 class="page-title mt-16">Liste des trajets</h2>
<div class="table-wrapper mt-6">
  <table class="table voiture-table align-middle mb-0">
    <thead>
      <tr>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Type de route</th>
        <th>Kilométrage</th>
      </tr>
    </thead>
    <tbody>
      @forelse($trajets as $trajet)
        <tr>
          <td>{{ $trajet->lieuDepart?->nomLieu ?? '-' }}</td>
          <td>{{ $trajet->lieuArrivee?->nomLieu ?? '-' }}</td>
          <td>{{ $trajet->typeRoute }}</td>
          <td>{{ $trajet->km ?? '-' }} km</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center text-gray-500 py-4">Aucun trajet enregistré.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

</main>
@endsection
