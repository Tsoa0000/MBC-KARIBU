@extends('app')
@include('partials.navbar')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

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

        .btn-create:hover {
            background: #e2a346;
            color: #2d5c4a
        }


        .table-wrapper {
            overflow-x: auto;
            border-radius: 1rem;
              margin-top: -30px;
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
            text-transform: capitalize;

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

            thead th,
            td {
                text-transform: capitalize;
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
            color: #e2a346;

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
            margin-bottom: 1rem;
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

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border-radius: 14px;
            border: none;
            box-shadow: inset 2px 1px 4px #c1d1db, inset -3px -3px 6px #ffffff;
            font-size: 0.95rem;


        }
        .select {
    text-transform: capitalize;
    width: 100%;
    padding: 0.65rem 0.9rem;
    border-radius: 14px;
    border: none;
    box-shadow: inset 2px 1px 4px #c1d1db, inset -3px -3px 6px #ffffff;
    font-size: 0.95rem;
}

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px #33897f;
            background: #f0fbff;
        }

        select:hover,
        input:hover,
        textarea:hover {
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

        .bt {
            position: absolute;
            top: 10px;
            right: 16px;
            background: none;
            border: 1px #e2a346 solid;
            border-radius: 50%;
            width: 30px;

            color: #2d5c4a;
            height: 30px;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }
        }

.select2-container--default .select2-selection--single {
    background-color: #f0f4f8;
    border: none;
    border-radius: 14px;
    box-shadow: inset 2px 1px 4px #c1d1db, inset -3px -3px 6px #ffffff;
    padding: 8px 12px;
    height: auto;
    font-size: 0.95rem;
    text-transform: capitalize;
    display: flex;
    align-items: center;
}


.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #333;
    line-height: 1.5;
    padding-left: 4px;
}

