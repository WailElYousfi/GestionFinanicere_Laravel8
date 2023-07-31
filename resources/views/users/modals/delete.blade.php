@foreach($users as $user)
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="deleteModalLabel">Suppression d'utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('users.destroy', ['user' => $user->id]) }}">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Voulez-vous vraiment supprimer l'utilisateur <b>{{ strtoupper($user->nom) }} {{ ucfirst($user->prenom) }}</b> ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
