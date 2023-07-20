@extends('profils.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des profils</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('profils.create') }}">Create New Profil</a>
            </div>
        </div>
        </br> </br>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Code</th>
            <th>Nom</th>
            <th>Roles</th>
            <th >Action</th>
        </tr>
        @foreach ($profils as $profil)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $profil->code }}</td>
            <td>{{ $profil->nom }}</td>
            <td>
                <ul>
                    @foreach ($profil->roles as $role)
                        <li>{{ $role->nom }} ({{ $role->description }}) </li>
                    @endforeach
                </ul>
            </td>
            <td>
                <form action="{{ route('profils.destroy',$profil->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('profils.show',$profil->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('profils.edit',$profil->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $profils->links() !!}
      
@endsection