.select2-container--default .select2-selection--single:focus {
    outline: none;
    box-shadow: inset 2px 1px 4px #c1d1db, inset -3px -3px 6px #ffffff;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
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
            @if ($errors->has('chauffeur_id'))
                <div class="alert alert-danger">
                    {{ $errors->first('chauffeur_id') }}
                </div>
            @endif
            <div class="header-top">
                <h2 class="page-title">Liste des missions</h2>
                @if (Auth::check() &&  Auth::user()->role === '0' || Auth::user()->role === '5' )
                <button id="openModalBtn" class="btn-create" type="button">+ Nouvelle mission</button>
                @endif
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date de mission</th>
                            <th>Chauffeur</th>
                            <th>Lieu du mission</th>
                            <th>Voiture</th>
                            <th id="obs-cell">objet</th>
                            @if (Auth::check() && Auth::user()->role === '0')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($missions as $mission)
                            <tr>
                                <td>{{ $mission->date_depart }} / {{ $mission->date_arrive }}</td>
                                <td>
                                    @if ($mission->chauffeur)
                                        {{ $mission->chauffeur->name }} {{ $mission->chauffeur->first_name }}
                                    @else
                                        <div class="alert alert-danger p-1 m-0" role="alert">
                                            Chauffeur non assigné !
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $mission->lieuDepart->nomLieu }}-{{ $mission->lieuArrive->nomLieu }}</td>
                                <td>{{ $mission->voiture->modele ?? '' }}</td>
                                <td>{{ $mission->objet }}</td>
                                @if (Auth::check() && Auth::user()->role === '0')
                                <td>
                                    <a href="{{ route('mission.delete', $mission->id) }}" class="action-btn btn-delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Aucune mission enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div id="missionModal"
            style="display:none; position:fixed; top:0; left:0; width:105vw; height:105vh; background:rgba(0,0,0,0.3); z-index:1000; justify-content:center; align-items:center;">
            <div style="background:#fff; border-radius:20px; position:relative;" class="form">
                <button id="closeModalBtn" class="bt">&times;</button>
                <form id="trajetForm" method="POST" action="{{ route('mission.store') }}">
                    @csrf
                    <h2> Mission</h2>
                    <div class="grid">
                        <div >
                            <label for="date_depart">Date de départ</label>
                            <input type="date" name="date_depart" id="date_depart" class="form-control" min="{{ date('Y-m-d') }}">
                            <div class="invalid-feedback" id="dateDepartError" style="display: none;">
                                La date de départ doit être aujourd'hui ou une date future.
                            </div>
                        </div>

                        <div>
                            <label for="date_arrive">Date d'arrivée</label>
                            <input type="date" name="date_arrive" id="date_arrive" class="form-control" min="{{ date('Y-m-d') }}">
                            <div class="invalid-feedback" id="dateArriveError" style="display: none;">
                                La date d'arrivée doit être après ou égale à la date de départ.
                            </div>
                        </div>
                        <div >
                            <label for="trajet_id" >Lieu</label>
                            <select id="trajet_id" name="trajet_id" class="select2" required>
                                <option value="" disabled selected>--Choisir--</option>
                                @forelse ($trajets as $t)
                                    <option value="{{ $t->lieu_depart_id }} - {{ $t->lieu_arrive_id }}">
                                        {{ $t->lieuDepart->nomLieu ?? '' }} - {{ $t->lieuArrivee->nomLieu ?? '' }}
                                    </option>
                                @empty
                                    <option value="" disabled>Aucun trajet disponible</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <label for="chauffeur_id">Chauffeur</label>
                            <select id="chauffeur_id" name="chauffeur_id" class="@error('chauffeur_id') is-invalid @enderror" required>
                                @foreach ($chauffeurs as $c)
                                <option value="" disabled selected>--Choisir--</option>
                                    <option value="{{ $c->id }}"
                                        @if (!$c->disponible) disabled style="color:red;" @endif
                                        @if (old('chauffeur_id') == $c->id) selected @endif>
                                         {{ $c->first_name }}
                                        @if (!$c->disponible) - Indisponible @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('chauffeur_id')
                                <div style="color:red; font-style: italic;">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>
                    <div id="typeRouteDisplay" style="color: #2d5c4a; font-style: italic; display: none;"></div>
                    <div>
                        <label for="voiture_id">Voiture proposée</label>
                        <select id="voitureSelect" name="voiture_id" class="form-control @error('voiture_id') is-invalid @enderror" required>
                            @foreach ($voitures as $v)
                            <option value="" disabled selected>--Choisir--</option>
                                <option value="{{ $v->id }}"
                                    data-type="{{ $v->typeVehi }}"
                                    @if (!$v->disponible) disabled style="color:red;" @endif
                                    @if (old('voiture_id') == $v->id) selected @endif>
                                    {{ $v->modele }} ({{ $v->typeVehi }})
                                    @if (!$v->disponible) -  Indisponible @endif
                                </option>
                            @endforeach
                        </select>
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
@endsection
@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {

            const modal = document.getElementById('missionModal');
            const openBtn = document.getElementById('openModalBtn');
            const closeBtn = document.getElementById('closeModalBtn');

            openBtn.onclick = () => modal.style.display = 'flex';
            closeBtn.onclick = () => modal.style.display = 'none';
            modal.onclick = function (e) {
                if (e.target === modal) modal.style.display = 'none';
            };

            $('select[name="trajet_id"]').select2({
                placeholder: "--Choisir un trajet--",
                allowClear: true,
                width: '100%'
            });

            const dateDepartInput = $('#date_depart');
            const dateArriveInput = $('#date_arrive');
            const dateDepartError = $('#dateDepartError');
            const dateArriveError = $('#dateArriveError');

            function validateDates() {
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                const dateDepart = new Date(dateDepartInput.val());
                const dateArrive = new Date(dateArriveInput.val());

                if (dateDepartInput.val() && dateDepart < today) {
                    dateDepartInput.addClass('is-invalid');
                    dateDepartError.show();
                } else {
                    dateDepartInput.removeClass('is-invalid');
                    dateDepartError.hide();
                }

                if (dateArriveInput.val()) {
                    if (dateArrive < today || dateArrive < dateDepart) {
                        dateArriveInput.addClass('is-invalid');
                        dateArriveError.show();
                    } else {
                        dateArriveInput.removeClass('is-invalid');
                        dateArriveError.hide();
                    }
                }
            }

            dateDepartInput.on('change', function () {
                if (dateDepartInput.val()) {
                    dateArriveInput.attr('min', dateDepartInput.val());
                }
                validateDates();
            });

            dateArriveInput.on('change', validateDates);


            const voitureSelect = document.getElementById("voitureSelect");
            const typeRouteDisplay = document.getElementById("typeRouteDisplay");
            const lieuSelect = document.querySelector('select[name="trajet_id"]');

            const trajets = [
                @foreach ($trajets as $t)
                    {
                        departId: "{{ $t->lieu_depart_id }}",
                        arriveId: "{{ $t->lieu_arrive_id }}",
                        typeRoute: "{{ strtolower($t->typeRoute) }}"
                    },
                @endforeach
            ];

            const originalVoitures = Array.from(voitureSelect.querySelectorAll("option")).slice(1);

            const compatibilite = {
                "goudronnée": ["berline", "suv", "pick-up", "4x4", "minibus", "camionnette"],
                "mixte": ["4x4", "suv", "camionnette", "pick-up", "berline"],
                "secondaire": ["4x4", "pick-up", "camionnette"]
            };

            lieuSelect.addEventListener("change", function () {
                const selected = this.value.trim();
                const [departId] = selected.split(" - ");

                voitureSelect.innerHTML = '<option value="">-- Choisir une voiture --</option>';
                typeRouteDisplay.textContent = "";

                const trajet = trajets.find(t => t.departId === departId);

                if (!trajet) return;

                const typeRoute = trajet.typeRoute;
                const typesAcceptes = compatibilite[typeRoute] || [];

                typeRouteDisplay.textContent = "Type de route détecté : " + typeRoute;

                originalVoitures.forEach(opt => {
                    const typeVoiture = opt.getAttribute("data-type").toLowerCase();
                    if (typesAcceptes.includes(typeVoiture)) {
                        voitureSelect.appendChild(opt.cloneNode(true));
                    }
                });
            });
        });
    </script>
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateDepartInput = document.getElementById('date_depart');
        const dateArriveInput = document.getElementById('date_arrive');

        function checkDisponibilite() {
            const dateDepart = dateDepartInput.value;
            const dateArrive = dateArriveInput.value;

            if (dateDepart && dateArrive) {
                fetch("{{ route('check.disponibilite') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        date_depart: dateDepart,
                        date_arrive: dateArrive
                    })
                })
                .then(response => response.json())
                .then(data => {

                    const voitureSelect = document.getElementById('voitureSelect');
                    voitureSelect.innerHTML = '<option value="">-- Choisir une voiture --</option>';

                    data.voitures.forEach(v => {
                        const option = document.createElement('option');
                        option.value = v.id;
                        option.textContent = `${v.modele} (${v.typeVehi})${v.disponible ? '' : ' - Indisponible'}`;
                        if (!v.disponible) {
                            option.disabled = true;
                            option.style.color = 'red';
                        }
                        voitureSelect.appendChild(option);
                    });


                    const chauffeurSelect = document.getElementById('chauffeur_id');
                    chauffeurSelect.innerHTML = '<option value="">-- Choisir --</option>';

                    data.chauffeurs.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.textContent = `${c.name} ${c.first_name}${c.disponible ? '' : ' - Indisponible'}`;
                        if (!c.disponible) {
                            option.disabled = true;
                            option.style.color = 'red';
                        }
                        chauffeurSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Erreur lors de la vérification de disponibilité :", error);
                });
            }
        }

        dateDepartInput.addEventListener('change', checkDisponibilite);
        dateArriveInput.addEventListener('change', checkDisponibilite);
    });
</script>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const obsCells = document.querySelectorAll('td:nth-child(8)');
        obsCells.forEach(cell => {
            const text = cell.textContent.trim();
            cell.textContent = text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
        });
    });
</script>
@endsection
