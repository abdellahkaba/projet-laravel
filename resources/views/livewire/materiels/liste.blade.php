
<div class="card">
    <div class="card-header bg-gradient-primary">
        <h3 class="card-title"> <i class="fas fa-list fa-2x"></i> Liste des Matériels</h3>
        <div class="card-tools align-items-center d-flex">
            <a href="" class="btn btn-link text-white mr-4 d-block" style="background-color: #000D ; border-color: #0062cc " wire:click.prevent="gotoAddMateriel()">
                <i class="fas fa-user-plus"></i>
                Ajouter un matériels
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
    <div class="card-body">
        @foreach ($materiels as $materiel)
    <div class="container mt-2">
        <div class="col-6 border border-4">
            <div class="d-flex">
                <div class="my-1 p-1 flex-grow-1">
                    <h4>{{ $materiel->nom }}</h4> 
                </div>
                <div class="p-4">
                     <div class="" style="border-block: 1px solid #eee ; border-radius : 30px ; height:72%; width: 72% ; overflow: hidden;">
                        @if($materiel->photo != "" || $materiel->photo != null)
                        <img src="{{ asset($materiel->photo) }}" alt="" style="width: 170px ; height: 170px;">
                    @endif
                    </div>
                </div>
                <div class="">
                    <button class="btn btn-success">Vendre</button>
                    <button class="btn btn-warning">Stock</button>
                </div>
            </div>   
        </div>
    </div>
    
@endforeach
    </div>
    <div class="cadre-footer">
        <div class="float-right">
            {{ $materiels->links()}}
        </div>

    </div>
</div>














