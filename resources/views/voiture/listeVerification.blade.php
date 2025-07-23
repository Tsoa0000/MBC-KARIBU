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
            text-decoration: none;
            border-radius: 0.8rem;
            font-weight: 600;
            box-shadow: 0 7px 16px rgba(51, 137, 127, 0.1);
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

        .ok {
            color: #33897f;
            font-weight: 700;
        }

        .nok {
            color: #e53935;
            font-weight: 700;
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
    </style>
@endsection

@section('body')
    <main id="main" class="main">
        <div class="container">

            <div class="header-top">
                <h2 class="page-title">Liste des vérifications de véhicules</h2>
                <a href="{{ route('verification.form') }}" class="btn-create">+ Nouvelle vérification</a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Voiture</th>
                            <th>Date</th>
                            <th>Papier</th>
                            <th>Moteur</th>
                            <th>Freins</th>
                            <th>Transmission</th>
                            <th>Pneu</th>
                            <th>Observation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($verifications as $v)
                            <tr>
                                <td>{{ $v->voiture->matricule }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->dateVerif)->format('d/m/Y') }}</td>
                                <td class="{{ $v->papierVehi ? 'ok' : 'nok' }}">{{ $v->papierVehi ? 'OUI' : 'NON' }}</td>
                                <td class="{{ $v->huileMoteur ? 'ok' : 'nok' }}">{{ $v->huileMoteur ? 'OUI' : 'NON' }}</td>
                                <td class="{{ $v->lockeed ? 'ok' : 'nok' }}">{{ $v->lockeed ? 'OUI' : 'NON' }}</td>
                                <td class="{{ $v->eau ? 'ok' : 'nok' }}">{{ $v->eau ? 'OUI' : 'NON' }}</td>
                                <td class="{{ $v->pneu ? 'ok' : 'nok' }}">{{ $v->pneu ? 'OUI' : 'NON' }}</td>
                                <td>{{ $v->obs }}</td>
                                <td>
                                    <a href="{{ route('verification.delete', $v['id']) }}" class="action-btn btn-delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Aucune vérification enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
