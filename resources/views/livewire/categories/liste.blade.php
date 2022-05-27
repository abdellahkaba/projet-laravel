
<div>
    <div class="row p-4 pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title"> <i class="fas fa-list fa-2x"></i> Liste des catégories matériels</h3>
                    <div class="card-tools align-items-center d-flex">
                        <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color:blueviolet" wire:click.prevent="showCategorieForm">
                            <i class="fas fa-user-plus"></i>
                            Nouveau Catégorie
                        </a>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" wire:model.debounce.100ms="search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 40%">Catégorie materiels</th>
                                <th style="width: 40%" class="text-center">Ajouté</th>
                                <th style="width: 20%" class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($isAddCategorieMateriel)
                            <tr>
                                <td colspan="2">
                                    <input type="text" wire:keydown.enter="addNewTypeArticle"
                                     class="form-control
                                        @error('newCategorieName')
                                            is-invalid
                                        @enderror"
                                        wire:model="newCategorieName">
                                        @error('newCategorieName')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link bg-info" wire:click.prevent="addNewCategorie"><i class="fa fa-check"></i>Valider
                                    </button>
                                    <button class="btn btn-link bg-warning" wire:click.prevent="showCategorieForm"><i class="far fa-trash-alt" ></i>Annuler
                                    </button>
                                </td>
                            </tr>
                        @endif

                            @foreach ($categories as $categorie)
                                <tr>
                                    <td>{{ $categorie->nom }}</td>
                                    <td class="text-center">{{ optional($categorie->created_at)->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success" wire:click="editCategorie('{{ $categorie->id }}')">Edit <i class="far fa-edit"></i>
                                        </button>
                                        @if (count($categorie->materiels) == 0)
                                        <button class="btn btn-danger" wire:click="confirmDelete('{{ $categorie->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="cadre-footer">
                    <div class="float-right">
                        {{ $categories->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>