<div class="row-cols-10 p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire de Modification d'une Location</h3>
        </div>
        <form role="form" wire:submit.prevent="updateLocation()">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Date de mis à jour de la fin de location</span></label>
                                    <input type="date" wire:model="editLocation.dateDebut" class="form-control
                                     @error('editLocation.dateDebut')
                                    is-invalid
                                     @enderror">
                                    @error('editLocation.dateDebut')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Choisir le Statut Terminer</span> </label>
                                    <select
                                        wire:model="editLocation.statut_location_id"
                                        class="form-control
                                            @error('editLocation.statut_location_id')
                                                is-invalid
                                            @enderror">
                                        <option value="selected"></option>
                                        @foreach ($statuts as $statut)
                                            <option value="{{ $statut->id }}">{{ $statut->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('editLocation.statut_location_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Choisir Ton nom en tant Modificateur</span></label>
                                    <select wire:model="editLocation.user" class="form-control @error('editLocation.user_id')
                                    is-invalid
                                @enderror">
                                        <option value=""></option>
                                        @foreach ($users as $user)
                                            <option value = "{{ $user->id }} "> {{ $user->nom }} {{ $user->prenom }} </option>
                                        @endforeach
                                    </select>
                                    @error('editLocation.user_id')
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

