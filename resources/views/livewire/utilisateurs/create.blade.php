<div class="row p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout</h3>
        </div>
        <form role="form" wire:submit.prevent="addUser()">
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
                            <label for="">Nom</label>
                            <input type="name" wire:model="newUser.nom" class="form-control @error('newUser.nom')
                               is-invalid
                            @enderror">
                            @error('newUser.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Prenom</label>
                            <input type="name" wire:model="newUser.prenom" class="form-control @error('newUser.prenom')
                                is-invalid
                            @enderror" >
                            @error('newUser.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Sexe</label>
                    <select name="" id=""wire:model="newUser.sexe" class="form-control @error('newUser.sexe')
                        is-invalid
                    @enderror" >
                        <option value="">--------------</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                        @error('newUser.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Telephone</label>
                            <input type="name" wire:model="newUser.telephone" class="form-control @error('newUser.telephone')
                                is-invalid
                            @enderror" >
                            @error('newUser.telephone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Adresse</label>
                            <input type="name" wire:model="newUser.adresse" class="form-control
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
                    <label for="">Email</label>
                    <input type="email"wire:model="newUser.email" class="form-control @error('newUser.email')
                        is-invalid
                    @enderror" >
                    @error('newUser.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" disabled placeholder="Mot de Pass">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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


