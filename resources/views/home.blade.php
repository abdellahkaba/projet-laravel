@extends('layouts.master')

@section('content')
    <div class="container m-t-5">
        <div class="row">
            <div class="col-6 p-4">
                <div class="jumbotron">
                    @if(auth()->user()->sexe == "F")
                    <img src="{{ asset('images/manager.png') }}" width="150" />
                    @else
                    <img src="{{ asset('images/bussiness-man.png') }}" width="150" />
                    @endif

                    <span class=""> <i> Bienvenu {{ auth()->user()->prenom }} {{ auth()->user()->nom }} </i> </span> <br>
                    en tant que {{ getRoleName() }}
                    {{-- <strong class="m-t-5">
                        <br>
                        Voici les qui vous sont attribués<
                        {{ getRoleName() }}
                    </strong> --}}
                    {{-- <p class="lead">
                        <a href="" class="btn btn-primary btn-lg" role="button">
                            Lire plus
                        </a>
                    </p> --}}

                </div>
            </div>
        </div>
    </div>



@endsection


