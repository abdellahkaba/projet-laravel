<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="card-title"> <i class="fas fa-users fa-2x"></i> Liste des Utilisateurs</h1>

                <div class="card-tools align-items-center d-flex">
                    <h1>
                        <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color: green" wire:click.prevent="gotoaddUser()">
                            <i class="fas fa-user-plus"></i>
                            Nouvel Utilisateur
                        </a>
                    </h1>
                    <div class="input-group input-group-lg" style="width: 290px;">
                        <input type="text" name="table_search" class="form-control float-right" wire:model.debounce.100ms="search" placeholder="Rechercher par un nom">
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
                            <th style="width:5% " class="text-center text-indigo"></th>
                            <th style="width: 25% " class="text-center text-indigo text-bold text-uppercase">Utilisateur</th>
                            <th style="width: 30%" class="text-center text-indigo text-bold text-uppercase">Role</th>
                            <th style="width: 30%" class="text-center text-indigo text-bold text-uppercase">Ajouté</th>
                            <th style="width: 20%" class="text-center text-indigo text-bold text-uppercase">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if ($user->sexe == "F")
                                    <img src="{{ asset('images/manager.png') }}" width="25" />
                                @else
                                    <img src="{{ asset('images/bussiness-man.png') }}"width="25" />
                                @endif
                            </td>
                            <td class="text-center text-uppercase text-sm">{{ $user->nom }} {{ $user->prenom }}</td>
                            <td class="text-center text-uppercase text-sm text-blue">{{ $user->all_role_names }}</td>
                            <td class="text-center text-uppercase text-sm"><span class="tag tag-success">
                                {{ $user->created_at->diffForHumans() }}</span></td>
                            <td class="text-center">
                                <button class="btn btn-success" wire:click="gotoEditUser('{{ $user->id }}')">Edit <i class="far fa-edit"></i></button>
                                @if (count($user->roles) == 0)
                                    <button class="btn btn-danger" wire:click="confirmDelete('{{ $user->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                @endif



                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="cadre-footer">
                <div class="float-right">
                {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

