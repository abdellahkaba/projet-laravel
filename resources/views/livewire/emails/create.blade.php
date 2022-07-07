{{-- <form role="form" action="{{ route('admin.gestarticles.emails.store') }}" method="POST"  enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for=""><span class="text-indigo">Nom</span></label>
                    <input type="name"  class="form-control text-bold text-blue @error('')
                       is-invalid
                    @enderror">
                    @error('')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for=""><span class="text-indigo">Email</span></label>
                    <input type="email" class="form-control text-bold text-blue @error('')
                        is-invalid
                    @enderror" placeholder="exemple@gmail.com">
                    @error('')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>




    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">envoyé</button>
        {{-- <button type="submit" wire:click.prevent="gotoListUser()" class="btn btn-danger">Retour à la Liste</button> --}}
    </div>
{{-- </form> --}}

{{-- <div class="row">
    <div class="col-6">
        <form action="" method="post">
            <label for="">Nom</label>
            <input type="text" name="nom" class="form-control-sm">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control-sm">
            <label for="">Message</label>
            <input type="text" name="message">
        </form>
    </div>
</div> --}}
<x-header componentName = "Create"/>
<h2>Bonjour Tout le monde !</h2>
