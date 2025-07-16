@extends('app')
@include('partials.navbar')

@section('style')
<style>
 @import url('https://fonts.cdnfonts.com/css/skia');

  body {
    font-family: 'Skia', sans-serif;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    background-color: #f0f4f3;
    position: relative;
    overflow-x: hidden;
  }


  main.main {
    display: flex;
    justify-content: center;
    padding: 4rem 1rem;
  }

  .container {
    width: 100%;
    max-width: 1100px;
    background: white;
    padding: 3rem 2.5rem;
    border-radius: 1.5rem;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
  }

  /* Entête container: titre + bouton aligné eo amin'ny tsipika iray */
  .header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
    flex-wrap: wrap;
    gap: 1rem;
  }

  /* Titre entête */
  .page-title {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 600;
    color: #2a736d;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e2a346;
    display: inline-block;
    padding-bottom: 0.3rem;


  }

  /* Bouton création vérification */
  .btn-create {
    background: #33897f;
    color: white;
    padding: 0.65rem 1.7rem;
    border: none;
    cursor: pointer;
    text-decoration: none;
    border-radius: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 1rem;
    white-space: nowrap;
  }
  .btn-create:hover{
    background: #e2a346;
    color: #2d5c4a
  }


  .table-wrapper {
    overflow-x: auto;
    border-radius: 1rem;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 14px;
    background: transparent;
  }

  thead th {
    background: #2d5c4a;
    color: #fff;
    padding: 0.5rem;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.7px;
  }

  tbody tr {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 9px 28px rgba(0, 0, 0, 0.22);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  tbody tr:hover {
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.32);
    transform: translateY(-9px);
  }

  td {
    padding: 0.5rem;
    text-align: center;
    font-size: 1rem;
    vertical-align: middle;
    border-bottom: none;
  }

  td:last-child {
    text-align: left;
    max-width: 280px;
    word-wrap: break-word;
  }


  @media (max-width: 768px) {
    .header-top {
      flex-direction: column;
      align-items: flex-start;
    }
    thead th, td {

      font-size: 0.9rem;
    }
  }

  thead th:first-child {
    border-top-left-radius: 0.85rem;
  }

  thead th:last-child {
    border-top-right-radius: 0.85rem;
  }
