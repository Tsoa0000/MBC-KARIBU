@extends('app')
@include('partials.navbar')

@section('style')
    <style>
        @import url('https://fonts.cdnfonts.com/css/skia');

        :root {
            --primary: #33897f;
            --dark: #2d5c4a;
            --bg: #f5f9f8;
            --white: #fff;
            --radius: 1.5rem;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Skia', sans-serif;
            background: var(--bg);
            color: var(--dark);
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 960px;
            margin: auto;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2rem;
        }

        .form {
            display: flex;
            flex-wrap: nowrap;
            gap: 1.25rem;
            align-items: flex-end;
            margin-bottom: 2rem;
        }

        .form-group {
            flex: 1 1 220px;
            position: relative;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 1.2rem 1rem 0.6rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 1rem;
            background: var(--white);
        }

        .form-group label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1rem;
            color: #888;
            background: var(--white);
            padding: 0 0.25rem;
            transition: 0.2s;
            pointer-events: none;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label,
        .form-group select:focus + label,
        .form-group select:not([value=""]) + label {
            top: -0.6rem;
            left: 0.8rem;
            font-size: 0.8rem;
            color: var(--primary);
        }

        .form-action {
            display: flex;
            align-items: center;
            height: 100%;
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.9rem 2rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 999px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(51, 137, 127, 0.25);
            transition: all 0.25s ease;
        }

        button:hover {
            background: #e2a346;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(226, 163, 70, 0.35);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(226, 163, 70, 0.3);
        }

        .divider {
            height: 1px;
            background: #e0e5e3;
            margin: 0rem 0 1rem;
        }

        .page-title {
            font-size: 1.7rem;
            font-weight: 600;
            color: #2a736d;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e2a346;
            width: fit-content;
            padding-bottom: 0.3rem;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 1rem;
        }

        table.voiture-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 14px;
        }

        thead th {
            background: #2d5c4a !important;
            color: #fff !important;
            padding: 1.1rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        thead th:first-child {
            border-top-left-radius: 0.85rem;
        }

        thead th:last-child {
            border-top-right-radius: 0.85rem;
        }

        td {
            text-transform: capitalize;
            padding: 1rem;
            text-align: center !important;
            color: #2d5c4a !important;
            vertical-align: middle;
        }

        tbody tr {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        tbody tr:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-delete {
            height: 30px;
            width: 30px;
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

        @media (max-width: 768px) {
            .form {
                flex-wrap: wrap;
            }

            .form-group {
                flex: 1 1 100%;
            }

            .form-action {
                flex: 1 1 100%;
                display: flex;
                justify-content: center;
                margin-top: 1rem;
            }

            button {
                width: 100%;
                max-width: 220px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection

@section('body')
    <main id="main" class="main">
        <div class="container">
            <div class="card">

                @if (Auth::check() && (Auth::user()->role === '0' || Auth::user()->role === '5'))
                    <h2 class="page-title">Ajouter un trajet</h2>

                    <form action="{{ route('trajet.store') }}" method="POST" class="form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="lieu_depart" placeholder=" " required autocomplete="off">
                            <label for="lieu_depart">Lieu de départ</label>
                        </div>

                        <div class="form-group">
                            <input type="text" name="lieu_arrivee" placeholder=" " required autocomplete="off">
                            <label for="lieu_arrivee">Lieu d’arrivée</label>
                        </div>

                        <div class="form-group">
                            <select name="typeRoute" required>
                                <option value="" disabled selected hidden></option>
                                <option value="piste">Piste</option>
                                <option value="goudronnée">Goudronnée</option>
                                <option value="mixte">Mixte</option>
                            </select>
                            <label for="typeRoute">Type de route</label>
                        </div>

                        <div class="form-group">
                            <input type="number" id="km" name="km" placeholder=" " step="0.1" required>
                            <label for="km">Kilométrage</label>
                        </div>

                        <div class="form-action">
                            <button type="submit">Valider</button>
                        </div>
                    </form>
                    <div class="divider"></div>
                @endif


                <h2 class="page-title mt-16">Liste des trajets</h2>
                <div class="table-wrapper mt-6">
                    <table class="table voiture-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Type de route</th>
                                <th>Kilométrage</th>
                                @if (Auth::check() && (Auth::user()->role === '0' || Auth::user()->role === '5'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trajets as $trajet)
                                <tr>
                                    <td>{{ $trajet->lieuDepart?->nomLieu ?? '-' }}</td>
                                    <td>{{ $trajet->lieuArrivee?->nomLieu ?? '-' }}</td>
                                    <td>{{ $trajet->typeRoute }}</td>
                                    <td>{{ $trajet->km ?? '-' }} km</td>
                                    @if (Auth::check() && (Auth::user()->role === '0' || Auth::user()->role === '5'))
                                        <td>
                                            <a href="{{ route('trajet.destroy', $trajet->id) }}" class="action-btn btn-delete">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-4">
                                        Aucun trajet enregistré.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
@endsection
