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
    <a href="index.html" class="logo ">
      <img src="{{ asset('assets/image/logop.png') }}" alt="">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar ">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Recherche" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="" data-bs-toggle="dropdown">
          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
        </a><!-- End Profile Image Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>Admin</h6>
            <span>Karibu</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{route('profil.chauffeur')}}">
              <i class="bi bi-person"></i>
              <span>Mon Profile</span>
            </a>
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

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
@if (Auth::check() && Auth::user()->role === '0')
    <li class="nav-item">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="ri-dashboard-line"></i>
        <span>Tableau de bord</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class=" ri-roadster-fill"></i><span>Gestion des voitures</span><i class="bi bi-chevron-down ms-auto"></i>
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
    </li><!-- End voiture Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class=" ri-map-pin-line"></i><span>Mission et trajet</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('trajet.create')}}">
            <i class="bi bi-circle"></i><span>Trajet</span>
          </a>
        </li>
        <li>
          <a href="{{route('mission.show')}}">
            <i class="bi bi-circle"></i><span>Mission</span>
          </a>
        </li>
      </ul>
    </li><!-- End mission et trajet Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.html">
        <i class="ri-team-line"></i>
        <span>Chauffeurs</span>
      </a>
    </li><!-- End chauffeur Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-faq.html">
        <i class=" ri-file-excel-2-line"></i>
        <span>Rapport</span>
      </a>
    @endif
    </li><!-- End rapport Page Nav -->
    @if (Auth::check() && Auth::user()->role === '1')
       <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('mission.show')}}">
        <i class="ri-file-edit-line"></i>
        <span>Mission</span>
      </a>
    </li><!-- End chauffeur Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('tabbord.index')}}">
        <i class="ri-file-edit-line"></i>
        <span>Fiche de bord</span>
      </a>
    </li><!-- End chauffeur Page Nav -->
    </ul>
    @endif
</aside><!-- End Sidebar-->

<script src="/asset/js/bootstrap.min.js"></script>
<!-- Vendor JS Files -->
<script src="/asset/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/asset/vendor/chart.js/chart.umd.js"></script>
<script src="/asset/vendor/echarts/echarts.min.js"></script>
<script src="/asset/vendor/quill/quill.min.js"></script>
<script src="/asset/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/asset/vendor/tinymce/tinymce.min.js"></script>
<script src="/asset/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/asset/js/main.js"></script>
