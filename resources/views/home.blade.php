@extends('layouts.layout')

@section('title')
AGF - Accueil
@endsection

@section('links')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->profil->roles->contains('code', 'GESTION_UTILISATEURS'))
        <div class="col-md-6">
            <a href="{{ route('users.index') }}" class="card-link text-center">
                <div class="card mb-4 shadow clickable-card">
                    <div class="card-body bg-dark">
                        <i class="fa-solid fa-users fa-7x mb-3 text-white"></i><br><br>
                        <h3><b>Gestion des utilisateurs</b></h3>
                    </div>
                    <div class="card-footer ">
                    <p class="card-text text-dark">Accédez à la page de gestion des utilisateurs pour ajouter, modifier ou supprimer des utilisateurs.</p>
                    </div>
                </div>
            </a>
        </div>
        @endif

        @if (Auth::user()->profil->roles->contains('code', 'GESTION_PROFILS'))
        <div class="col-md-6">
            <a href="{{ route('profils.index') }}" class="card-link text-center">
                <div class="card mb-4 shadow clickable-card">
                    <div class="card-body bg-dark">
                        <i class="fas fa-solid fa-id-card fa-7x mb-3 text-white"></i><br><br>
                        <h3><b>Gestion des profils</b></h3>
                    </div>
                    <div class="card-footer">
                    <p class="card-text text-dark">Accédez à la page de gestion des profils pour ajouter, modifier ou supprimer des profils.</p>
                    </div>
                </div>
            </a>
        </div>
        @endif

    </div>
</div>


@endsection