<div>
    @if($currentPage == PAGECREATEFORM)
       @include("livewire.utilisateurs.create")
    @endif
    @if($currentPage == PAGEEDITFORM)
        @include("livewire.utilisateurs.edit")
    @endif
    @if($currentPage == PAGELISTE)
        @include("livewire.utilisateurs.liste")
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
                       @this.deleteUser(event.detail.message.data.user_id)
                    }

                    @this.resetPassword()

                }
           })
        })
</script>


