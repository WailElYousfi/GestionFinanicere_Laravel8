<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="createModalLabel">Ajout d'un profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('profils.store') }}" id="createForm">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="Code du profil" required>
          </div>
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom du profil" required>
          </div>
          <div class="form-group">
            <strong>Choisissez les rôles :</strong> <br /><br />
            @foreach($allRoles as $role)
            <div>
              <input id="{{ $role->id }}" type="checkbox" name="selectedRoles[]" value="{{ $role->id }}">
              <label for="{{ $role->id }}">{{ $role->nom }} ({{ $role->description }})</label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>
