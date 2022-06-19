<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Liste des Tarifications Effectuées</h3>
                <div class="card-tools align-items-center d-flex">
                    <button>Imprimer</button>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
               <div style="height: 500px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center text-indigo text-uppercase">N°</th>
                            <th class="text-center text-indigo text-uppercase">Article Tarifié</th>
                            <th class="text-center text-indigo text-uppercase">Durée Etait</th>
                            <th class="text-center text-indigo text-uppercase">Prix de Tarification</th>
                            {{-- <th class="text-center text-indigo text-uppercase">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifs as $tarif)
                            <tr>
                                <td class="text-center  text-uppercase">{{ ++$loop->index }}</td>
                                <td class="text-center  text-uppercase">{{ $tarif->article->nom }}-{{ $tarif->article->noSerie }}</td>
                                <td class="text-center  text-uppercase">{{ $tarif->dureeLocation->libelle }}</td>
                                <td class="text-center  text-uppercase">{{ $tarif->prixForHumans}}</td>
                                {{-- <td class="text-center">
                                    <button class="btn btn-success" wire:click="editTarif({{ $tarif->id }})">Modifier <i class="far fa-edit"></i></button>
                                </td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
