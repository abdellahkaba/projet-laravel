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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-link">
                    <a href="{{ route('home') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Acceuil</p>
                    </a>

                </li>
                @can('manager')
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tableau de bord
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vue global</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>locations</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('admin')
                <li class="nav-item {{ setMenuOpenClass('admin.habilitations.' , 'menu-open') }}">
                    <a href="#" class="nav-link {{ setMenuOpenClass('admin.habilitations.' , 'active') }}">
                        <i class="fas fa-user-shield"></i>
                        <p>
                            Habilitations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.habilitations.users.index') }}" class="nav-link {{ setMenuActive('admin.habilitation.users.index') }} ">
                                <i class="fas fa-users-cog"></i>
                                <p>Utilisateur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role et permission</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Tarification</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ setMenuOpenClass('admin.gestmateriels.' , 'menu-open') }}" >
                    <a href="#" class="nav-link {{ setMenuOpenClass('admin.gestmateriels.' , 'active') }}">
                        <i class="nav-icon far fa-circle "></i>
                        <p>
                            Matériels Agricoles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.gestmateriels.categories') }}" class="nav-link {{ setMenuActive('admin.habilitation.categories') }}">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Les catégories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.gestmateriels.materiels') }}" class="nav-link {{ setMenuActive('admin.habilitation.materiels') }} ">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Matériels</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Vente</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('employe')
                    <li class="nav-header">Locations</li>
                    <li class="nav-item">
                        <a href="{{ route('employe.locations.locations.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>Gestion Location</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employe.clients.clients.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestion Client</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-header">Caisse</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Gestion Paiement</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
