@foreach($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="editModalLabel">Modification d'utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ $user->nom }}" required autocomplete="nom">
            @error('nom')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="prenom">Prenom</label>
            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ $user->prenom }}" required autocomplete="prenom">
            @error('prenom')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Adresse E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="form-group">
              <strong>Choisissez un profil</strong> <br /><br />
              <select name="profil" id="profil" class="form-control" required>
                @foreach($profils as $profil)
                <option value="{{ $profil->id }}" {{ $user->profil_id == $profil->id ? 'selected' : '' }}>{{ $profil->nom }} ({{ $profil->code }})</option>
                @endforeach
              </select>
            </div>
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