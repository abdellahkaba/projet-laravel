<div class="card">
    <div class="card-header bg-gradient-primary">
        <h3>Gestion de carateristiques de {{ optional($selectedTypeArticle)->nom }}</h3>
    </div>

    <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
        <div class="d-flex my-4 bg-gray-light p-3">
            <div class="d-flex flex-grow-1 mr-2">
                <div class="flex-grow-1 mr-2">
                    <input type="text" placeholder="Nom" class="form-control
                    @error('newAddPropriete.nom')
                        is-invalid
                    @enderror"
                    wire:model="newAddPropriete.nom">
                    @error('newAddPropriete.nom')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="flex-grow-1">
                    <select name="" id="" class="form-control
                    @error('newAddPropriete.estObligatoire')
                        is-invalid
                    @enderror"
                    wire:model="newAddPropriete.estObligatoire">
                        <option value="">--Champ obligatoire--</option>
                        <option value="1">OUI</option>
                        <option value="0">NON</option>
                    </select>
                    @error('newAddPropriete.estObligatoire')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div>
                <button class="btn btn-success" wire:click="addPropriete()">Ajouter</button>
                <button class="btn btn-danger" wire:click="backTypeArticle">Retour A la liste</button>
            </div>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="bg-primary">
                    <th>Nom</th>
                    <th>Est obligatoire</th>
                    <th>Action</th>
                </thead>
                <tbody class="tbody">
                    @forelse ($proprietesTypeArticles as $prop)
                    <tr>
                        <td>{{ $prop->nom }}</td>
                        <td>{{ $prop->estObligatoire == 0 ? "NON" : "OUI" }}</td>
                        <td>
                            <button class="btn btn-link" wire:click="showEditProp('{{ $prop->id }}')"><i class="far fa-edit"></i>
                            </button>
                            @if(count($prop->articles)== 0)
                            <button class="btn btn-link" wire:click="showDeleteProp('{{ $prop->id }}')"><i class='fa fa-trash'></i></button>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <span class="text-info ">Notre Proprietés n'a aucun article pour le Moment</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="cadre-footer">
            <div class="float-right">
                {{ $proprietesTypeArticles->links()}}
            </div>
        </div>
    </div>
</div>
