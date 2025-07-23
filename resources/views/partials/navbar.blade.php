@extends('app')

<link href="/asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="/asset/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/asset/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="/asset/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="/asset/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/asset/vendor/simple-datatables/style.css" rel="stylesheet">

<link href="/asset/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">

        <a href="" class="logo ">
            <img src="{{ asset('assets/image/logop.png') }}" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar ">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Recherche" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="" data-bs-toggle="dropdown">
                    <div class="profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#33897f"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path
                                d="M13.468 12.37C12.758 11.226 11.482 10.5 10 10.5H6c-1.482 0-2.758.726-3.468 1.87A6.982 6.982 0 0 0 8 15a6.982 6.982 0 0 0 5.468-2.63z" />
                            <path fill-rule="evenodd"
                                d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-1a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                            <path fill-rule="evenodd"
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />

                        </svg>
                    </div>
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6> {{ Auth::user()->name }} </h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        @if (Auth::check() &&  Auth::user()->role === '0' || Auth::user()->role === '2' || Auth::user()->role === '5' )
                            <a class="dropdown-item d-flex align-items-center" href="{{route('profilAdmin')}}">
                                <i class="bi bi-person"></i>
                                <span>Mon Profile</span>
                            </a>
                        @endif
                        @if (Auth::check() && Auth::user()->role === '7')
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profil.chauffeur') }}">
                                <i class="bi bi-person"></i>
                                <span>Mon Profile</span>
                            </a>
                        @endif
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @auth
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    @endauth

                </ul>
            </li>

        </ul>
    </nav>

</header>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::check() && Auth::user()->role === '2' || Auth::user()->role === '0' || Auth::user()->role === '5')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">
                    <i class="ri-dashboard-line"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class=" ri-roadster-fill"></i><span>Gestion des voitures</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('voiture') }}">
                            <i class="bi bi-circle"></i><span>Voitures</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('verification.index') }}">
                            <i class="bi bi-circle"></i><span>Verification des voitures</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class=" ri-map-pin-line"></i><span>Mission et trajet</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('trajet.create') }}">
                            <i class="bi bi-circle"></i><span>Trajet</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mission.show') }}">
                            <i class="bi bi-circle"></i><span>Mission</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End mission et trajet Nav -->
            <!-- chauffeur Page Nav
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('chauffeur.index') }}">
                    <i class="ri-gas-station-fill"></i>
                    <span>Carburant</span>
                </a>
            </li>End chauffeur Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('chauffeur.index') }}">
                    <i class="ri-team-line"></i>
                    <span>Chauffeurs</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-faq.html">
                    <i class=" ri-file-excel-2-line"></i>
                    <span>Rapport</span>
                </a>
            </li><!-- End rapport Page Nav -->
            @if (Auth::check() && Auth::user()->role === '0')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('gestionRole') }}">
                    <i class="ri-user-settings-line"></i>
                    <span>Gestion des rôles</span>
                </a>
            @endif
        @endif
        </li><!-- End rapport Page Nav -->
        @if (Auth::check() && Auth::user()->role === '7')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('mission.show') }}">
                    <i class="ri-file-list-2-line"></i>
                    <span>Mission</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('tabbord.index') }}">
                    <i class="ri-file-edit-line"></i>
                    <span>Fiche de bord</span>
                </a>
            </li>
    </ul>
    @endif
</aside>

<script src="/asset/js/bootstrap.min.js"></script>
<script src="/asset/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/asset/vendor/chart.js/chart.umd.js"></script>
<script src="/asset/vendor/echarts/echarts.min.js"></script>
<script src="/asset/vendor/quill/quill.min.js"></script>
<script src="/asset/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/asset/vendor/tinymce/tinymce.min.js"></script>
<script src="/asset/vendor/php-email-form/validate.js"></script>
<script src="/asset/js/main.js"></script>
