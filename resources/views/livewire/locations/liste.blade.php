<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Location-{{ $article->nom }}</h3>
                <div class="card-tools align-items-center d-flex">
                    @if(auth()->user()->roles == "admin")
                    <a href="{{ route('admin.gestarticles.articles') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Retour à la liste d'articles
                    </a>
                    @else
                    <a href="{{ route('employe.locations.locations.create') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Retour à la liste d'articles
                    </a>
                    @endif

                    @forelse ($locations as $location)
                        @if($location->statuts->nom == "En cours")
                            <h2 class="badge badge-info">En cours de Location <br>
                                Veuillez le modifier pour terminer cette location
                            </h2>
                        @endif
                    @empty
                    <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color: #006 ; border-color: #0062cc " wire:click.prevent="newLocation()">
                        <i class="fas fa-user-plus"></i>
                        Nouvelle Location
                    </a>
                    @endforelse

                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
               @if($addLocation)
                    <div class="p-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Date de debut de location</span></label>
                                    <input  type="date" wire:model="newLocation.dateDebut" class="form-control
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
                                    <label for=""><span class="text-indigo">Date de fin de location</span></label>
                                    <input  type="date" wire:model="newLocation.dateFin" class="form-control
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
                                    <label for=""><span class="text-indigo">Veuillez mettre le statut en cour pour louer</span></label>
                                    <select
                                        wire:model="newLocation.statut_location_id"
                                        class="form-control
                                            @error('newLocation.statut_location_id')
                                                is-invalid
                                            @enderror">
                                        <option value="selected"></option>
                                        @foreach ($statuts as $statut)
                                            <option class="text-blue" value="{{ $statut->id }}">{{ $statut->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('newLocation.statut_location_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Donner le nom client</span></label>
                                    <select wire:model="newLocation.client" class="form-control @error('newLocation.client_id')
                                    is-invalid
                                     @enderror
                                     ">
                                        <option value=""></option>
                                        @foreach ($clients as $client)
                                            <option class="text-blue" value = "{{ $client->id }} "> {{ $client->nom }} {{ $client->prenom }} </option>
                                        @endforeach
                                    </select>
                                    @error('newLocation.client_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><span class="text-indigo">Veuillez selectionner votre nom pour l'enregistrer</span></label>
                                    <select wire:model="newLocation.user" class="form-control @error('newLocation.user_id')
                                    is-invalid
                                @enderror">
                                        <option value=""></option>
                                        @foreach ($users as $user)
                                            <option class="text-blue" value = "{{ $user->id }} "> {{ $user->nom }} {{ $user->prenom }} </option>
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
                                <th class="text-center"><span class="text-indigo">Client</span></th>
                                {{-- <th class="text-center">Date debut</th>
                                <th class="text-center">Date Fin</th> --}}
                                <th class="text-center"><span class="text-indigo">Statut</span></th>
                                <th class="text-center"><span class="text-indigo">Ajouté</span></th>
                                <th class="text-center"><span class="text-indigo">Effectué par</span></th>
                                <th class="text-center"><span class="text-indigo">Action</span></th>
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
                                                Cet article n'est pas loué d'abord !
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
