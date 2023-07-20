@extends('profils.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Profil</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('profils.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Code:</strong>
                {{ $profil->code }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                {{ $profil->nom }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            @if ($profil->roles ?? null && $profil->roles->count() > 0)
            <h2>Roles:</h2>
            <ul>
            @foreach ($profil->roles as $role)
                <li>{{ $role->nom }} ({{ $role->code }})</li>
            @endforeach
            </ul>
            @else
                <p>This profile has no roles.</p>
            @endif
        </div>
    </div>
@endsection