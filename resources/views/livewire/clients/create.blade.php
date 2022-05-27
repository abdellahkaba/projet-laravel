<div class="row p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout client</h3>
        </div>
        <form role="form" wire:submit.prevent="addClient()">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input type="name" wire:model="addClient.nom" class="form-control @error('addClient.nom')
                               is-invalid
                            @enderror">
                            @error('addClient.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Prenom</label>
                            <input type="name" wire:model="addClient.prenom" class="form-control @error('addClient.prenom')
                                is-invalid
                            @enderror" >
                            @error('addClient.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Sexe</label>
                    <select name="" id=""wire:model="addClient.sexe" class="form-control @error('addClient.sexe')
                        is-invalid
                    @enderror" >
                        <option value="">--------------</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                        @error('addClient.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date de Naissance</label>
                            <input type="date" wire:model="addClient.dateNaiss" class="form-control @error('addClient.dateNaiss')
                                is-invalid
                            @enderror" >
                            @error('addClient.dateNaiss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Lieu de Naissance</label>
                            <input type="text" wire:model="addClient.lieuNaiss" class="form-control @error('addClient.lieuNaiss')
                                is-invalid
                            @enderror" >
                            @error('addClient.lieuNaiss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ville</label>
                    <input type="name" class="form-control
                    @error('addClient.ville')
                    is-invalid
                    @enderror"
                    wire:model="addClient.ville">

                    @error('addClient.ville')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Adresse</label>
                            <input type="text" wire:model="addClient.adresse" class="form-control @error('addClient.adresse')
                                is-invalid
                            @enderror" >
                            @error('addClient.adresse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Telephone</label>
                            <input type="name" wire:model="addClient.telephone" class="form-control @error('addClient.telephone')
                                is-invalid
                            @enderror" >
                            @error('addClient.telephone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ajouté</button>
                <button type="submit" wire:click.prevent="gotoListClient()" class="btn btn-danger">Retour à la Liste</button>
            </div>
        </form>
    </div>
</div>


