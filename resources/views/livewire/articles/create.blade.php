<div class="row p-4 pt-5">
    <div class="col-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout d'un Article</h3>
            </div>
            <form role="form" wire:submit.prevent="addArticle()">
                <div class="card-body">
                    @if($errors->any())
                            <div class="alert alert-danger">
                                <h3><i class="icon fas fa-ban"></i>Erreur !</h3>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="d-flex">

                        <div class=" my-4 p-3 flex-grow-1 bg-light">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" wire:model="addArticle.nom">
                            </div>
                            <div class="form-group">
                                <label for="">Numero de Série</label>
                                <input type="text" class="form-control" wire:model="addArticle.noSerie">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select class="form-control" wire:model="addArticle.type">
                                    <option value=""></option>
                                    @foreach ($typearticles as $typearticle)
                                        <option value = "{{ $typearticle->id }} "> {{ $typearticle->nom }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- -->
                            @if($proprieteArticles != null)
                                <p style="border: 1px dashed black;"></p>
                                <div class="my-3 bg-gray-info p-3">
                                    @foreach ($proprieteArticles as $propriete)
                                        <div class="form-group">
                                            <label for="">
                                                {{ $propriete->nom }} @if(!$propriete->estObligatoire)(Optionel) @endif
                                            </label>
                                            @php
                                                $field = "addArticle.prop.".$propriete->nom ;
                                            @endphp
                                            <input type="text" class="form-control" wire:model="{{ $field }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="form-group">
                                <input type="file" name="" wire:model="addPhoto">
                            </div>

                            <div class="" style="border-block: 1px solid #eee ; border-radius : 30px ; height:72%; width: 72% ; overflow: hidden;">
                                @if ($addPhoto)
                                    <img src="{{ $addPhoto->temporaryUrl() }}" style="height: 200px ; width: 250px;">
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ajouté</button>
                    <button type="submit" wire:click.prevent="gotoListArticle()" class="btn btn-danger">Retour à la Liste des Articles</button>

                </div>
            </form>
        </div>
    </div>
</div>
