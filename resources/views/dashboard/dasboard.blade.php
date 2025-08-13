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
        td {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('body')
    @if ((Auth::check() && Auth::user()->role === '0') || Auth::user()->role === '5' || Auth::user()->role === '2')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Tableau de bord</h1>
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
                                    <h5 class="card-title">Nombre de voiture</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-roadster-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre de chauffeur</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-team-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Missions enregistrées</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-draft-line"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">

                                    <form method="GET" action="{{ route('missions.chart') }}" class="mb-3">
                                        <label for="year" class="form-label">Choisir l'année :</label>
                                        <select name="year" id="year" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
                                            @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                                <option value="{{ $y }}" @if($y == $year) selected @endif>{{ $y }}</option>
                                            @endfor
                                        </select>
                                    </form>


                                    <canvas id="missionsChart" style="width: 100%; height: 500px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
    @endif
@endsection

@section('script')

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {

            const toasts = document.querySelectorAll('.toast-message');
            toasts.forEach((toast) => {
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 6000);
            });

            // Initialiser le graphique Chart.js
            const ctx = document.getElementById('missionsChart').getContext('2d');
            const missionsChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Missions par mois',
            data: {!! json_encode($data) !!},
            borderColor: '#33897f',
            backgroundColor: 'rgba(51, 137, 127, 0.1)',
            fill: true,
            tension: 0.4,
            borderWidth: 2,
            pointRadius: 3,
            pointBackgroundColor: '#2d5c4a',
            pointHoverRadius: 5,
            pointHoverBackgroundColor: '#2d5c4a'
        }]
    },
    options: {
        responsive: false,        // <-- Désactivé pour taille fixe
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0,
                    stepSize: 1,
                    callback: function(value) {
                        return Number.isInteger(value) ? value : null;
                    }
                },
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                title: {
                    display: true,
                    text: 'Nombre de missions',
                    color: '#2d5c4a',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                ticks: {
                    autoSkip: false
                },
                title: {
                    display: true,
                    text: 'Mois',
                    color: '#2d5c4a',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: `Missions enregistrées par mois - Année {{ $year }}`,
                color: '#2d5c4a',
                font: {
                    size: 16,
                    weight: 'bold'
                },
                padding: { top: 10, bottom: 20 }
            },
            legend: {
                display: true,
                labels: {
                    color: '#2d5c4a'
                }
            },
            tooltip: {
                backgroundColor: '#2d5c4a',
                titleColor: '#fff',
                bodyColor: '#fff',
                cornerRadius: 6
            }
        }
    }
});

        });
    </script>
@endsection
