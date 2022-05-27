<div>
    @if($pageMateriel == MATERIELLISTE)
       @include("livewire.materiels.liste")
    @endif
    @if($pageMateriel == MATERIELEDIT)
        @include("livewire.materiels.edit")
    @endif
    @if($pageMateriel == MATERIELCREATE)
    @include("livewire.materiels.create")
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
                   @this.deleteMateriel(event.detail.message.data.materiel_id)
                }
              //  @this.deleteProp(event.detail.message.data.propriete_article_id)



            }
       })
    })
</script>