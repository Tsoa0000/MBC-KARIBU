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
                <h2 class="page-title">Liste des Chauffeurs</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom(s)</th>
                            <th>Email</th>
                            <th>Numéro de permis</th>
                            <th>Date de validité</th>
                            <th>Catégorie</th>
                            <th>CIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($chauffeurs as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->first_name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->detailChauff->numeroPermis }}</td>
                                <td>{{ $c->detailChauff->dateValidite }}</td>
                                <td>
                                    @if (isset($c->detailChauff->typePermis))
                                        {{ is_array($c->detailChauff->typePermis) ? implode(', ', $c->detailChauff->typePermis) : $c->detailChauff->typePermis }}
                                    @else
                                        Non renseigné
                                    @endif
                                </td>

                                <td>{{ $c->detailChauff->cin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun chauffeur trouvé.</td>
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
