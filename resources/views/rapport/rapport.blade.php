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

        .btn-ajouter {
            background: #33897f;
            color: white;
            padding: 0.65rem 1.6rem;
            font-weight: 600;
            border-radius: 0.8rem;
            font-size: 1rem;
            text-decoration: none;
            box-shadow: 0 6px 14px rgba(51, 137, 127, 0.15);
            transition: all 0.3s ease;
        }

        .btn-ajouter:hover {
            background: #e2a346;
            color: #2d5c4a;
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
            width: 150px;
            text-align: center;
            font-weight: 600;
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
            width: 150px;
            text-align: center;
            font-size: 1rem;
            text-transform: capitalize;
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
                <h2 class="page-title">Rapport</h2>
                <a href="" class="btn-ajouter">
                    <i class="ri-download-2-line"> </i> Telecharger
                </a>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date de depart</th>
                            <th>Lieu </th>
                            <th>Heure de depart</th>
                            <th>Chauffeur</th>
                            <th>Voiture</th>
                            <th>Kilometrage</th>
                            <th>Durée de mission</th>
                            <th>Objet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rapports as $rapport)
                            <tr>
                                <td> {{$rapport->date_mission}} </td>
                            <td>{{ $lieux[$rapport->lieu_depart] ?? 'Inconnu' }} - {{ $lieux[$rapport->lieu_arrive] ?? 'Inconnu' }} </td>

                                <td>{{$rapport->heure_depart}}</td>
                                <td>{{ $chauffeurs[$rapport->chauffeur_id] ?? 'Inconnu' }}</td>

                                <td> {{$voiture[$rapport->voiture_id]}} </td>
                                <td> {{$rapport->kilometrage}} Km</td>
                                <td> {{$rapport->duree}} jour(s) </td>
                                <td> {{$rapport->objet}} </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun rapport</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

    </main>
@endsection
@section('script')
    <script></script>
@endsection
