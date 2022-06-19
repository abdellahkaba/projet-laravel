<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"><i class="fas fa-list fa-2x"></i> Liste des Locations en cours</h3>

                <div class="card-tools align-items-center d-flex">
                    <a href="{{ route('admin.gestarticles.locations.printliste') }}" OnClick="javascript:window.print()" class="btn btn-success"> <i class="fa fa-print"></i> Imprimer</a>
                </div>

            </div>
        </div>

            <div class="card-body table-responsive p-0 table-striped">
                <div style="height: 300px">
                    <table class="table table-head-fixed text-nowrap bg-info">
                        <thead>
                            <tr>
                                <th class="text-center"><span class="text-indigo">N°</span></th>
                                <th class="text-center"><span class="text-indigo">Loué par</span></th>
                                <th class="text-center"><span class="text-indigo">Date Location</span></th>
                                <th class="text-center"><span class="text-indigo">Date Fin Location</span></th>
                                <th class="text-center"><span class="text-indigo">Statut est en</span></th>
                                <th class="text-center"><span class="text-indigo">Ajouté</span></th>
                                <th class="text-center"><span class="text-indigo">Effectué par</span></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <td class="text-center">{{ ++$loop->index }}</td>
                                    <td class="text-center text-center text-uppercase"><span class="">{{ $location->client->nom }} {{ $location->client->prenom }}</span></td>
                                    <td class="text-center text-uppercase">{{ $location->dateFin }}</td>
                                    <td class="text-center text-uppercase">{{ $location->dateDebut }}</td>
                                    <td class="text-center text-uppercase">{{ $location->statuts->nom }}</td>
                                    <td class="text-center text-uppercase">{{ $location->created_at->diffForHumans() }}</td>
                                    <td class="text-center text-uppercase">{{ $location->user->nom }} {{ $location->user->prenom }}</td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </div>
</div>


{{-- <script type="text/javascript">
    $(document).ready(function(){
        $(.'btnprint').printPage();
    });
    window.printPage()
</script> --}}

<script>
    window.addEventListener("showSuccessMessage", event =>{
     Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: event.detail.message || "Operation effectuée avec succès.",
        showConfirmButton: false,
        timer: 4000
    })
})
</script>
