
<div>
    <div class="row p-4 pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title"> <i class="fas fa-list fa-2x"></i> Liste des types d'article</h3>
                    <div class="card-tools align-items-center d-flex">
                        <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color:blueviolet" wire:click.prevent="showTypeArticleForm">
                            <i class="fas fa-user-plus"></i>
                            Nouveau type d'article
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
                                <th style="width: 40%">Type d'article</th>
                                <th style="width: 40%" class="text-center">Ajouté</th>
                                <th style="width: 20%" class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if ($isAddTypeArticle)
                                <tr>
                                    <td colspan="2">
                                        <input type="text" wire:keydown.enter="addNewTypeArticle"
                                         class="form-control
                                            @error('newTypeArticleName')
                                                is-invalid
                                            @enderror"
                                            wire:model="newTypeArticleName">
                                            @error('newTypeArticleName')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-success" wire:click.prevent="addNewTypeArticle"><i class="fa fa-check"></i>Valider
                                        </button>
                                        <button class="btn btn-danger" wire:click.prevent="showTypeArticleForm"><i class="far fa-trash-alt" ></i>Annuler
                                        </button>
                                    </td>
                                </tr>
                            @endif

                            @foreach ($typearticles as $typearticle)
                                <tr>
                                    <td>{{ $typearticle->nom }}</td>
                                    <td class="text-center">{{ optional($typearticle->created_at)->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success" wire:click="editTypeArticle('{{ $typearticle->id }}')">Edit <i class="far fa-edit"></i>
                                        </button>
                                        <button  class="btn btn-info" wire:click="gotoPropriete('{{ $typearticle->id }}')"><i class="fa fa-list">Proprietés</i>
                                        </button>
                                        @if (count($typearticle->articles) == 0 && count($typearticle->proprietes) == 0)
                                        <button class="btn btn-danger" wire:click="confirmDelete('{{ $typearticle->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="cadre-footer">
                    <div class="float-right">
                        {{ $typearticles->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>