.btn-delete {
    height: 30px;
    width: 30px;
    margin-left: 20px;
    border: 1px #e2a346 solid;
    color: #e2a346 ;

}
.action-btn {
  width: 38px;
  height: 38px;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;

  font-size: 1rem;
  transition: 0.3s ease;
}
/*modal style */
.form {
      background: #ffffff;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      padding: 1.8rem;
      border-radius: 20px;
      max-width: 500px;
      width: 100%;
    }

    h2 {
      text-align: center;
      color: #2d5c4a;
      margin-bottom: 1.2rem;
      font-size: 1.4rem;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .label {
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

    .button {
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

    .button:hover {
      background: #e2a346;
      transform: translateY(-1px);
    }
    .bt{
        position:absolute;
        top:10px; right:16px;
        background:none;
        border:1px #e2a346 solid;
        border-radius:50%; width:30px;

        color: #2d5c4a;
        height: 30px;
        cursor:pointer;
    }

    @media (max-width: 640px) {
      .grid {
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
  <div class="container">
             @if ($errors->has('voiture_id'))
    <div class="alert alert-danger">
        {{ $errors->first('voiture_id') }}
    </div>
@endif
<div class="header-top">
  <h2 class="page-title">Liste des missions</h2>
  <button id="openModalBtn" class="btn-create" type="button">+ Nouvelle mission</button>
</div>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Date de départ</th>
            <th>Date d'arriver</th>
            <th>Lieu de depart</th>
            <th>Lieu d'arriver</th>
            <th>Voiture</th>
            <th>Objet</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
  @forelse ($missions as $mission)
    <tr>
        <td>{{ $mission->date_depart }}</td>
        <td>{{ $mission->date_arrive }}</td>
        <td>{{ $mission->lieuDepart->nomLieu ?? '' }}</td>
        <td>{{ $mission->lieuArrive->nomLieu ?? '' }}</td>
        <td>{{ $mission->voiture->modele ?? '' }}</td>
        <td>{{ $mission->objet }}</td>
      <td>
        <a href="{{ route('mission.delete', $mission->id) }}" class="action-btn btn-delete">
          <i class="ri-delete-bin-line"></i>
        </a>
      </td>
    </tr>
  @empty
    <tr><td colspan="7">Aucun mission enregistré.</td></tr>
  @endforelse
</tbody>
      </table>
    </div>
  </div>
<!-- Modal Mission -->
<div id="missionModal" style="display:none; position:fixed; top:0; left:0; width:105vw; height:105vh; background:rgba(0,0,0,0.3); z-index:1000; justify-content:center; align-items:center;">
  <div style="background:#fff; border-radius:20px; position:relative;" class="form">
    <button id="closeModalBtn" class="bt">&times;</button>
    <form  id="trajetForm" method="POST" action="{{ route('mission.store') }}">
      @csrf
      <h2> Mission</h2>
      <div class="grid">
        <div>
          <label for="dateDepart"> Date de départ</label>
          <input type="date" id="dateDepart" name="date_depart" required>
        </div>
        <div>
          <label for="dateArrivee">Date d'arrivée</label>
          <input type="date" id="dateArrivee" name="date_arrive" required>
        </div>
        <div>
          <label for="">Lieu de départ</label>
          <select id="lieuDepart" name="lieu_depart" required>
            <option value="" disabled selected>-- Choisir --</option>
            @forelse ($trajets as $t)
              <option value="{{ $t->lieu_depart_id }}">{{ $t->lieuDepart->nomLieu  }}</option>
            @empty
              <option value="" disabled>Aucun lieu disponible</option>
            @endforelse
          </select>
        </div>
        <div>
          <label for="">Lieu d'arrivée</label>
          <select id="lieuArrivee" name="lieu_arrivee" required>
            <option value="" disabled selected>-- Choisir --</option>
            @forelse ($trajets as $t)
              <option value="{{ $t->lieu_arrive_id }}">{{ $t->lieuArrivee->nomLieu }}</option>
            @empty
              <option value="" disabled>Aucun lieu disponible</option>
            @endforelse
          </select>
        </div>
        <div>
  <label for="chauffeur_id">Chauffeur</label>
  <select id="chauffeur_id" name="chauffeur_id" required>
    <option value="" disabled selected>-- Choisir --</option>
@forelse ($chauffeurs as $c)
  <option value="{{ $c->id }}">
    {{ $c->users ? $c->users->first_name : 'Chauffeur inconnu' }}
  </option>
@empty
  <option value="" disabled>Aucun chauffeur disponible</option>
@endforelse
  </select>
</div>
<div>
        <label for="">Voiture proposée</label>
    <select name="voiture_id" required>
        <option value="">Voiture</option>
        @foreach($voitures as $voiture)
            <option value="{{ $voiture->id }}">{{ $voiture->modele }} ({{ $voiture->typeVehi }})</option>
        @endforeach
    </select>
      </div>
      </div>
      <div class="width mt-3">
        <label for="objet">Objet</label>
        <textarea id="objet" name="objet" placeholder="Motif..." required></textarea>
      </div>
      <div class="width">
        <button type="submit" class="button">Envoyer</button>
      </div>
    </form>
  </div>
</div>
</main>

@section('script')
<script>
  const modal = document.getElementById('missionModal');
  const openBtn = document.getElementById('openModalBtn');
  const closeBtn = document.getElementById('closeModalBtn');

  openBtn.onclick = () => modal.style.display = 'flex';
  closeBtn.onclick = () => modal.style.display = 'none';
  modal.onclick = function(e) {
    if (e.target === modal) modal.style.display = 'none';
  }
</script>
@endsection
</main>
@endsection
