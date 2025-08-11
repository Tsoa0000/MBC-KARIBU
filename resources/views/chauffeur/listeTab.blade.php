@extends('app')
@include('partials.navbar')
@section('style')
    <style>
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

        h1 {
            text-align: center;
            color: #e2a346;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .missions {
            width: 100%;

            margin: auto;
            max-height: 600px;
            overflow-y: auto;
            padding-right: 10px;
            border: 1px solid #cce0d9;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .mission {
            border-bottom: 1px solid #dbe8e3;

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
            color: #2d5c4a;
        }


        .mission:last-child {
            border-bottom: none;
        }

        .mission-header {
            cursor: pointer;
            background: #e8f5ef;
            padding: 16px 22px;
            font-weight: bold;
            color: #2d5c4a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .mission-header:hover {
            background: #d3ebdf;
        }

        .arrow {
            border: solid #33897F;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 6px;
            transform: rotate(45deg);
            transition: transform 0.3s ease;
        }

        .arrow.down {
            transform: rotate(-135deg);
        }

        .mission-content {
            padding: 16px 22px;
            display: none;
            background: #fbfbfb;
            font-size: 15px;
            color: #2d5c4a;
        }

        .ligne {
            display: flex;
            margin-bottom: 8px;
        }

        .label {
            width: 180px;
            font-weight: 600;
            color: #33897F;
        }

        .value {
            flex: 1;
            color: #2d5c4a;
        }

        .signature {
            margin-top: 15px;
            text-align: right;
            font-style: italic;
            color: #888;
        }

        .missions::-webkit-scrollbar {
            width: 6px;
        }

        .missions::-webkit-scrollbar-track {
            background: #f0f0f0;
        }

        .missions::-webkit-scrollbar-thumb {
            background: #e2a346;
            border-radius: 10px;
        }

        .btn-retour {
            position: fixed;
            top: 85px;
            right: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: #f5f5f5;
            border-radius: 50%;
            box-shadow: 3px 3px 5px #d1d9e6, -5px -5px 10px #ffffff;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #333;
            z-index: 9999;
        }

        .btn-retour:hover {
            box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #ffffff;
            color: #000;
            background: #eaeaea;
        }
    </style>
@endsection
@section('body')
    <main class="main" id="main">

        <div class="container">
            <a href="{{ url()->previous() }}" class="btn-retour" title="Retour">
                <svg width="25" height="25" fill="none" color="#2d4c5F" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                    <line x1="19" y1="12" x2="5" y2="12" />
                    <polyline points="12 19 5 12 12 5" />
                </svg>
            </a>

            <div class="header-top">
                <h2 class="page-title">Fiche de bord</h2>
                @if (\Carbon\Carbon::parse($mission->date_arrive)->isFuture())
                    <button class="btn-create"
                        onclick="window.location.href='{{ route('tabbord.create', $mission->id) }}'">+ Nouvelle
                        fiche</button>
                @endif
            </div>

            <h3 class="mission-title" style=" margin-bottom: 1rem; color: #33897F;">
                Mission : {{ $mission->lieuDepart->nomLieu ?? 'Inconnu' }} - {{ $mission->lieuArrive->nomLieu ?? 'Inconnu' }}
            </h3>

            @php $totalParcouru = 0; @endphp

            <div class="missions">
                @forelse ($tabbords as $tab)
                    @php
                        $totalParcouru += $tab->km_effec;
                    @endphp
                    <div class="mission">
                        <div class="mission-header" onclick="toggleMission(this)">
                            Fiche - {{ $tab->date }}
                            <i class="arrow"></i>
                        </div>
                        <div class="mission-content">
                            <div class="ligne">
                                <div class="label">Départ</div>
                                <div class="value">{{ $tab->point_depart }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Destination</div>
                                <div class="value">{{ $tab->destination }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Motif</div>
                                <div class="value">{{ $tab->motif }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Km Départ</div>
                                <div class="value">{{ $tab->dep_km }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Km Arrivée</div>
                                <div class="value">{{ $tab->arr_km }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Heure Départ</div>
                                <div class="value">{{ $tab->heure_depart }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Heure Arrivée</div>
                                <div class="value">{{ $tab->heure_arrivee }}</div>
                            </div>
                            <div class="ligne">
                                <div class="label">Km Effectué</div>
                                <div class="value">{{ number_format($tab->km_effec, 2) }} km</div>
                            </div>
                            <div class="signature">
                                Signature : {{ $tab->user ? $tab->user->name . ' ' . $tab->user->first_name : 'Utilisateur inconnu' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="ligne text-center" colaps='7'>Aucune fiche</div>
                @endforelse
            </div>

            <div style=" margin-top: 1.5rem; font-weight: bold; color: #33897F; font-size: 1rem;" class="text-center">
                Distance parcourue : {{ number_format($totalParcouru, 2) }} km
            </div>
        </div>

    </main>
@endsection

@section('script')
    <script>
        function toggleMission(header) {
            const content = header.nextElementSibling;
            const arrow = header.querySelector('.arrow');
            const isOpen = content.style.display === 'block';

            document.querySelectorAll('.mission-content').forEach(c => c.style.display = 'none');
            document.querySelectorAll('.arrow').forEach(a => a.classList.remove('down'));

            if (!isOpen) {
                content.style.display = 'block';
                arrow.classList.add('down');
            }
        }
    </script>
@endsection

