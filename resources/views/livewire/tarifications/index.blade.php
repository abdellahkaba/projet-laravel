<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Tarification-{{ $article->nom }}</h3>
                <div class="card-tools align-items-center d-flex">
                    <a href="{{ route('admin.gestarticles.articles') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Retour à la liste d'articles
                    </a>
                    <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color: #006 ; border-color: #0062cc " wire:click.prevent="newTarif()">
                        <i class="fas fa-user-plus"></i>
                        Nouvelle Tarification
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
                @if($addTarif)
                    <div class="p-4">
                        <div>
                            <div class="form-group">
                                <select
                                    wire:model="newTarif.duree_location_id"
                                    class="form-control
                                        @error('newTarif.duree_location_id')
                                            is-invalid
                                        @enderror">
                                    <option value="selected">Choisir une durée de Location</option>
                                    @foreach ($dureeLocations as $duree)
                                        <option value="{{ $duree->id }}">{{ $duree->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('newTarif.duree_location_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number" wire:model="newTarif.prix" class="form-control
                                     @error('newTarif.prix')
                                        is-invalid
                                    @enderror">
                                @error('newTarif.prix')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-link bg-success" wire:click.prevent="saveTarif"><i class="fa fa-check"></i>Valider
                            </button>
                            <button class="btn btn-link bg-danger" wire:click.prevent="cancelTarif"><i class="far fa-trash-alt" ></i>Cancel
                            </button>
                        </div>
                    </div> 
                @endif
               <div style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Durée Location</th>
                            <th class="text-center">Prix</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tarifs as $tarif)
                            <tr>
                                <td class="text-center">{{ ++$loop->index }}</td>
                                <td class="text-center">{{ $tarif->dureeLocation->libelle }}</td>
                                <td class="text-center">{{ $tarif->prixForHumans}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" wire:click="editTarif({{ $tarif->id }})">Modifier <i class="far fa-edit"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info">
                                        <h3><i class="icon fas fa-ban"></i> Information !</h3>
                                            Cet article n'a pas été Tarifier d'abord !
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
