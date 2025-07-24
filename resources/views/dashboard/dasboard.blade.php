@extends('app')
@include('partials.navbar')
@import url('https://fonts.cdnfonts.com/css/skia');
@section('style')
    <style>
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                top: 0;
            }
        }
    </style>
@endsection

@section('body')
    @if ((Auth::check() && Auth::user()->role === '0') || Auth::user()->role === '5' || Auth::user()->role === '2')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de bord</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre des voitures</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-roadster-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $nombreVoitures }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre des chauffeurs</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-team-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $nombresChauffeurs }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Mission enregistrées</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-draft-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ $nombresMission }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Missions récentes</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Voiture pour la mission</th>
                                                <th scope="col">Chauffeur</th>
                                                <th scope="col">Destination</th>
                                                <th scope="col">Date du mission</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($missions as $index => $mission)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $mission->voiture->modele ?? 'Non défini' }}</td>
                                                    <td>{{ $mission->chauffeur->name ?? 'Non défini' }}</td>
                                                    <td>{{ $mission->lieuArrive->nomLieu }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($mission->date_mission)->format('d/m/Y') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
    @endsection

    @section('srcipt')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const toasts = document.querySelectorAll('.toast-message');
                toasts.forEach((toast) => {
                    setTimeout(() => {
                        toast.style.display = 'none';
                    }, 6000);
                });
            });
        </script>
    @endif
@endsection
