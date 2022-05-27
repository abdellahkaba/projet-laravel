<div class="row p-4 pt-5">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i>Formulaire de Modification</h3>
            </div>
            <form role="form" wire:submit.prevent="updateClient()">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="name" wire:model="editClient.nom" class="form-control @error('editClient.nom')
                                   is-invalid
                                @enderror">
                                @error('editClient.nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Prenom</label>
                                <input type="name" wire:model="editClient.prenom" class="form-control @error('editClient.prenom')
                                    is-invalid
                                @enderror" >
                                @error('editClient.prenom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Sexe</label>
                        <select name="" id=""wire:model="editClient.sexe" class="form-control @error('editClient.sexe')
                            is-invalid
                        @enderror" >
                            <option value="">--------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                            @error('editClient.sexe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Date de Naissance</label>
                                <input type="date" wire:model="editClient.dateNaiss" class="form-control @error('editClient.dateNaiss')
                                    is-invalid
                                @enderror" >
                                @error('editClient.dateNaiss')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Lieu de Naissance</label>
                                <input type="name" wire:model="editClient.lieuNaiss" class="form-control @error('editClient.lieuNaiss')
                                    is-invalid
                                @enderror" >
                                @error('editClient.lieuNaiss')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ville</label>
                        <input type="name" wire:model="editClient.ville" class="form-control @error('editClient.ville')
                            is-invalid
                        @enderror">
                        @error('editClient.ville')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Adresse</label>
                                <input type="text" wire:model="editClient.adresse" class="form-control @error('editClient.adresse')
                                    is-invalid
                                @enderror" >
                                @error('editClient.adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Telephone</label>
                                <input type="name" wire:model="editClient.telephone" class="form-control @error('editClient.telephone')
                                    is-invalid
                                @enderror" >
                                @error('editClient.telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" wire:click="updateClient" class="btn btn-primary">Modifier</button>
                    <button type="submit" wire:click.prevent="gotoListClient" class="btn btn-danger">Retour à la Liste</button>
                </div>
            </form>
        </div>
    </div>
</div>


