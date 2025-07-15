@extends('app')
@include('partials.navbar')

@section('style')
<link rel="stylesheet" href="{{ asset('asset/css/voiture/style.css') }}">
@endsection

@section('body')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item active">Tableau de bord</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="d-flex justify-content-end mb-4">
    <a href="{{ route('voiture.ajout') }}" class="btn btn-ajouter">
      <i class="ri-add-circle-line me-2"></i> Ajouter une voiture
    </a>
  </div>

  <div class="table-responsive">
    <table class="table voiture-table align-middle mb-0">
      <thead>
        <tr>
          <th class="couleur">Immatriculation</th>
          <th>Modèle</th>
          <th>Type</th>
          <th>État</th>
          <th>Consommation</th>
          <th>Places</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($voiture as $v)
        <tr data-id="{{ $v['id'] }}">
          <td>
            <span class="view-mode">{{ $v['matricule'] }}</span>
            <input class="edit-mode form-control form-control-sm d-none" type="text" name="matricule" value="{{ $v['matricule'] }}" />
          </td>
          <td>
            <span class="view-mode">{{ $v['modele'] }}</span>
            <input class="edit-mode form-control form-control-sm d-none" type="text" name="modele" value="{{ $v['modele'] }}" />
          </td>
          <td>
            <span class="view-mode">{{ $v['typeVehi'] }}</span>
            <input class="edit-mode form-control form-control-sm d-none" type="text" name="typeVehi" value="{{ $v['typeVehi'] }}" />
          </td>
          <td>
            <span class="badge bg-{{ $v['etat'] >= 7 ? 'success' : ($v['etat'] >= 4 ? 'warning' : 'danger') }} view-mode">
              {{ $v['etat'] }}/10
            </span>
            <input class="edit-mode form-control form-control-sm d-none" type="number" min="0" max="10" name="etat" value="{{ $v['etat'] }}" />
          </td>
          <td>
            <span class="view-mode">{{ $v['conso'] }}</span>
            <input class="edit-mode form-control form-control-sm d-none" type="number" name="conso" value="{{ $v['conso'] }}" />
          </td>
          <td>
            <span class="view-mode">{{ $v['nbrPlace'] }}</span>
            <input class="edit-mode form-control form-control-sm d-none" type="number" name="nbrPlace" value="{{ $v['nbrPlace'] }}" />
          </td>
          <td class="text-center">
            <button class="btn btn-sm btn-outline-primary btn-edit">Modifier</button>
            <button class="btn btn-sm btn-outline-success btn-save d-none">Valider</button>
            <button class="btn btn-sm btn-outline-secondary btn-cancel d-none">Annuler</button>
            <a href="{{ route('voiture.delete', $v['id']) }}" class="btn btn-sm btn-outline-danger">
              <i class="ri-delete-bin-line"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</main>
@endsection

@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', () => {

  // Bouton Modifier (passe en mode édition)
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
      const tr = btn.closest('tr');
      toggleEditMode(tr, true);
    });
  });

  // Bouton Annuler (annule la modification)
  document.querySelectorAll('.btn-cancel').forEach(btn => {
    btn.addEventListener('click', () => {
      const tr = btn.closest('tr');
      // Remet les valeurs des inputs à celles affichées (span)
      tr.querySelectorAll('input.edit-mode').forEach(input => {
        const span = tr.querySelector(`.view-mode:nth-child(${input.parentElement.cellIndex + 1})`);
        if (span) input.value = span.textContent.trim();
      });
      toggleEditMode(tr, false);
    });
  });

  // Bouton Valider (enregistre via AJAX)
  document.querySelectorAll('.btn-save').forEach(btn => {
    btn.addEventListener('click', () => {
      const tr = btn.closest('tr');
      saveRow(tr);
    });
  });

});

function toggleEditMode(tr, editMode) {
  tr.querySelectorAll('.view-mode').forEach(el => el.classList.toggle('d-none', editMode));
  tr.querySelectorAll('.edit-mode').forEach(el => el.classList.toggle('d-none', !editMode));

  tr.querySelector('.btn-edit').classList.toggle('d-none', editMode);
  tr.querySelector('.btn-save').classList.toggle('d-none', !editMode);
  tr.querySelector('.btn-cancel').classList.toggle('d-none', !editMode);
}

function saveRow(tr) {
  const id = tr.dataset.id;
  const data = {};
  tr.querySelectorAll('.edit-mode').forEach(input => {
    data[input.name] = input.value;
  });

  fetch(`/voiture/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (!response.ok) throw new Error('Erreur réseau');
    return response.json();
  })
  .then(json => {
    if (json.success) {
      // Mise à jour des spans affichés avec nouvelles valeurs
      tr.querySelectorAll('.edit-mode').forEach(input => {
        const span = tr.querySelector(`.view-mode[name="${input.name}"]`);
        if (span) span.textContent = input.value;
      });
      // Mise à jour spéciale badge état (couleur + texte)
      const badge = tr.querySelector('td:nth-child(4) .badge');
      if (badge) {
        const etat = parseInt(data.etat);
        badge.className = 'badge bg-' + (etat >= 7 ? 'success' : (etat >= 4 ? 'warning' : 'danger'));
        badge.textContent = etat + '/10';
      }
      toggleEditMode(tr, false);
    } else {
      alert('Erreur lors de la sauvegarde: ' + (json.message || ''));
    }
  })
  .catch(err => {
    alert('Erreur lors de la sauvegarde: ' + err.message);
  });
}
</script>
@endsection
