<div class="row-cols-10 p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout d'enregistrement d'une Location</h3>
        </div>
        <form role="form" wire:submit.prevent="addLocation()">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Article loué</span></label>
                            <select class="form-control @error('addLocation.article_id')
                                is-invalid
                            @enderror" wire:model="addLocation.article">
                                <option value=""></option>
                                @foreach ($article as $articles)
                                    <option value = "{{ $articles->id }} "> {{ $articles->nom }} - {{ $articles->noSerie }} </option>
                                @endforeach
                            </select>
                            @error('addLocation.article_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Date de Location</span></label>
                            <input type="date" wire:model="addLocation.dateDebut" class="form-control
                             @error('addLocation.dateDebut')
                            is-invalid
                             @enderror">
                            @error('addLocation.dateDebut')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date de Fin</label>
                            <input type="date" wire:model="addLocation.dateFin" class="form-control
                            @error('addLocation.dateFin')
                            is-invalid
                             @enderror">
                            @error('addLocation.dateFin')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">le Nom client</span></label>
                            <select wire:model="addLocation.client" class="form-control @error('addLocation.client_id')
                            is-invalid
                        @enderror
                        ">
                                <option value=""></option>
                                @foreach ($clients as $client)
                                    <option value = "{{ $client->id }} "> {{ $client->nom }} {{ $client->prenom }}</option>
                                @endforeach
                            </select>
                            @error('addLocation.client_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Veuillez selectionner ce Nom <i class="badge badge-info">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</i></span></label>
                            <select wire:model="addLocation.user" class="form-control @error('addLocation.user_id')
                            is-invalid
                            @enderror">
                                <option value=""></option>
                                @foreach ($users as $user)
                                    <option value = "{{ $user->id }} "> {{ $user->nom }} </option>
                                @endforeach
                            </select>
                            @error('addLocation.user_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Statut de Location</span></label>
                            <select class="form-control @error('addLocation.statut_location_id')
                                is-invalid
                            @enderror" wire:model="addLocation.statuts">
                                <option value=""></option>
                                @foreach ($statuts as $statut)
                                    <option value = "{{ $statut->id }} "> {{ $statut->nom }} </option>
                                @endforeach
                            </select>
                            @error('addLocation.statut_location_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><span class="text-indigo">Prix</span></label>
                            <input type="text" wire:model="addLocation.prix" class="form-control @error('addLocation.prix')
                                is-invalid
                            @enderror">
                            @error('addLocation.prix')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ajouté</button>
                <button type="submit" wire:click.prevent="gotoListLocation()" class="btn btn-danger">Retour à la Liste des Locations</button>
            </div>
        </form>
    </div>
</div>
