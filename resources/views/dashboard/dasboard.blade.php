@extends('app')
@include('partials.navbar')

@section('style')
    <style>
        .toast-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 90%;
            text-align: center;
            animation: fadeOut 1s ease-in-out 5s forwards;
        }

        .toast-success {
            background-color: #28a745;
        }

        .toast-error {
            background-color: #dc3545;
        }

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
    {{-- TOAST MESSAGE --}}
    @if (session('success'))
        <div class="toast-message toast-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="toast-message toast-error">{{ session('error') }}</div>
    @endif

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-lg-12">
                <div class="row">

                    <!-- voiture Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Nombre des voitures</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-roadster-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End voiture Card -->

                    <!-- chauffeur Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Nombre des chauffeurs</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-team-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End chauffeur Card -->

                    <!-- mission Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Mission enregistrées</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-draft-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End mission Card -->

                    <!-- Recent mission -->
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
                                        <!-- Données dynamiques à insérer ici -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div><!-- End Left side columns -->
        </section>
    </main><!-- End #main -->
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
@endsection
