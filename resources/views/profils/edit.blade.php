@extends('profils.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Profil</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('profils.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('profils.update',$profil->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>
                    <input type="text" name="code" value="{{ $profil->code }}" class="form-control" placeholder="Code">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <textarea class="form-control" style="height:150px" name="nom" placeholder="Nom">{{ $profil->nom }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Les roles:</strong>
                    @foreach($allRoles as $role)
                        <div>
                            <input type="checkbox" name="selectedRoles[]" value="{{ $role->id }}" {{ $profil->roles->contains($role->id) ? 'checked' : '' }}>
                            <label>{{ $role->nom }} ({{ $role->description }})</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection