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
        .chauffeur-card {
            display: flex;
            justify-content: space-between;}
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
            margin-top:-60px ;
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
            text-transform: capitalize;
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
            background-color: white;
            padding: 20px 24px;
            border-radius: 18px;
            margin-bottom: 18px;
            text-decoration: none;
            border: 1px solid var(--border-color);
            transition: all 0.25s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            cursor: pointer;
        }

        .chauffeur-card:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08);
        }

        .chauffeur-info {
            display: flex;
            flex-direction: column;
        }

        .chauffeur-info h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color: #111827;
        }

        .chauffeur-info p {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .arrow {
            width: 24px;
            height: 24px;
            stroke: var(--primary-color);
            transition: transform 0.2s ease;
        }

        .chauffeur-card:hover .arrow {
            transform: translateX(4px);
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #d1fae5;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 16px;
            font-size: 18px;
        }

        .chauffeur-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .space{
            background:white;
            box-shadow: 2px 2px 3px 4px rgba(0, 0, 0, 0.04);
            width:100%;
            border-radius:10px;
            padding-left:15px;
            margin-bottom:15px;
            padding-top:15px;
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
                <h2 class="page-title">Rapport du chauffeur</h2>
            </div>
            @foreach ($rapport->unique('idChauff') as $r)
                <div class="space">
                    <a href="{{ route('rapport.liste', ['id' => $r->idChauff]) }}">

                        <div class="chauffeur-left">
                            <div class="avatar">
                                {{ strtoupper(substr($r->user_name, 0, 1) . substr($r->user_first_name, 0, 1)) }}
                            </div>
                            <div class="chauffeur-info">
                                <h2>{{ $r->user_name }} {{ $r->user_first_name }}</h2>
                                <p>{{ $r->user_email }}</p>
                            </div>
                        </div>
                        <svg class="arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>
            @endforeach
        </div>


    </main>
@endsection
@section('script')
@endsection
