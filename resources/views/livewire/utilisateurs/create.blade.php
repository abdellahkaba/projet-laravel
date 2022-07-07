<div class="row p-4 pt-5">
    <div class="card card-primary col-8">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout d'un Utilisateur</h3>
        </div>
        <form role="form" wire:submit.prevent="addUser()" enctype="multipart/form-data">
            <div class="card-body">
                {{-- <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Nom</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Prenom</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Prenom</span></label>
                            <input type="name" wire:model="newUser.prenom" class="form-control text-bold text-blue @error('newUser.prenom')
                                is-invalid
                            @enderror" >
                            @error('newUser.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Nom</span></label>
                            <input type="name" wire:model="newUser.nom" class="form-control text-bold text-blue @error('newUser.nom')
                               is-invalid
                            @enderror">
                            @error('newUser.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Date de Naissance</span></label>
                            <input type="date" wire:model="newUser.dateNaiss" class="form-control text-bold text-blue @error('newUser.dateNaiss')
                               is-invalid
                            @enderror">
                            @error('newUser.dateNaiss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Lieu de Naissence</span></label>
                            <input type="text" wire:model="newUser.lieuNaiss" class="form-control text-bold text-blue @error('newUser.lieuNaiss')
                                is-invalid
                            @enderror" >
                            @error('newUser.lieuNaiss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><span class="text-indigo">Selectionner un Sexe</span></label>
                    <select name="" id=""wire:model="newUser.sexe" class="form-control text-bold text-blue @error('newUser.sexe')
                        is-invalid
                    @enderror" >
                        <option value="">-------------</option>
                        <option value="H"><span class="text-indigo text-bold">Homme</span></option>
                        <option value="F"><span class="text-indigo text-bold">Femme</span></option>
                    </select>
                        @error('newUser.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Téléphone</span></label>
                            <input type="name" wire:model="newUser.telephone" class="form-control text-bold text-blue @error('newUser.telephone')
                                is-invalid
                            @enderror" >
                            @error('newUser.telephone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Adresse</span></label>
                            <input type="name" wire:model="newUser.adresse" class="form-control text-bold text-blue
                             @error('newUser.adresse')
                                is-invalid
                            @enderror" >
                            @error('newUser.adresse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><span class="text-indigo">Email</span></label>
                    <input type="email"wire:model="newUser.email" class="form-control text-bold text-blue @error('newUser.email')
                        is-invalid
                    @enderror" placeholder="exemple@gmail.com">
                    @error('newUser.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="p-4">
                    <div class="form-group">
                        <input type="file" name="" wire:model="">
                    </div>
                    <div class="" style="border-block: 1px solid #eee ; border-radius : 30px ; height:72%; width: 72% ; overflow: hidden;">
                        @if ($addPhoto)
                            <img src="{{ $addPhoto->temporaryUrl() }}" style="height: 200px ; width: 250px;">
                        @endif
                    </div>
                </div> --}}
                <div class="form-group">
                    <label for=""><span class="text-indigo">password</span></label>
                    <input type="password" class="form-control" disabled placeholder="Mot de Pass">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ajouté</button>
                <button type="submit" wire:click.prevent="gotoListUser()" class="btn btn-danger">Retour à la Liste</button>
            </div>
        </form>
    </div>
</div>


