@extends('app')

@include('partials.navbar')

@section('style')
<link rel="stylesheet" href="{{ asset('asset/css/voiture/verifVehi.css') }}">
<style>
  /* Style classique et élégant pour les entêtes */
  .verif-title {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 600;
    color: #2a736d;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e2a346;
    display: inline-block;
    padding-bottom: 0.3rem;
  }


</style>
@endsection

@section('body')
<main id="main" class="main">
  {{-- Formulaire de vérification rapide --}}
  <form method="POST" action="{{ route('verification.store') }}" id="checklistForm" class="{{ session('resume') ? 'hidden' : '' }}">
    @csrf
    <h2 class="verif-title">Vérification rapide des voitures</h2>

    <div class="grid">
      {{-- Immatriculation --}}
      <div class="item">
        <span class="label">Immatriculation</span>
        <select name="voiture_id" required>
          <option value="" disabled selected>Choisir une immatriculation</option>
          @foreach ($voiture as $v)
            <option value="{{ $v->id }}">{{ $v->matricule }}</option>
          @endforeach
        </select>
      </div>

      {{-- Date de vérification --}}
      <div class="item">
        <span class="label">Date de vérification</span>
        <input type="date" name="date" required />
      </div>

      {{-- Éléments à vérifier --}}
      @php
        $items = [
          'papier' => 'Papier du véhicule',
          'huile' => 'Moteur',
          'lockeed' => 'Freins',
          'eau' => 'Transmissions',
          'pneu' => 'Pneu'
        ];
      @endphp

      @foreach ($items as $key => $label)
        <div class="item" data-name="{{ $key }}">
          <span class="label">{{ $label }}</span>
          <div class="btns">
            <input type="radio" name="{{ $key }}" id="{{ $key }}-ok" value="1" />
            <label for="{{ $key }}-ok" class="ok">OUI</label>
            <input type="radio" name="{{ $key }}" id="{{ $key }}-nok" value="0" />
            <label for="{{ $key }}-nok" class="nok">NON</label>
          </div>
          <div class="feedback"></div>
        </div>
      @endforeach

      {{-- Observation --}}
      <div class="item observation">
        <span class="label">Observation</span>
        <textarea name="observation" rows="4" placeholder="Remarques éventuelles..."></textarea>
      </div>
    </div>

    <div class="button-wrapper">
      <button type="submit" class="submit">Valider la vérification</button>
    </div>
  </form>
</main>
@endsection

@section('script')
<script>
  document.querySelectorAll('.item').forEach(item => {
    item.querySelectorAll('input[type=radio]').forEach(radio => {
      radio.addEventListener('change', e => {
        const feedbackDiv = item.querySelector('.feedback');
        feedbackDiv.classList.remove('ok', 'nok');
        if (e.target.value === '1') {
          feedbackDiv.textContent = ' OUI';
          feedbackDiv.classList.add('ok');
        } else {
          feedbackDiv.textContent = ' NON';
          feedbackDiv.classList.add('nok');
        }
      });
    });
  });
</script>
@endsection
