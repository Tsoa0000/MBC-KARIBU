@extends('app')
@include('partials.navbar')
@section('style')
    <style>
        .page-title {

            font-size: 1.7rem;
            width: 203px;
            font-weight: 600;
            color: #2a736d;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e2a346;
            padding-bottom: 0.3rem;

        }
        .card-header{
            border: none
        }
        th {
            background: #2d5c4a !important;
            color: #fff !important;
            padding: 0.5rem;
            width: 150px;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }
        td {
            padding: 0.5rem;
            width: 150px;
            text-align: center;
            font-size: 1rem;
            vertical-align: middle;
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
    <main id="main" class="main">
        <div class="wrapper">
            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h2 class="page-title">Gérer les rôles</h2>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>Rôle actuel</th>
                                                    <th>Changer le rôle</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <form action="{{ route('gestionRole.update', $user->id) }}"
                                                            method="POST" class="d-flex align-items-center gap-2">
                                                            @csrf
                                                            @method('PUT')
                                                            <td>
                                                                <select name="role" class="form-select form-select-sm"
                                                                    required>
                                                                    <option value="2"
                                                                        {{ $user->role == '2' ? 'selected' : '' }}>
                                                                        Lecteur</option>
                                                                    <option value="5"
                                                                        {{ $user->role == '5' ? 'selected' : '' }}>
                                                                        Éditeur</option>
                                                                    <option value="7"
                                                                        {{ $user->role == '7' ? 'selected' : '' }}>
                                                                        Chauffeur</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <center><button type="submit" class="btn btn-sm"
                                                                        style="background-color: #2d5c4a;color:aliceblue"
                                                                        onmouseover="this.style.backgroundColor='#1f6047'"
                                                                        onmouseout="this.style.backgroundColor='#267653'">
                                                                        <i class="fa fa-pencil-alt"></i>
                                                                        Mettre à jour</button></center>
                                                            </td>

                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
