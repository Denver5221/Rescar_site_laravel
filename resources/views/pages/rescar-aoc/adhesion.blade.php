<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/assets/apps/notes.scss'])
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

        <!--  END CUSTOM STYLE FILE  -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </x-slot>


    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Repertoires</a></li>
                <li class="breadcrumb-item active" aria-current="page">Experts</li>
            </ol>
        </nav>
    </div>


    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class=" widget-content seperator-header text-center">
            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#inputFormModal" >Ajouter un experts</button>
        </div>

    </div>


    {{-- <!-- Modal -->
    <div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Ajouter un <b>expert</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form class="mt-0">

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="col-md-6 mx-auto">

                                <div class="profile-image">

                                    <!-- // The classic file input element we'll enhance
                                    // to a file pond, we moved the configuration
                                    // properties to JavaScript -->

                                    <div class="img-uploader-content">
                                        <input type="file" class="filepond"
                                            name="filepond" accept="image/png, image/jpeg, image/gif"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                            </span>
                            <input type="text" class="form-control" placeholder="Nom de l'expert" aria-label="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                            </span>
                            <input type="text" class="form-control" placeholder="Prenom de l'expert" aria-label="text">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link-2"><path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"></path><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </span>
                            <input type="mail" class="form-control" placeholder="Email" aria-label="text">

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Numero" aria-label="text">

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Lien Facebook (facultatif)" aria-label="text">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Lien LinkedIn (facultatif)" aria-label="text">

                        </div>
                    </div>






                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
            </div>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
                <script>
                    document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Expert ajouter avec succès',
                        });
                    });
                </script>
          </div>
        </div>
    </div> --}}


    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des ahdesions personne morale </h4>
                            </div>
                        </div>
                    </center>
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column text-center">N°</th>
                                <th >Nom de la structure</th>
                                <th class="checkbox-column text-center" >Photo</th>
                                {{-- <th>Pays siège</th> --}}
                                <th>Domaines de spécialisation</th>
                                <th >Contact </th>
                                <th >Statut </th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($morale->isNotEmpty())
                                @php
                                    $num = 1;
                                @endphp
                               @foreach ($morale as  $data)


                            <tr>
                                <td class="checkbox-column text-center"> {{ $num++ }} </td>
                                @php
                                    $firstWord = explode(' ', $data->nom)[0];
                                @endphp

                                <td>{{ $firstWord }}</td>
                                <td class="text-center">
                                    <span><img width="50" src="{{ asset('storage/' . $data->logo) }}" class="profile-img" alt="avatar"></span>
                                </td>
                                {{-- <td>{{ $data->pays }}</td> --}}
                                <td>
                                    {{ substr($data->domaine, 0, 20) }}....
                                </td>
                                <td>{{ $data->phone_contact }}</td>
                                @php
                                        $status = $data->status;

                                        $statusText = $status ? "Actif" : "Inactif";
                                        $statusClass = $status ? "shadow-none badge badge-success" : "shadow-none badge badge-warning";
                                        @endphp

                                <td class="text-center">
                                    <button class="{{ $statusClass }} status-button" data-status-url="{{ route('adhésion.status2', $data->id) }}" data-current-status="{{ $data->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle"  role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            {{-- <a class="dropdown-item" href="javascript:void(0);">Voir</a> --}}
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"  data-bs-target="#inputFormModal1{{ $data->id }}" >Voire</a>
                                            <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('adhésion.delete2', $data->id) }}">Supprimer</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade inputForm-modal" id="inputFormModal1{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal1{{ $data->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header" id="inputFormModal1{{ $data->id }}Label">
                                            <h5 class="modal-title">Personne morale <b>détails d’inscription</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <center>
                                                <div class="col-md-10">
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Nom de la structure:</strong> {{ $data->nom }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Domaines de spécialisation:</strong> {{ $data->domaine }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">légalisée:</strong> {{ $data->légalisée }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Mail:</strong> {{ $data->email }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Taille du personnel:</strong> {{ $data->nombre_personnel }}</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Pays siège:</strong> {{ $data->pays }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Taille du personnel:</strong> {{ $data->profil_academique }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Nom de la personne de contact:</strong> {{ $data->nom_contact }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Prénom de la personne de contact:</strong> {{ $data->prenom_contact }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Fonctions des personnes de contact:</strong> {{ $data->fonction_contact }}</p>
                                                    <p style="font-weight: bold;"><strong style="font-weight: bold; margin-bottom: 10px; color:black;">Numéro téléphone des personnes de contact:</strong> {{ $data->phone_contact }}</p>
                                                </div>
                                            </center>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            @php
                                            $etata = $data->status;

                                            $statusText = $etata ? "Refouler" : "Accepter";
                                            @endphp
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button class="btn btn-success status-button" data-status-url="{{ route('adhésion.status2', $data->id) }}" data-current-status="{{ $data->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>                                        </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            @endforeach
                            @endif


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des ahdésions personne physique  </h4>
                            </div>
                        </div>
                    </center>
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column text-center">N°</th>
                                <th >Nom & Prenoms</th>
                                <th >Domaine de spécialisation</th>
                                <th> Fonction actuelle  </th>
                                <th >Contact </th>
                                <th >Statut </th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($physique->isNotEmpty())
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ( $physique as $data)

                            <tr>
                                <td class="checkbox-column text-center"> {{ $num++ }} </td>

                                @php
                                    $firstNom = explode(' ', $data->nom)[0];
                                    $firstPrenom = explode(' ', $data->prenom)[0];
                                @endphp
                                <td>{{ $firstNom }} {{ $firstPrenom }}</td>
                                <td >{{ substr($data->domaine_specialisation, 0 , 20)	}}.. </td>
                                <td >{{ substr($data->fonction_actuelle, 0,20) }} </td>
                                <td>{{ $data->phone }}</td>
                                @php
                                        $status = $data->status;

                                        $statusText = $status ? "Actif" : "Inactif";
                                        $statusClass = $status ? "shadow-none badge badge-success" : "shadow-none badge badge-warning";
                                        @endphp

                                <td class="text-center">
                                    <button class="{{ $statusClass }} status-button" data-status-url="{{ route('adhésion.status', $data->id) }}" data-current-status="{{ $data->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle"  role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            {{-- <a class="dropdown-item" href="javascript:void(0);">Voir</a> --}}
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"  data-bs-target="#inputFormModal1{{ $data->id }}" >Voire</a>
                                            <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('adhésion.delete', $data->id) }}">Supprimer</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade inputForm-modal" id="inputFormModal1{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal1{{ $data->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header" id="inputFormModal1{{ $data->id }}Label">
                                            <h5 class="modal-title">Personne physique <b>détails d’inscription</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <center>
                                                <div class="col-md-10">
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Nom:</strong> {{ $data->nom }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Prénom:</strong> {{ $data->prenom }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Date d'anniversaire:</strong> {{ $data->data_naissance }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Mail:</strong> {{ $data->email }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Numéro:</strong> {{ $data->phone }}</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Pays:</strong> {{ $data->pays }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Profil Académique:</strong> {{ $data->profil_academique }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Domaine Spécialisation:</strong> {{ $data->domaine_specialisation }}</p>
                                                    <p style="font-weight: bold;"><strong style="margin-bottom: 10px; color:black;">Fonction Actuelle:</strong> {{ $data->fonction_actuelle }}</p>
                                                </div>
                                            </center>
                                                <div class="col-md-12">
                                                   <h3><center><strong>Biographie:</strong> </center></h3>
                                                    <p> {{ $data->Biographie }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            @php
                                            $etata = $data->status;

                                            $statusText = $etata ? "Refouler" : "Accepter";
                                            @endphp
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button class="btn btn-success status-button" data-status-url="{{ route('adhésion.status', $data->id) }}" data-current-status="{{ $data->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- Structure du popup avec Bootstrap Modal -->
                            {{-- <div class="modal fade inputForm-modal" id="inputFormModal1{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal1{{ $data->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                    <div class="modal-header" id="inputFormModal1{{ $data->id }}Label">
                                        <h5 class="modal-title">Personne physique <b>détails d’inscription</b> {{ $data->nom }} {{ $data->prenom }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <ul>
                                                <li><strong>NOM:</strong> {{ $data->nom }}</li>
                                                <li><strong>Prénom:</strong> {{ $data->prenom }}</li>
                                                <li><strong>Date d'anniversaire:</strong> {{ $data->data_naissance }}</li>
                                                <!-- Ajoutez d'autres éléments de liste pour les autres données -->
                                            </ul>
                                        </div>
                                       {{-- <table class="table table-bordered mt-0">
                                        <thead>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>NOM</td>

                                                <td class="text-center">
                                                   {{ $data->nom }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prénom</td>
                                                <td class="text-center"> {{ $data->prenom }}</td>
                                            </tr>

                                            <tr>
                                                <td>Date d'anniversaire</td>

                                                <td class="text-center">{{ $data->data_naissance }}</td>

                                            </tr>


                                            <tr>
                                                <td>Mail</td>

                                                <td class="text-center">{{ $data->email }}</td>

                                            </tr>

                                            <tr>
                                                <td>Numero</td>

                                                <td class="text-center"> {{ $data->phone }}</td>

                                            </tr>

                                            <tr>
                                                <td>Pays</td>

                                                <td class="text-center">{{ $data->pays}}</td>

                                            </tr>

                                            <tr>
                                                <td>Profil Academique</td>

                                                <td class="text-center">{{ $data->profil_academique }}</td>

                                            </tr>
                                            <tr>
                                                <td>Domaine Specialisation</td>

                                                <td class="text-center">{{ $data->domaine_specialisation }}</td>

                                            </tr>
                                            <tr>
                                                <td>Fonction Actuelle</td>

                                                <td class="text-center">{{ $data->fonction_actuelle }}</td>

                                            </tr>
                                            <tr>
                                                <td>Biographie</td>

                                                <td class="text-center">{{ $data->Biographie }}</td>

                                            </tr>
                                        </tbody>
                                      </table> --}}

                                    {{-- </div>



                                    </div>
                                </div>
                            </div> --}}


                            @endforeach
                            @endif


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>

    <!-- Script pour la suppression du partenaire -->
    <script>
        // Sélectionner tous les boutons de suppression
        const deleteButtons = document.querySelectorAll('.delete-button');

        // Ajouter un gestionnaire d'événement à chaque bouton de suppression
        deleteButtons.forEach((button) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Récupérer l'URL de suppression à partir de l'attribut data
                const deleteUrl = button.dataset.deleteUrl;

                // Afficher la boîte de dialogue de confirmation
                Swal.fire({
                    title: 'Êtes-vous sûr(e) ?',
                    text: 'Cette suppression est irréversible !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Supprimer !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envoyer une requête AJAX pour supprimer le partenaire
                        axios.delete(deleteUrl)
                            .then(response => {
                                if (response.data.success) {
                                    Swal.fire(
                                        'Supprimé !',
                                        'membre supprimé avec succès.',
                                        'success'
                                    ).then(() => {
                                        // Recharger la page après la suppression
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Erreur',
                                        'Une erreur s\'est produite lors de la suppression du membre.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.log(error);
                                Swal.fire(
                                    'Erreur',
                                    'Une erreur s\'est produite lors de la suppression du membre.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    </script>

    <!-- Inclure SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>

    <!-- Script pour le changement de statut -->
    <script>
        // Sélectionner tous les boutons de changement de statut
        const statusButtons = document.querySelectorAll('.status-button');

        // Ajouter un gestionnaire d'événement à chaque bouton de changement de statut
        statusButtons.forEach((button) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Récupérer l'URL de modification de statut à partir de l'attribut data
                const statusUrl = button.dataset.statusUrl;

                // Récupérer le statut actuel à partir de l'attribut data
                const currentStatus = button.dataset.currentStatus;

                // Déterminer le nouveau statut en fonction du statut actuel
                const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

                // Afficher la boîte de dialogue de confirmation
                Swal.fire({
                    title: 'Êtes-vous sûr(e) ?',
                    text: `Voulez-vous vraiment changer le statut de "${currentStatus}" à "${newStatus}" ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Changer le statut !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envoyer une requête AJAX pour changer le statut
                        axios.post(statusUrl, { newStatus: newStatus })
                            .then(response => {
                                if (response.data.success) {
                                    Swal.fire(
                                        'Statut modifié !',
                                        `Le statut a été changé avec succès en "${newStatus}".`,
                                        'success'
                                    ).then(() => {
                                        // Recharger la page après le changement de statut
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Erreur',
                                        'Une erreur s\'est produite lors du changement de statut.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.log(error);
                                Swal.fire(
                                    'Erreur',
                                    'Une erreur s\'est produite lors du changement de statut.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    </script>








    <x-slot:footerFiles>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/custom-sweetalert.js')}}"></script>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])

        <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/custom_miscellaneous.js')}}"></script>

        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/custom-filepond.js')}}"></script>

        <script>
            // var e;


            c3 = $('#style-3').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Page N° _PAGE_ sur _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Rechercher...",
                   "sLengthMenu": "Trier par :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });

            multiCheck(c3);
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
