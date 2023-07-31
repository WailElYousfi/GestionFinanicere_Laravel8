@foreach($profils as $profil)
<div class="modal fade" id="editModal{{ $profil->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="editModalLabel">Modification du profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('profils.update', ['profil' => $profil->id]) }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="codeProfil">Code</label>
            <input type="text" class="form-control" id="codeProfil" name="code" value="{{ $profil->code }}" required>
          </div>
          <div class="form-group">
            <label for="nomProfil">Nom</label>
            <input type="text" class="form-control" id="nomProfil" name="nom" value="{{ $profil->nom }}" required>
          </div>
          <div class="form-group">
            <strong>Les rôles affectés :</strong> <br /><br />
            @foreach($allRoles as $role)
            <div>
              <input id="{{ $role->code }}" type="checkbox" name="selectedRoles[]" value="{{ $role->id }}" {{ $profil->roles->contains($role->id) ? 'checked' : '' }}>
              <label for="{{ $role->code }}">{{ $role->nom }} ({{ $role->description }})</label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach