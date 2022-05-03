<div>
    @if($pageCourant == PROPRIETEINDEX)
       @include("livewire.typearticles.index")
    @endif
    @if($pageCourant == PROPRIETEPAGE)
        @include("livewire.typearticles.propriete")
    @endif

</div>

<script>
    window.addEventListener('showEditForm', function(e){
        Swal.fire({
            title: 'Edition d\'un type d\'article',
            input: 'text',
            inputValue: e.detail.typearticle.nom,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continuer <i class="fa fa-check"></i>',
            cancelButtonText: 'Annuler <i class="fa fa-times"></i>' ,
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire!'
                }
                @this.updateTypeArticle(e.detail.typearticle.id, value)
            }
        })

    })
</script>
<script>
    window.addEventListener('showEditFormProp', function(e){
        Swal.fire({
            title: 'Edition de la Proprieté d\'article',
            input: 'text',
            inputValue: e.detail.prop.nom,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continuer <i class="fa fa-check"></i>',
            cancelButtonText: 'Annuler <i class="fa fa-times"></i>' ,
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire!'
                }
                @this.updateProprieteArticle(e.detail.prop.id, value)
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
                       @this.deleteTypeArticle(event.detail.message.data.type_article_id)
                    }
                    @this.deleteProp(event.detail.message.data.propriete_article_id)



                }
           })
        })
</script>
