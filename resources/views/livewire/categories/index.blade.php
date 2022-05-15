<div>
    @if($pageCategorie == CATEGORIELISTE)
       @include("livewire.categories.liste")
    @endif
    @if($pageCategorie == CATEGORIECREATE)
        @include("livewire.categories.create")
    @endif

</div>