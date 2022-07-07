<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- <a href="index3.html" class="brand-link">
        <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"       data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-link">
                    <a href="{{ route('home') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Acceuil</p>
                    </a>
                </li>
                @can('superadmin')
                    <li class="nav-item {{ setMenuOpenClass('superadmin.habilitations.' , 'menu-open') }}">
                        <a href="#" class="nav-link {{ setMenuOpenClass('superadmin.habilitations.' , 'active') }}">
                            <i class="fas fa-user-shield"></i>
                            <p>
                                Gestion des Employés
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                         <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('superadmin.habilitations.users.index') }}" class="nav-link {{ setMenuActive('superadmin.habilitation.users.index') }} ">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Utilisateur</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('admin')
                    <li class="nav-item {{ setMenuOpenClass('admin.gestarticles.' , 'menu-open') }}" >
                        <a href="#" class="nav-link {{ setMenuOpenClass('admin.gestarticles.' , 'active') }}">
                            <i class="nav-icon far fa-circle "></i>
                            <p>
                                Gestion des articles
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.gestarticles.types') }}" class="nav-link {{ setMenuActive('admin.habilitation.types') }}">
                                    <i class="nav-icon fas fa-list-ul"></i>
                                    <p>Type d'articles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.gestarticles.articles') }}" class="nav-link {{ setMenuActive('admin.habilitation.articles') }} ">
                                    <i class="nav-icon fas fa-list-ul"></i>
                                    <p>Articles</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{  }}" class="nav-link {{ setMenuActive('admin.habilitation.articles') }} ">
                                    <i class="nav-icon fas fa-list-ul"></i>
                                    <p>Email</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                @endcan
                @can('employe')
                    <li class="nav-item {{ setMenuOpenClass('employe.locations.' , 'menu-open') }}">
                        <a href="#" class="nav-link {{ setMenuOpenClass('employe.locations.' , 'active') }}">
                            <i class="nav-icon far fa-circle "></i>
                        <p>
                            Gestion des locations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" class="nav-link {{ setMenuActive('employe.location.locations.create') }}">
                                <a href="{{ route('employe.locations.locations.create') }}" class="nav-link">
                                    <i class="nav-icon fas fa-exchange-alt"></i>
                                    <p>Faire une Location</p>
                                </a>
                            </li>
                            <li class="nav-item" class="nav-link {{ setMenuActive('employe.location.locations.kaba') }}">
                                <a href="{{ route('employe.locations.locations.kaba') }}" class="nav-link">
                                    <i class="nav-icon fas fa-sliders-h"></i>
                                    <p>Liste des Locations</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('employe.locations.articles.tarification') }}" class="nav-link">
                                    <i class="nav-icon fas fa-sliders-h"></i>
                                    <p>Tarification</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employe.clients.clients.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestion Client</p>
                        </a>
                    </li>
                @endcan
                @can('employe')
                    <li class="nav-header">Caisse</li>
                    {{-- <li class="nav-item">
                    <a href="{{ route('employe.locations.paiement.liste') }}"class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Les Paiements</p>
                    </li> --}}
                    {{-- <li class="nav-item">
                    <a href="{{ route('admin.gestarticles.mails.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Recouvrement mail</p>
                    </li> --}}
                @endcan
            </ul>
        </nav>
    </div>

</aside>
