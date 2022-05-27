<div>
    @if($pageCategorie == CATEGORIELISTE)
       @include("livewire.categories.liste")
    @endif
    @if($pageCategorie == CATEGORIECREATE)
        @include("livewire.categories.create")
    @endif

</div>

<script>
    window.addEventListener('showEditForm', function(e){
        Swal.fire({
            title: 'Edition de categorie de matériels',
            input: 'text',
            inputValue: e.detail.categorie.nom,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continuer <i class="fa fa-check"></i>',
            cancelButtonText: 'Annuler <i class="fa fa-times"></i>' ,
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire!'
                }
                @this.updateCategorie(e.detail.categorie.id, value)
            }
        })

    })
</script>

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
                   @this.deleteCategorie(event.detail.message.data.categorie_id)
                }
                //@this.deleteProp(event.detail.message.data.propriete_article_id)



            }
       })
    })
</script>