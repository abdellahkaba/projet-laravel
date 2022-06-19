<aside class="control-sidebar control-sidebar-dark">
    <div class="bg-dark">
        <div class="card-body box-profile">
            <div class="text-center">

                @if(auth()->user()->sexe == "F")
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/manager.png') }}" alt="User profile picture" width="150" />
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/bussiness-man.png') }}" alt="User profile picture" width="150" />
                @endif
                {{-- <img class="profile-user-img img-fluid img-circle" src="{{ asset(auth()->user()->photo) }}" alt="User profile picture srcset=" > --}}


            {{-- <img class="profile-user-img img-fluid img-circle" src="{{ asset(auth()->user()->photo) }}" alt="User profile picture"> --}}
            </div>
            <h3 class="profile-username text-center ellipsis">{{ auth()->user()->nom }}</h3>
            <p class="text-muted text-center">Software Engineer</p>
            <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item img-bordered-sm bg-cyan">
                <a href="{{ route('home') }}" class="d-flex align-items-center">
                    <i class="fa fa-user pr-4"></i>
                    <i>Profil d'Utilisateur connecté</i>
                </a>
            </li>

            </ul>
            <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             <b>Deconnexion</b>
             </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
        </div>
    </div>
</aside>
