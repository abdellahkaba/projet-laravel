<div class="row-cols-10 p-4 pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire de Modification d'une Location</h3>
        </div>
        <form role="form" wire:submit.prevent="updateLocation()">
                    <div class="p-4">
                        <div class="row">
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Date de mis à jour de la fin de location</span></label>
                                    <input type="date" wire:model="editLocation.dateDebut" value="{{ $editLocation["dateDebut"] }}" class="form-control
                                     @error('editLocation.dateDebut')
                                    is-invalid
                                     @enderror">
                                    @error('editLocation.dateDebut')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-12">
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
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Choisir Ton nom</span></label>
                                    <select
                                        disabled wire:model="editLocation.user_id" class="form-control @error('editLocation.user_id')
                                    is-invalid
                                @enderror">
                                <option value="{{ $editLocation["user_id"] }}">
                                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                                   </option>
                                    </select>
                                    @error('editLocation.user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Client</span></label>
                                    <select
                                        wire:model="editLocation.client_id" class="form-control @error('editLocation.client_id')
                                    is-invalid
                                @enderror">

                                      <option value="{{ $editLocation["client_id"] }}">
                                       </option>
                                    </select>
                                    @error('editLocation.client_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                </div>
                            </div> --}}
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Prix</span></label>
                                    <input type="text" disabled wire:model="editLocation.prix" class="form-control @error('editLocation.prix')
                                        is-invalid
                                    @enderror">
                                    @error('editLocation.prix')
                                    <span class="text-danger">{{ $message }}</span>
                                   @enderror
                                </div>
                            </div> --}}
                        </div>
                    </div>


            <div class="card-footer row">
                <button type="submit" class="btn btn-primary">Ajouté</button>
                {{-- <button type="submit" class="btn btn-danger" wire:click="gotoListLocation">Retour</button> --}}

                    <div class="col-2">
                        <a href="{{ route('employe.locations.locations.create') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                            <i class="fas fa-long-arrow-alt-left"></i>
                            Retour
                        </a>
                    </div>


            </div>
        </form>
    </div>
</div>

