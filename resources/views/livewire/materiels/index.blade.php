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