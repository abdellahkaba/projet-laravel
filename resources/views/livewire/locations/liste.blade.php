<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Location-{{ $article->nom }}</h3>
                <div class="card-tools align-items-center d-flex">
                    <a href="{{ route('admin.gestarticles.articles') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Retour à la liste d'articles
                    </a>
                    <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color: #006 ; border-color: #0062cc " wire:click.prevent="newLocation()">
                        <i class="fas fa-user-plus"></i>
                        Nouvelle Location
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
                @if($addLocation)
                    <div class="p-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Date de Location</label>
                                    <input type="date" wire:model="newLocation.dateDebut" class="form-control
                                     @error('newLocation.dateDebut')
                                    is-invalid
                                     @enderror">
                                    @error('newLocation.dateDebut')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Date de Fin</label>
                                    <input type="date" wire:model="newLocation.dateFin" class="form-control
                                    @error('newLocation.dateFin')
                                    is-invalid
                                     @enderror">
                                    @error('newLocation.dateFin')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <select
                                        wire:model="newLocation.statut_location_id"
                                        class="form-control
                                            @error('newLocation.statut_location_id')
                                                is-invalid
                                            @enderror">
                                        <option value="selected">Choisir une durée de Location</option>
                                        @foreach ($statuts as $statut)
                                            <option value="{{ $statut->id }}">{{ $statut->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('newLocation.statut_location_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Client</label>
                                    <select wire:model="newLocation.client" class="form-control @error('newLocation.client_id')
                                    is-invalid
                                @enderror
                                ">
                                        <option value=""></option>
                                        @foreach ($clients as $client)
                                            <option value = "{{ $client->id }} "> {{ $client->nom }} </option>
                                        @endforeach
                                    </select>
                                    @error('newLocation.client_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nom Employé</label>
                                    <select wire:model="newLocation.user" class="form-control @error('newLocation.user_id')
                                    is-invalid
                                @enderror">
                                        <option value=""></option>
                                        @foreach ($users as $user)
                                            <option value = "{{ $user->id }} "> {{ $user->nom }} </option>
                                        @endforeach
                                    </select>
                                    @error('newLocation.user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-link bg-success" wire:click.prevent="saveLocation"><i class="fa fa-check"></i>Valider
                            </button>
                            <button class="btn btn-link bg-danger" wire:click.prevent="cancelLocation"><i class="far fa-trash-alt" ></i>Cancel
                            </button>
                        </div>
                    </div>
                @endif
               <div style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">Client</th>
                            {{-- <th class="text-center">Date debut</th>
                            <th class="text-center">Date Fin</th> --}}
                            <th class="text-center">Statut</th>
                            <th class="text-center">Ajouté</th>
                            <th class="text-center">Effectué par</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $location)
                            <tr>
                                <td class="text-center">{{ $location->client->nom }}-{{ $location->client->prenom }}</td>
                                {{-- <td class="text-center">{{ $location->dateDebut }}</td>
                                <td class="text-center">{{ $location->dateFin }}</td> --}}
                                <td class="text-center">{{ $location->statuts->nom }}</td>
                                <td class="text-center">{{ $location->created_at->diffForHumans() }}</td>
                                <td class="text-center">{{ $location->user->nom }}-{{ $location->user->prenom }}</td>
                                <td class="text-center">
                                    <a title="Paiement" href="
                                    {{ route('employe.locations.locations.paiements',['locationId' => $location->id]) }}
                                    " class="btn btn-link bg-purple">Payer <i class="fas fa-money-check"></i>
                                    </a>
                                    {{-- {{ route('admin.gestarticles.articles') }} --}}
                                    <button class="btn btn-success" wire:click="editLocation({{ $location->id }})">Modifier <i class="far fa-edit"></i>
                                    </button>
                                    @if ($location->statuts->nom == "En cours")
                                        <button class="btn btn-danger" disabled wire:click="confirmDelete('{{ $location->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                    @else
                                    <button class="btn btn-danger" wire:click="confirmDelete('{{ $location->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                    @endif
                                    
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-info">
                                        <h3><i class="icon fas fa-ban"></i> Information !</h3>
                                            Cet article n'a pas été Locationier d'abord !
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
