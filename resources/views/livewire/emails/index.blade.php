<div>
    @if($currentPage == PAGECREATEFORM)
       @include("livewire.mails.create")
    @endif
    @if($currentPage == PAGEEDITFORM)
        @include("livewire.mails.store")
    @endif
</div>
