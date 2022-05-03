@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 p-4">
            <div class="jumbotron">
                <h3 class="display-3"> Bienvenu</h3>
                <strong>
                    {{ getRoleName() }}
                </strong>
                <p class="lead">
                    <a href="" class="btn btn-primary btn-lg" role="button">
                        Lire plus
                    </a>
                </p>

            </div>
        </div>
    </div>



@endsection


