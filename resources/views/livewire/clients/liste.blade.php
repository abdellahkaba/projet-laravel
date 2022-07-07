<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h1 class="card-title"> <i class="fas fa-users fa-2x"></i> Liste des Clients</h1>

                <div class="card-tools align-items-center d-flex">
                    <h1>
                        <a href="" class="btn btn-link text-white mr-4 d-block lg" style="background-color: green" wire:click.prevent="gotoaddClient()">
                            <i class="fas fa-user-plus"></i>
                            Nouvel client
                        </a>
                    </h1>
                    <div class="input-group input-group-lg" style="width: 300px;">
                        <input type="text" name="table_search" class="form-control float-right" wire:model.debounce.100ms="search" placeholder="rechecher par nom">
                        <div class="input-group-append" wire:model.debounce.100ms="search">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 550px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 5% " class="text-center"></th>
                            <th style="" class="text-center text-uppercase text-bold text-indigo">Client</th>
                            <th style="" class="text-center text-uppercase text-bold text-indigo">Adresse</th>
                            <th style="" class="text-center text-uppercase text-bold text-indigo">Telephone</th>
                            <th style="" class="text-center text-uppercase text-bold text-indigo">Enregisté</th>

                            <th style="width: 20%" class="text-center text-uppercase text-bold text-indigo">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>
                                @if ($client->sexe == "F")
                                    <img src="{{ asset('images/manager.png') }}" width="25" />
                                @else
                                    <img src="{{ asset('images/bussiness-man.png') }}" width="25" />
                                @endif
                            </td>
                            <td class="text-center">{{ $client->prenom }} {{ $client->nom }}</td>

                            <td class="text-center">{{ $client->adresse }}</td>
                            <td class="text-center">{{ $client->telephone }}</td>

                            <td class="text-center"><span class="tag tag-success">
                                {{ $client->created_at->diffForHumans() }}</span>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-success" wire:click="gotoEditClient('{{ $client->id }}')">Edit <i class="far fa-edit"></i></button>
                                <button class="btn btn-danger" wire:click="confirmDelete('{{ $client->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="cadre-footer">
                <div class="float-right">
                {{ $clients->links() }}
                </div>

            </div>
        </div>
    </div>
</div>



