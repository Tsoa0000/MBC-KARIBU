@extends('app')
@include('partials.navbar')

@section('style')
    <link rel="stylesheet" href="{{ asset('asset/css/voiture/style.css') }}">
    <style>
        @import url('https://fonts.cdnfonts.com/css/skia');

        .modal-content {
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            font-family: 'Skia', sans-serif;
            font-size: 0.9rem;
            border: none;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 1rem 1rem;
        }

        .modal-header .modal-title {
            color: #2d5c4a;
            font-weight: 600;
        }

        .modal-body input {
            border: none;
            border-bottom: 1px solid #2d5c4a;
            border-radius: 0;
            outline: none;
            box-shadow: none;
            background-color: transparent;
            margin-top: -10px;
            transition: border-bottom 0.3s;
        }

        .modal-body input:hover,
        .modal-body input:focus {
            border-bottom: 1px solid #33897f;
        }

        .form-label {
            color: #2d5c4a;
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

        .btn-annuler {
            background-color: #e2a346;
            color: white;
            border-radius: 0.6rem;
            font-weight: 600;
            padding: 0.45rem 1rem;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-annuler:hover {
            background-color: #2d5c4a;
            color: #fff;
        }

        .btn-primary {
            background-color: #33897f;
            color: white;
            border-radius: 0.6rem;
            font-weight: 600;
            padding: 0.45rem 1rem;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2d5c4a;
            color: white;
        }

        .btn-close {
            background-color: #e2a346;
            border-radius: 50%;
            opacity: 1;
            transition: 0.3s ease;
        }

        .btn-close:hover {
            background-color: #2d5c4a;
        }
    </style>
@endsection

@section('body')
    <main id="main" class="main">

        <div class="container">

            <div class="header-top">
                <h1 class="page-title">Liste des voitures</h1>
                <a href="{{ route('voiture.ajout') }}" class="btn-ajouter">
                    + Ajouter une voiture
                </a>
            </div>

            <div class="table-wrapper">
                <table class="table voiture-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Immatriculation</th>
                            <th>Modèle</th>
                            <th>Type</th>
                            <th>État</th>
                            <th>Consommation</th>
                            <th>Places</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($voiture as $v)
                            <tr>
                                <td>{{ $v['matricule'] }}</td>
                                <td>{{ $v['modele'] }}</td>
                                <td>{{ $v['typeVehi'] }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $v['etat'] >= 7 ? 'success' : ($v['etat'] >= 4 ? 'warning' : 'danger') }}">
                                        {{ $v['etat'] }}/10
                                    </span>
                                </td>
                                <td>{{ $v['conso'] }}</td>
                                <td>{{ $v['nbrPlace'] }}</td>
                                <td class="text-center">
                                    <a href="#" class="action-btn btn-edit me-2" data-bs-toggle="modal"
                                        data-bs-target="#modifierVoitureModal"
                                        onclick='remplirModal(@json($v))'>
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    <a href="{{ route('voiture.delete', $v['id']) }}" class="action-btn btn-delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Aucune voiture enregistrée.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modifierVoitureModal" tabindex="-1" aria-labelledby="modifierVoitureLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <form method="POST" id="modifierForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifierVoitureLabel">Modifier la voiture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="edit-id">

                                <div class="mb-3">
                                    <label for="edit-matricule" class="form-label">Immatriculation</label>
                                    <input type="text" name="matricule" id="edit-matricule" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-modele" class="form-label">Modèle</label>
                                    <input type="text" name="modele" id="edit-modele" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-type" class="form-label">Type</label>
                                    <input type="text" name="typeVehi" id="edit-type" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-etat" class="form-label">État (0-10)</label>
                                    <input type="number" name="etat" id="edit-etat" class="form-control" min="0"
                                        max="10" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-conso" class="form-label">Consommation</label>
                                    <input type="text" name="conso" id="edit-conso" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-nbrPlace" class="form-label">Nombre de places</label>
                                    <input type="number" min="2" max="100" name="nbrPlace" id="edit-nbrPlace"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-annuler" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </main>
@endsection

@section('script')
    <script>
        function remplirModal(data) {
            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-matricule').value = data.matricule;
            document.getElementById('edit-modele').value = data.modele;
            document.getElementById('edit-type').value = data.typeVehi;
            document.getElementById('edit-etat').value = data.etat;
            document.getElementById('edit-conso').value = data.conso;
            document.getElementById('edit-nbrPlace').value = data.nbrPlace;

            const form = document.getElementById('modifierForm');
            form.action = `/voiture/${data.id}`;
        }
    </script>
@endsection
