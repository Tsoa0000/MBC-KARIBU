@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Créer une Mission</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('mission.create') }}" method="POST">
        @csrf

        {{-- Trajet --}}
        <div class="mb-3">
            <label for="trajet" class="form-label">Trajet</label>
            <select id="trajet" name="trajet_id" class="form-select" required>
                <option value="">-- Sélectionnez un trajet --</option>
                @foreach($trajets as $trajet)
                    <option value="{{ $trajet->id }}">
                        {{ $trajet->lieuDepart->nom }} → {{ $trajet->lieuArrivee->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Voiture --}}
        <div class="mb-3">
            <label for="voiture" class="form-label">Voiture proposée</label>
            <select id="voiture" name="voiture_id" class="form-select" required>
                <option value="">-- Choisissez un trajet d'abord --</option>
            </select>
        </div>

        {{-- Chauffeur --}}
        <div class="mb-3">
            <label for="chauffeur" class="form-label">Chauffeur</label>
            <select id="chauffeur" name="chauffeur_id" class="form-select" required>
                <option value="">-- Sélectionnez un chauffeur --</option>
                @foreach($chauffeurs as $chauffeur)
                    <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dates --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date_depart" class="form-label">Date de départ</label>
                <input type="date" name="date_depart" id="date_depart" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="date_arrive" class="form-label">Date d’arrivée</label>
                <input type="date" name="date_arrive" id="date_arrive" class="form-control" required>
            </div>
        </div>

        {{-- Objet --}}
        <div class="mb-3">
            <label for="objet" class="form-label">Objet de la mission</label>
            <textarea name="objet" id="objet" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer la mission</button>
    </form>
</div>

<script>
    document.getElementById('trajet').addEventListener('change', function () {
        let trajetId = this.value;
        fetch('{{ url("/missions/voitures") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ trajet_id: trajetId })
        })
        .then(response => response.json())
        .then(data => {
            const voitureSelect = document.getElementById('voiture');
            voitureSelect.innerHTML = '';

            if (data.length === 0) {
                let opt = document.createElement('option');
                opt.text = 'Aucune voiture disponible';
                voitureSelect.appendChild(opt);
            } else {
                data.forEach(voiture => {
                    let opt = document.createElement('option');
                    opt.value = voiture.id;
                    opt.text = `${voiture.matricule} - ${voiture.modele}`;
                    voitureSelect.appendChild(opt);
                });
            }
        });
    });
</script>
@endsection
