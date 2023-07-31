@foreach($profils as $profil)
<div class="modal fade" id="viewModal{{ $profil->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="viewModalLabel">Détails du profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong><i class="fas fa-book mr-1"></i> Code</strong>
        <p class="text-muted"> {{ $profil->code }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Nom</strong>
        <p class="text-muted">{{ $profil->nom }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Date de création</strong>
        <p class="text-muted">{{ $profil->created_at }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Date de modification</strong>
        @if($profil->updated_at)
          <p class="text-muted">{{ $profil->created_at }}</p>
        @else
          <p class="text-muted">Ce profil n'a pas été modifié</p>
        @endif
        <hr>

        <strong><i class="fas fa-pencil-alt mr-1"></i> Les rôles affectés</strong>
        @if ($profil->roles ?? null && $profil->roles->count() > 0)
        <ul>
          @foreach ($profil->roles as $role)
          <li class="tag tag-info">{{ $role->nom }} ({{ $role->code }})</li>
          @endforeach
        </ul>
        @else
        <span class="tag tag-info">Aucun role n'est affecté a ce profil!</span>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
@endforeach
