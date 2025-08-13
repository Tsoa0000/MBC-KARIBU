@extends('app')
@include('partials.navbar')
@section('style')
    <style>
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
            margin-bottom: 2.5rem;
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

        .mission-liste {
            width: 100%;
            margin: -45px auto;
        }

        .mission {
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 10px;
            border-left: 5px solid #33897f;
            margin-bottom: 12px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: background 0.2s;
        }

        .mission:hover {
            background: #e7f6f3;
        }

        .mission-title {
            color: #267c69;
            font-weight: 600;
            font-size: 18px;
        }

        .fiches {
            display: none;
            margin-top: 10px;
            margin-left: 12px;
            color: #444;
            font-size: 14px;
            line-height: 1.5;
        }

        .fiche {
            margin-bottom: 20px;
            padding-left: 12px;
            border-left: 3px solid #33897f;
            background-color: #e6f2ee;
            border-radius: 8px;
            padding: 15px 20px;

        }

        .fiche h3 {
            margin-top: 0;
            font-size: 16px;
            margin-bottom: 10px;
            color: #267c69;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 8px 20px;
        }

        .detail-item {
            padding: 0;
            border: none;
            background: none;
        }

        .label {
            font-weight: 600;
            color: #33897f;
            display: block;
            margin-bottom: 2px;
        }

        @media (max-width: 600px) {
            .details {
                grid-template-columns: 1fr;
            }
        }

        .font {
            font-size: 30px;
            color: #33897f;

        }

        .mission-date-depart {
            color: #267c69;
            font-size: 12px;
            margin-top: 8px;
        }
    </style>
@endsection
@section('body')
    @php use Illuminate\Support\Str; @endphp

    <main class="main" id="main">
        <div class="container">

            <div class="header-top" style="display: flex; align-items: center; gap: 10px;">
                <h2 class="page-title">Liste des missions</h2>
                <a href="{{ url()->previous() }}" class="btn-retour" style="text-decoration: none; color: inherit;">
                    <i class="ri-arrow-left-circle-line font"></i>
                </a>

            </div>

            <div class="mission-liste">
                @foreach ($missions as $mission)
                    <div class="mission" onclick="toggleFiches('{{ Str::slug($mission['titre']) }}')">
                        <div class="mission-title">Mission {{ $mission['titre'] }}</div>

                        <div class="mission-date-depart">
                            <i class="ri-calendar-line"></i>
                            {{ \Carbon\Carbon::parse($mission['dtepart'])->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($mission['dtearive'])->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="fiches" id="{{ Str::slug($mission['titre']) }}" style="display: none;">
                        @foreach ($mission['items'] as $index => $fiche)
                            <div class="fiche">
                                <h3>Fiche {{ $index + 1 }} – {{ $fiche->user_name }} {{ $fiche->user_first_name }}</h3>
                                <div class="details">
                                    <div class="detail-item"><span class="label">Départ :</span> {{ $fiche->point_depart }}</div>
                                    <div class="detail-item"><span class="label">Destination :</span> {{ $fiche->destination }}</div>
                                    <div class="detail-item"><span class="label">Motif :</span> {{ $fiche->motif }}</div>
                                    <div class="detail-item"><span class="label">Km Départ :</span> {{ $fiche->dep_km }}</div>
                                    <div class="detail-item"><span class="label">Km Arrivée :</span> {{ $fiche->arr_km }}</div>
                                    <div class="detail-item"><span class="label">Km Effectuée :</span> {{ $fiche->km_effec }}</div>
                                    <div class="detail-item"><span class="label">Heure Départ :</span> {{ $fiche->heure_depart }}</div>
                                    <div class="detail-item"><span class="label">Heure Arrivée :</span> {{ $fiche->heure_arrivee }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function toggleFiches(id) {
            const allFiches = document.querySelectorAll('.fiches');
            allFiches.forEach(f => f.style.display = (f.id === id && f.style.display !== 'block') ? 'block' : 'none');
        }
    </script>
    <script>
        function toggleFiches(id) {
            const el = document.getElementById(id);
            el.style.display = el.style.display === "none" || el.style.display === "" ? "block" : "none";
        }
    </script>
@endsection
