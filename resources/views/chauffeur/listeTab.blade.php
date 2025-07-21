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
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-block;
        }

        .badge.signed {
            background-color: #d1f5e4;
            color: #23725c;
        }

        .badge.unsigned {
            background-color: #fddede;
            color: #a83232;
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
            border: 1px solid #e2a346;
            color: #e2a346;
            background: none;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #e2a346;
            color: white;
        }

        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                align-items: flex-start;
            }

            thead th,
            td {
                font-size: 0.9rem;
            }
        }

        thead th:first-child {
            border-top-left-radius: 0.85rem;
        }

        thead th:last-child {
            border-top-right-radius: 0.85rem;
        }
    </style>
@endsection
@section('body')
    <main class="main" id="main">
        <div class="container">
        <div class="header-top">
        <h2 class="page-title">Tableau de bord</h2>
        <<button class="btn-create" onclick="window.location.href='{{ route('tabbord.create') }}'">+ Nouveau fiche</button>
        </div>


            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Chauffeur</th>
                            <th>Départ</th>
                            <th>Destination</th>
                            <th>Motif</th>
                            <th>Km Départ</th>
                            <th>Km Arrivée</th>
                            <th>Heure Départ</th>
                            <th>Heure Arrivée</th>
                            <th>Km Effectué</th>
                            <th>Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tabbords as $tab)
                            <tr>
                                <td> {{ $tab->date }} </td>
                                <td>
                                    {{ $tab->user ? $tab->user->name . ' ' . $tab->user->first_name : 'Utilisateur inconnu' }}
                                </td>
                                <td> {{ $tab->point_depart }} </td>
                                <td> {{ $tab->destination }} </td>
                                <td> {{ $tab->motif }} </td>
                                <td> {{ $tab->dep_km }} </td>
                                <td> {{ $tab->arr_km }} </td>
                                <td> {{ $tab->heure_depart }} </td>
                                <td> {{ $tab->heure_arrivee }} </td>
                                <td> {{ $tab->km_effec }} </td>
                                <td>
                                    <span class="badge {{ $tab->signature ? 'signed' : 'unsigned' }}">
                                        {{ $tab->signature ? 'Signé' : 'Non signé' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Aucune fiche de tableau de bord trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
@section('script')
@endsection
