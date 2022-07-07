
<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i> Liste des Locations </h3>

                <div class="card-tools align-items-center d-flex">
                    <div class="flex-grow-1 mr-2">
                        <form role="form" wire:submit.prevent="dateChercher()">
                            <div class="group-form">
                                <label for="">Verification de la date limite de locations</label>
                                <input type="date" class="form-control" wire:model="searchDate">
                            </div> <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info col-6">Verifier</button>
                                <a href="{{ route('admin.gestarticles.locations.printliste') }}" OnClick="javascript:window.print()" class="btn btn-success"> <i class="fa fa-print"></i> Imprimer</a>
                            </div>
                        </form>
                     </div>
                </div>
                </div>


            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 590px">
               <div style="height: 275px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-bold text-indigo">Image</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Article Loué</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Date debut</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Date fin</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Client</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Prix</th>
                            <th class="text-center text-uppercase text-bold text-indigo">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>
                                    @if($location->imageUrl != "" || $location->article->imageUrl != null)
                                        <img src="{{ asset($location->article->imageUrl) }}" alt="" style="width: 60px ; height: 60px;">
                                    @endif
                                </td>
                                <td class="text-center text-sm">{{ $location->article->nom }} - {{ $location->article->noSerie }}</td>
                                <td class="text-center text-sm">{{ $location->dateDebut }}</td>
                                <td class="text-center text-sm">
                                    {{ $location->dateFin }}
                                </td>

                                <td class="text-center text-sm">{{ $location->client->prenom }}  {{ $location->client->nom }}</td>
                                <td class="text-center text-sm">
                                    {{ $location->prix_for_humans}}
                                </td>

                                <td class="text-center text-sm">

                                    @if($searchDate > $location->dateFin)
                                        <button class="btn btn-success">Penaliter</button>
                                    @else
                                        <button class="btn btn-success" disabled="disabled">Penaliter</button>
                                    @endif
                                    {{-- @if(count($location->locations) > 0 )
                                        <a title="Tarif {{ $location->nom }}" href="{{ route('admin.gestlocations.locations.tarifs',['locationId' => $location->id]) }}" class="btn btn-link bg-purple">Tarifs <i class="fas fa-money-check"></i>
                                        </a>
                                    @else
                                        <a title="Tarif {{ $location->nom }}" href="{{ route('admin.gestlocations.locations.tarifs',['locationId' => $location->id]) }}" class="btn btn-link disabled bg-purple">Tarifs <i class="fas fa-money-check"></i>
                                        </a>
                                    @endif --}}
                                    {{-- <a title="Location {{ $location->nom }}" href="{{ route('employe.locations.locations.location',['locationId' => $location->id]) }}" class="btn btn-link bg-gradient-blue">Louer <i class="fas fa-money-check"></i> --}}
                                    {{-- </a> --}}
                                    {{-- @foreach ($locations as $location)
                                      @if($location->dateFin > "2022-06-05 00:00:00")
                                    <button class="btn btn-danger" wire:click="confirmDelete('{{ $location->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                    @endif
                                    @endforeach --}}


                                    {{-- @if(count($location->locations) > 0)
                                        <button class="btn btn-success" wire:click="editlocation('{{ $location->id }}')" disabled >Modifier <i class="far fa-edit"></i></button>
                                    @else
                                        <button class="btn btn-success" wire:click="editlocation('{{ $location->id }}')">Modifier <i class="far fa-edit"></i></button>
                                    @endif --}}
                                    {{-- <button class="btn btn-danger" wire:click="confirmDelete('{{ $location->id }}')">Delete <i class="far fa-trash-alt"></i></button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
            <div class="cadre-footer">
                <div class="float-right">
                    {{ $locations->links()}}
                </div>

            </div>
        </div>
    </div>
</div>





