@extends('app')
@include('partials.navbar')

@section('style')
<style>
  body {
    font-family: "Segoe UI", sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    overflow: hidden;
  }

  .neu-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 8px 8px 16px #c5c9d2,
                -8px -8px 16px #ffffff;
    padding: 40px 30px;
    width: 340px;
    text-align: center;
  }

  .neu-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: inset 4px 4px 10px #c5c9d2,
                inset -4px -4px 10px #ffffff;
    margin-bottom: 20px;
  }

  .neu-card h2 {
    margin: 0;
    font-size: 22px;
    color: #33897f;
  }

  .neu-card .role {
    font-size: 14px;
    color: #2d5c4a;
    margin-bottom: 20px;
    font-weight: 600;
  }

  .neu-card .info {
    font-size: 16px;
    color: #2d5c4a;
    margin: 8px 0;
    text-align: left;
  }

  .neu-card .btn-group {
    margin-top: 25px;
  }

  .neu-btn {
    padding: 10px 20px;
    margin: 8px;
    border: none;

    border-radius: 12px;
    background: #e0e5ec;
    box-shadow: 6px 6px 12px #c5c9d2,
                -6px -6px 12px #ffffff;
    color: #333;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .neu-btn:hover {
    box-shadow: inset 2px 2px 6px #c5c9d2,
                inset -2px -2px 6px #ffffff;
  }

  .neu-btn i {
    margin-right: 6px;
  }

  .neu-card .form-group {
    text-align: left;
    margin-bottom: 15px;
  }

  .neu-card label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #2d5c4a !important;
  }

  .neu-card input[type="text"],
  .neu-card input[type="email"] {
    width: 100%;
    padding: 10px 15px;
    border: none;
    border-radius: 12px;
    background: #e0e5ec;
    box-shadow: inset 6px 6px 12px #c5c9d2,
                inset -6px -6px 12px #ffffff;
    font-size: 14px;
    color: #333;
    outline: none;
    transition: all 0.3s ease;
  }

  .neu-card input:focus {
    box-shadow: inset 3px 3px 8px #c5c9d2,
                inset -3px -3px 8px #ffffff;
  }
</style>
@endsection

@section('body')
<main id="main" class="main">
  <div class="neu-card">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#33897f"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path
                                d="M13.468 12.37C12.758 11.226 11.482 10.5 10 10.5H6c-1.482 0-2.758.726-3.468 1.87A6.982 6.982 0 0 0 8 15a6.982 6.982 0 0 0 5.468-2.63z" />
                            <path fill-rule="evenodd"
                                d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-1a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                            <path fill-rule="evenodd"
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />

                        </svg>
    @php
      $roles = [
        0 => 'Admin',
        2 => 'Lecteur',
        5 => 'Editeur',
        7 => 'Chauffeur',
      ];
    @endphp

    <h2>{{ $roles[Auth::user()->role] ?? 'Inconnu' }}</h2>

    <div id="info-display">
      <div class="info"><strong>Nom complet :</strong> {{ Auth::user()->name }} {{ Auth::user()->first_name }}</div>
      <div class="info"><strong>Email :</strong> {{ Auth::user()->email }}</div>
    </div>

    <form id="edit-info-form" action="{{ route('user.updateInfo') }}" method="POST" style="display: none;">
      @csrf
      <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
      </div>
      <div class="form-group">
        <label>Prénom</label>
        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
      </div>
      <div class="btn-group">
        <button type="submit" class="neu-btn"><i class="ri-save-line"></i> Enregistrer</button>
        <button type="button" class="neu-btn" id="cancel-edit"><i class="ri-close-line"></i> Annuler</button>
      </div>
    </form>

    <div class="btn-group" id="action-buttons">
      <button class="neu-btn" id="edit-button"><i class="ri-edit-2-line"></i> Modifier</button>
      <a href="{{ route('dashboard') }}" class="neu-btn"><i class="ri-logout-circle-r-line"></i> Quitter</a>
    </div>
  </div>
</main>
@endsection

@section('script')
<script>
  const editBtn = document.getElementById('edit-button');
  const cancelBtn = document.getElementById('cancel-edit');
  const infoForm = document.getElementById('edit-info-form');
  const infoDisplay = document.getElementById('info-display');
  const actionButtons = document.getElementById('action-buttons');

  editBtn?.addEventListener('click', () => {
    infoDisplay.style.display = 'none';
    infoForm.style.display = 'block';
    actionButtons.style.display = 'none';
  });

  cancelBtn?.addEventListener('click', () => {
    infoDisplay.style.display = 'block';
    infoForm.style.display = 'none';
    actionButtons.style.display = 'flex';
  });
</script>
@endsection
