<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Paiement de Location</h3>
                <div class="card-tools align-items-center d-flex">
                    Liste des Paiements effectués
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
               <div style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            {{-- <th class="text-center text-bold text-indigo">Article</th> --}}
                            <th class="text-center">Date de Paiement</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Effectué par</th>
                            {{-- <th class="text-center text-uppercase text-bold text-indigo">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                            <tr>
                                <td class="text-center text-center">{{ ++$loop->index }}</td>
                                {{-- <td class="text-center text-center"><a href="{{ route('employe.paiements.paiements.article',['articleId' => $paiement->id]) }}">{{ $paiement->location_id-> }}</a></td> --}}
                                <td class="text-center">{{ $paiement->datePaiement }}</td>
                                <td class="text-center">{{ $paiement->montantForHumans}}</td>
                                <td class="text-center"> {{ $paiement->user->prenom }} {{ $paiement->user->nom}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("showDangerMessage", event =>{
     Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: event.detail.message || "Operation non effectuée.",
        showConfirmButton: false,
        timer: 6000
    })
})
</script>
<script>
    window.addEventListener("showConfirmMessage", event=>{
        Swal.fire({
            title: event.detail.message.title,
            text: event.detail.message.text,
            icon: event.detail.message.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continuer!',
            cancelButtonText: 'Annuler'
            }).then((result) => {
            if (result.isConfirmed) {
                if(event.detail.message.data){
                   @this.deletePaiement(event.detail.message.data.paiement_id)
                }
              //  @this.deleteProp(event.detail.message.data.propriete_article_id)



            }
       })
    })
</script>
