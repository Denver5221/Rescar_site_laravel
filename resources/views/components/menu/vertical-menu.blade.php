{{--

/**
*
* Created a new component <x-menu.vertical-menu/>.
*
*/

--}}


        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="{{getRouterValue();}}/dashboard/analytics">
                                <img src="{{Vite::asset('resources/images/logo2.svg')}}" class="navbar-logo logo-dark" alt="logo">
                                <img src="{{Vite::asset('resources/images/logo2.svg')}}" class="navbar-logo logo-light" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="{{getRouterValue();}}/dashboard/analytics" class="nav-link"> RESCAR-AOC </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                        </div>
                    </div>
                </div>
                @if (!Request::is('collapsible-menu/*'))
                    <div class="profile-info">
                        <div class="user-info">
                            <div class="profile-img">
                                <img src="{{Vite::asset('resources/images/profile-30.png')}}" alt="avatar">
                            </div>
                            <div class="profile-content">
                                <h6 class="">{{ auth()->user()->information->nom}} {{ auth()->user()->information->prenom}}</h6>
                                <p class="">{{ auth()->user()->roles()->first()->nom}}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ Request::routeIs('analytics') ? 'active' : '' }}">
                        <a href="{{getRouterValue();}}/dashboard/analytics" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>

                        </a>

                    </li>



                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>SITE WEB</span></div>
                    </li>


                    <li class="menu {{ Request::is('*/rescar-oac/*') ? "active" : "" }}">
                        <a href="#invoice" data-bs-toggle="collapse" aria-expanded="{{ Request::is('*/rescar-oac/*') ? "true" : "false" }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlnsblog="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>RESCAR-AOC</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/rescar-oac/*') ? "show" : "" }}" id="invoice" data-bs-parent="#accordionExample">
                            <li class="{{ Request::routeIs('partenaire') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/rescar-oac/partenaire"> Partenaires </a>
                            </li>
                            <li class="{{ Request::routeIs('membre') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/rescar-oac/membre"> Membres </a>
                            </li>
                            <li class="{{ Request::routeIs('recrutement') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/rescar-oac/recrutement"> Recrutements </a>
                            </li>
                            <li class="{{ Request::routeIs('adhésion') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/rescar-oac/adhésion"> Demande d'adhésion </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu {{ Request::routeIs('actualites') ? 'active' : '' }}">
                        <a href="{{getRouterValue();}}/actualites" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                <span>Actualités</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ Request::is('*/ressources/*') ? "active" : "" }}">
                        <a href="#blog" data-bs-toggle="collapse" aria-expanded="{{ Request::is('*/ressources/*') ? "true" : "false" }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                                <span>Réssources</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/ressources*') ? "show" : "" }}" id="blog" data-bs-parent="#accordionExample">
                            <li class="{{ Request::routeIs('etudes') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/etudes">Etude et publications</a>
                            </li>
                            <li class="{{ Request::routeIs('fiches') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/fiches">Fiches d'expérience</a>
                            </li>
                            <li class="{{ Request::routeIs('rapports') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/rapports">Rapport d'activité</a>
                            </li>
                            <li class="{{ Request::routeIs('supports') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/supports">Support de formation</a>
                            </li>
                            <li class="{{ Request::routeIs('articles') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/articles">Articles de memoire et recherche</a>
                            </li>
                            <li class="{{ Request::routeIs('articles') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/ressources/travail">Groupe de travail</a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu {{ Request::is('*/repertoires/*') ? "active" : "" }}">
                        <a href="#ecommerce" data-bs-toggle="collapse" aria-expanded="{{ Request::is('*/repertoires/*') ? "true" : "false" }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                                <span>Repertoires</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/repertoires/*') ? "show" : "" }}" id="ecommerce" data-bs-parent="#accordionExample">
                            <li class="{{ Request::routeIs('organismes') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/repertoires/organismes">Organisations spécialisées dans le développement</a>
                            </li>
                            <li class="{{ Request::routeIs('experts') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/repertoires/experts">Experts du développement</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ Request::routeIs('forum') ? 'active' : '' }}">
                        <a href="{{getRouterValue();}}/forum" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <span>Forum</span>
                            </div>
                        </a>
                    </li>






                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Messagerie</span></div>
                    </li>

                    <li class="menu {{ Request::is('*/messagerie/*') ? "active" : "" }}">
                        <a href="#components" data-bs-toggle="collapse" aria-expanded="{{ Request::is('*/messagerie/*') ? "true" : "false" }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <span>Messagerie</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/messagerie/*') ? "show" : "" }}" id="components" data-bs-parent="#accordionExample">
                            <li class="{{ Request::routeIs('mail') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/messagerie/mail">Newslatters</a>
                            </li>
                            {{-- <li class="{{ Request::routeIs('chat') ? 'active' : '' }}">
                                <a href="{{getRouterValue();}}/messagerie/chat">Chat</a>
                            </li> --}}
                        </ul>
                    </li>







                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Utilisateurs</span></div>
                    </li>

                    <li class="menu {{ Request::routeIs('utilisateurs') ? 'active' : '' }}">
                        <a href="{{getRouterValue();}}/utilisateurs" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Utilisateur</span>
                            </div>
                        </a>
                    </li>

                </ul>

            </nav>

        </div>
