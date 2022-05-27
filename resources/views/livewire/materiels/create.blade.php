<div class="row p-4 pt-5">
    <div class="col-8">
        <div class="card card-dark text-bg-dark">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout des Matériels</h3>
            </div>
            <form role="form" wire:submit.prevent="addMateriel()">
                <div class="card-body">
                    @if($errors->any())
                            <div class="alert alert-danger" >
                                <h3><i class="icon fas fa-ban close" data-dismiss="alert" aria-label="close" id="hide"> &times;</i>Erreur !</h3>
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
                                <input type="text" class="form-control" wire:model="addMateriel.nom">
                            </div>
                            <div class="form-group">
                                <label for="">Catégorie</label>
                                <select class="form-control" wire:model="addMateriel.categories">
                                    <option value=""></option>
                                    @foreach ($categories as $categorie)
                                        <option value = "{{ $categorie->id }} "> {{ $categorie->nom }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- -->
                           
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
                    <button type="submit" wire:click.prevent="gotoListMateriel()" class="btn btn-danger"><i class="fas fa-long-arrow-alt-left"></i>Retour à la Liste des Articles </button>

                </div>
            </form>
        </div>
    </div>
</div>
