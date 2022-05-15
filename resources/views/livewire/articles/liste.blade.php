<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i> Liste des Articles</h3>
                <div class="card-tools align-items-center d-flex">
                    <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="gotoaddArticle()">
                        <i class="fas fa-user-plus"></i>
                        Ajouter un article
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
            <div class="card-body table-responsive p-0 table-striped">
                <div class="d-flex justify-content-end p-4 bg-indigo">
                    <div class="form-group mr-3">
                        <label for="filtreType">Filtrer par Type</label>
                        <select id="filtreType" wire:model="filtreType" class="form-control">
                            <option value=""></option>
                            @foreach ($typearticles as $typearticle)
                                <option value="{{ $typearticle->id }}">{{ $typearticle->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filtreEtat">Filtrer par Etat</label>
                        <select id="filtreEtat" wire:model="filtreEtat" class="form-control">
                            <option value=""></option>
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                    </div>
                </div>
               <div style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Etat</th>
                            <th class="text-center">Ajouté</th>
                            <th class="text-center">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td>
                                    @if($article->imageUrl != "" || $article->imageUrl != null)
                                        <img src="{{ asset($article->imageUrl) }}" alt="" style="width: 60px ; height: 60px;">
                                    @endif
                                </td>
                                <td class="text-center">{{ $article->nom }} - {{ $article->noSerie }}</td>
                                <td class="text-center">{{ $article->type->nom }}</td>
                                <td class="text-center">
                                    @if($article->estDisponible)
                                        <span class="badge badge-success">Disponible</span>
                                    @else
                                        <span class="badge badge-danger">Indisponible</span>
                                    @endif
                                </td>

                                <td class="text-center">{{ optional($article->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" wire:click="editArticle('{{ $article->id }}')">Modifier <i class="far fa-edit"></i></button>
                                    <button class="btn btn-danger" wire:click="confirmDelete('{{ $article->id }}')">Delete <i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-warning">
                                        <h3><i class="icon fas fa-ban"></i> Information !</h3>
                                            Auncune donnée trouvée par rapport à cette Information
                                    </div>
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>
               </div>
            </div>
            <div class="cadre-footer">
                <div class="float-right">
                    {{ $articles->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
