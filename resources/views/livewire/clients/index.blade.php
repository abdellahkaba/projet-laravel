<div>
    @if($currentPage == PAGECREATEFORM)
       @include("livewire.clients.create")
    @endif
    @if($currentPage == PAGEEDITFORM)
        @include("livewire.clients.edit")
    @endif
    @if($currentPage == PAGELISTE)
        @include("livewire.clients.liste")
    @endif
</div>

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
                       @this.deleteClient(event.detail.message.data.client_id)
                    }

                }
           })
        })
</script>

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


