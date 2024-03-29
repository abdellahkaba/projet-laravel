<div class="row p-4 pt-5">
    <div class="col-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Edition d'un Materiel</h3>
            </div>
            <form role="form" wire:submit.prevent="updateMateriel">
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
                                <input type="text" class="form-control" wire:model="editMateriel.nom">
                            </div>
                            <div class="form-group">
                                <label for="">Categorie</label>
                                <select class="form-control" wire:model="editMateriel.categorie_id">
                                    <option value="{{ $editMateriel["categorie_id"] }}">{{     $editMateriel["categories"]["nom"] }}
                                    </option>

                                </select>
                            </div>
                            <!-- -->
                            {{-- @if($editMateriel["article_proprietes"] != [])
                                <p style="border: 1px dashed black;"></p>
                                <div class="my-3 bg-gray-info p-3">
                                    @foreach ($editMateriel["article_proprietes"] as $index => $articlePropriete)
                                        <div class="form-group">
                                            <label for="">
                                                {{ $articlePropriete["propriete"]["nom"] }} @if(!$articlePropriete["propriete"]["estObligatoire"])(Optionel) @endif
                                            </label>
                                            <input type="text" class="form-control" wire:model="editMateriel.article_proprietes.{{ $index }}.valeur">
                                        </div>
                                    @endforeach
                                </div>
                            @endif --}}
                        </div>
                        <div class="p-4">
                            <div class="form-group">
                                <input type="file" name="" wire:model="editPhoto">
                            </div>

                            <div class="" style="border-block: 1px solid #eee ; border-radius : 30px ; height:72%; width: 72% ; overflow: hidden;">
                                @if (isset($editPhoto))
                                    <img src="{{ $editPhoto->temporaryUrl() }}" style="height: 200px ; width: 250px;">
                                @else
                                    <img src="{{asset($editMateriel['photo']) }}" style="height: 200px ; width: 250px;">
                                @endif

                                @isset($editPhoto)
                                 <button type="button" class="btn btn-default btn-sm mt-2" wire:click="$set('editPhoto', null)">Reinitialiser</button>
                                @endisset
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    @if($editChanged)
                    <button type="submit" class="btn btn-primary">Valider les Modification</button>
                    @endif
                    <button type="submit" wire:click.prevent="listeArticle()" class="btn btn-danger">Retour à la Liste des Articles</button>

                </div>


            </form>
        </div>
    </div>
</div>
