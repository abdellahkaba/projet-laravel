<div>
    @if($ArticlePage == PAGECREATEFORM)
       @include("livewire.articles.create")
    @endif
    @if($ArticlePage == PAGEEDITFORM)
        @include("livewire.articles.edit")
    @endif
    @if($ArticlePage == PAGELISTE)
        @include("livewire.articles.liste")
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
