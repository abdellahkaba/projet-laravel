<div class="row p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout</h3>
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
                            <label for=""><span class="text-indigo">Nom</span></label>
                            <input type="name" wire:model="newUser.nom" class="form-control text-bold text-blue @error('newUser.nom')
                               is-invalid
                            @enderror">
                            @error('newUser.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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
                <div class="form-group">
                    <label for=""><span class="text-indigo">password</span></label>
                    <input type="password" class="form-control" disabled placeholder="Mot de Pass">
                </div>
                {{-- <div class="form-group">
                    <label for="path">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file"  class="custom-file-input" id="path">
                            <label class="custom-file-label" for="path">Sa photo</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ajouté</button>
                <button type="submit" wire:click.prevent="gotoListUser()" class="btn btn-danger">Retour à la Liste</button>
            </div>
        </form>
    </div>
</div>


