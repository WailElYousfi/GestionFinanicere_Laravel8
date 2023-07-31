@foreach($users as $user)
<div class="modal fade" id="viewModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="viewModalLabel">Détails d'utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong><i class="fas fa-book mr-1"></i> Nom complet</strong>
        <p class="text-muted"> {{ strtoupper($user->nom) }} {{ ucfirst($user->prenom) }} </p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Adresse E-mail</strong>
        <p class="text-muted">{{ $user->email }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Date de création</strong>
        <p class="text-muted">{{ $user->created_at }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Date de modification</strong>
        @if($user->updated_at)
          <p class="text-muted">{{ $user->created_at }}</p>
        @else
          <p class="text-muted">Cet utilisateur n'a pas été modifié</p>
        @endif
        <hr>

        <strong><i class="fas fa-pencil-alt mr-1"></i> Le profil affecté</strong>
        @if ($user->profil)
        <p class="text-muted">{{ $user->profil->nom }} ({{ $user->profil->code }})</p>
        @if ($user->profil->roles->isNotEmpty())
        <p class="text-muted">Les rôles de ce profil :</p>
        <ul>
          @foreach ($user->profil->roles as $role)
          <li class="text-muted">{{ $role->nom }} ({{ $role->code }})</li>
          @endforeach
        </ul>
        @endif
        @else
        <p class="text-muted">Aucun profil n'est affecté a cet utilisateur!</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
@endforeach