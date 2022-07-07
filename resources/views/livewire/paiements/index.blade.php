<div class="row p-4 pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title"> <i class="fas fa-list fa-2x"></i>Paiement de Location</h3>
                <div class="card-tools align-items-center d-flex">
                    <a href="{{ route('employe.locations.locations.create') }}" class="btn btn-link text-white mr-4 d-block bg-red" style="border-color: #0062cc ">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Retour à la liste
                    </a>

                            <a href="" class="btn btn-link text-white mr-4 d-block" aria-disabled="true" style="background-color: green ; border-color: #0062cc " wire:click.prevent="newPaiement">
                        <i class="fas fa-user-plus"></i>
                        Nouvel Paiement
                            </a>


                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped">
                @if($addPaiement)
                    <div class="p-4">
                        <div>
                            <div class="form-group">
                                <label for=""><span class="text-indigo">Montant</span></label>
                                <input type="number" wire:model="newPaiement.montant" class="form-control
                                    @error('newPaiement.montant')
                                        is-invalid
                                    @enderror">
                                @error('newPaiement.montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""><span class="text-indigo">Date de Paiment</span></label>
                                <input type="date" wire:model="newPaiement.datePaiement" class="form-control
                                @error('newPaiement.datePaiement')
                                is-invalid
                                 @enderror">
                                @error('newPaiement.datePaiement')
                                 <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for=""><span class="text-indigo">Veuillez choisir <i>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</i></span></label>
                                <select
                                    wire:model="newPaiement.user_id"
                                    class="form-control
                                        @error('newPaiement.user_id')
                                            is-invalid
                                        @enderror">
                                    <option value="selected">----------</option>
                                    @foreach ($users as $user)
                                        <option class="text-indigo" value="{{ $user->id }}">{{ $user->prenom }} {{ $user->nom }}</option>
                                    @endforeach
                                </select>
                                @error('newPaiement.user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-link bg-success text-uppercase text-bold" wire:click.prevent="savePaiement"><i class="fa fa-check"></i>Valider
                            </button>
                            <button class="btn btn-link bg-danger text-uppercase text-bold" wire:click.prevent="cancelPaiement"><i class="far fa-trash-alt" ></i>Cancel
                            </button>
                        </div>
                    </div>
                @endif
               <div style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center  text-bold text-indigo">N°</th>
                            <th class="text-center  text-bold text-indigo">Date de Paiement</th>
                            <th class="text-center  text-bold text-indigo">Montant</th>
                            <th class="text-center  text-bold text-indigo">Effectué par</th>
                            <th class="text-center  text-bold text-indigo">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paiements as $paiement)
                            <tr>
                                <td class="text-center  ">{{ ++$loop->index }}</td>
                                <td class="text-center ">{{ $paiement->datePaiement }}</td>
                                <td class="text-center ">{{ $paiement->montantForHumans}}</td>
                                <td class="text-center   "> {{ $paiement->user->prenom }} {{ $paiement->user->nom}} </td>
                                <td class="text-center    ">

                                    {{-- <button class="btn btn-success  " wire:click="editPaiement({{ $paiement->id }})"><i class="far fa-edit"></i> Edit
                                    </button> --}}

                                    <button class="btn btn-danger  " wire:click="confirmDelete('{{ $paiement->id }}')"><i class="far fa-trash-alt"></i> Delete  </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-info">
                                        <h3><i class="icon fas fa-ban"></i> Information !</h3>
                                            Aucun paiement sur cet Article d'abord !
                                    </div>
                                </td>
                            </tr>
                        @endforelse

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
