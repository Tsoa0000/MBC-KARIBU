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
            justify-content: space-between;
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
