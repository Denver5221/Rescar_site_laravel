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
                    <li class="breadcrumb-item"><a href="#">RESCAR-AOC</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recrutements</li>
                </ol>
            </nav>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


    <!-- /BREADCRUMB -->



        <div class="row layout-top-spacing" id="cancel-row">
            <br>
            <div class=" widget-content seperator-header text-center">
                <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#inputFormModal" >Ajouter un recrutements</button>
                <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#inputFormModal1" >Ajouter un recrutements partenaire</button>
            </div>

        </div>



                    <!-- Form Button trigger modal -->

                     <!-- Modal -->
            <div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Ajouter un <b>recrutement</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    @if(session()->has('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: '{{ session("success") }}'
                        });
                    </script>
                    @endif
                    @if(session()->has('error'))
                    <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: '{{ session("error") }}'
                            });
                        </script>
                    @endif
                    {{-- //////////////////////////////////////////////// ajout recrutement --}}
                    <form class="mt-0" method="POST" action="{{ route('recrutement.store') }}" enctype="multipart/form-data" >
                        @csrf


                        {{--  <label for="product-images"> Français </label>  --}}

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                                </span>
                                <input type="text" name="nom" required class="form-control" placeholder="Nom du recrutement" aria-label="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                                <textarea name="description" required class="form-control" id="exampleFormControlTextarea1" placeholder="Description du recrutement" rows="3"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product-images"> Document </label>
                            <div class="multiple-file-upload">
                                <input type="file"
                                name="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product-images"> Image </label>
                            <div class="multiple-file-upload">
                                <input type="file"
                                name="image">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success" >Ajouter</button>
                        </div>


                    </form>

                </div>
                </div>
            </div>
        </div>





        <div class="modal fade inputForm-modal" id="inputFormModal1" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">Ajouter un <b>recrutement partenaire</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    @if($partenaires->isNotEmpty())
                    {{--  //////////////////////////// ajout recrutement partenaires  --}}

                    <form class="mt-0" method="POST" action="{{ route('recrutement.partenaire.store') }}" enctype="multipart/form-data" >
                        @csrf


                        {{--  <label for="product-images"> Français </label>  --}}

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                                </span>
                                <input type="text" name="nom" required class="form-control" placeholder="Nom du recrutement" aria-label="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                                <textarea class="form-control" name="description" required id="exampleFormControlTextarea1" placeholder="Description du recrutement" rows="3"></textarea>

                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <div class="input-group mb-3 ">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                                    <select name="id_partenaire" required class="form-select form-select " >
                                        <option>Selectionner un Partenaire</option>
                                        @foreach($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link-2"><path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"></path><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </span>
                                <input type="text" name="lien" class="form-control" placeholder="Lien du recrutement" aria-label="text">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product-images"> Document (facultatif)</label>
                            <div class="multiple-file-upload">
                                <input type="file"
                                name="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product-images"> Image </label>
                            <div class="multiple-file-upload">
                                <input type="file"
                                name="image">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success" >Ajouter</button>
                        </div>
                    </form>

                    @else
                        <div class="modal-header" id="inputFormModalLabel">
                            <h5 class="modal-title">Ajouter un <b> partenaire </b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </div>
                    @endif

                </div>
                </div>
            </div>
        </div>




{{--  //////////////////////////////// Liste des recrutements  --}}



        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <center><br>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Liste des recrutements</h4>
                                </div>
                            </div>
                        </center>
                        <table id="style-3" class="table style-3 dt-table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column text-center">N°</th>
                                    <th >Nom (Francais)</th>
                                    {{--  <th> Name (Anglais)</th>  --}}
                                    <th >Documents </th>
                                    <th >Statuts </th>
                                    <th class="text-center dt-no-sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($recrutements->isNotEmpty())
                                        @php
                                            $num = 1;
                                        @endphp
                                    @foreach($recrutements as $recrutement)


                                <tr>
                                    <td class="checkbox-column text-center"> {{ $num++ }} </td>

                                    <td>{{ $recrutement->nom }}</td>

                                    <td class="text-center">
                                        <a class="dropdown-toggle" href="{{ asset('storage/' . $recrutement->file)}}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line>
                                                </svg>
                                        </a>
                                    </td>
                                        @php
                                        $status = $recrutement->status;

                                        $statusText = $status ? "Actif" : "Inactif";
                                        $statusClass = $status ? "shadow-none badge badge-success" : "shadow-none badge badge-warning";
                                        @endphp

                                        <td class="text-center">
                                            <button class="{{ $statusClass }} status-button" data-status-url="{{ route('recrutement.status', $recrutement->id) }}" data-current-status="{{ $recrutement->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>
                                        </td>
                                          {{--  <td class="text-center"><button data-partner-id="{{ $recrutement->id }}"  class="{{ $statusClass }}" data-status="{{ $recrutement->status ? 'active' : 'inactive' }}">{{ $statusText }}</button> </a><</td>  --}}
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <a class="dropdown-item" href="{{ url('/qui-somme-nous/recrutements/'.$recrutement->slug) }}">Voir</a>
                                                <a class="dropdown-item" data-bs-target="#inputFormModal1{{ $recrutement->id }}"  href="javascript:void(0);" data-bs-toggle="modal"  >Modifier</a>

                                                {{--  <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#inputFormModal12" >Modifier</a>  --}}
                                                <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('recrutement.delete', $recrutement->id) }}">Supprimer</button>

                                                {{--  <a class="dropdown-item widget-content warning confirm" data-delete-url="{{ route('recrutement.delete', $recrutement->id) }}">Supprimer</a>  --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                   {{--  ///////// modifier recrutement  --}}

                                <div class="modal fade inputForm-modal" id="inputFormModal1{{ $recrutement->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal1{{ $recrutement->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">

                                        <div class="modal-header" id="inputFormModal1{{ $recrutement->id }}Label">
                                            <h5 class="modal-title">Modifier un <b>recrutement</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="mt-0" action="{{ route('recrutement.update', $recrutement->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')


                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                                                        </span>
                                                        <input type="text" name="nom" value="{{ $recrutement->nom }}" class="form-control" placeholder="Nom du recrutement" required aria-label="text">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                        </span>
                                                        <textarea name="description" required class="form-control" id="exampleFormControlTextarea1" placeholder="Description du recrutement" rows="3">{{ $recrutement->description }}</textarea>

                                                    </div>
                                                </div>

                                                <br>

                                                <div class="form-group">
                                                    <label for="product-images"> Document</label>
                                                    <div class="multiple-file-upload">
                                                        <input type="file"
                                                        name="file">
                                                        <p>Fichier actuel : </p>
                                                        <a class="dropdown-toggle" href="{{ asset('storage/' . $recrutement->file)}}" target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line>
                                                                </svg>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="product-images"> Image</label>
                                                    <div class="multiple-file-upload">
                                                        <input type="file"
                                                        name="image">
                                                        <p>Fichier actuel : </p>
                                                        <a class="dropdown-toggle" href="{{ asset('storage/' . $recrutement->image)}}" target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line>
                                                                </svg>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Modifier</button>
                                                </div>

                                            </form>

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
                                    <h4>Liste des recrutements Partenaires</h4>
                                </div>
                            </div>
                        </center>
                        <table id="style-4" class="table style-3 dt-table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column text-center">N°</th>
                                    <th >Nom </th>
                                    <th> Partenaires</th>
                                    <th >Documents </th>
                                    <th >Statuts </th>
                                    <th class="text-center dt-no-sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($recrutement_partenaires->isNotEmpty())

                                    @foreach($recrutement_partenaires as $recrutement_partenaire)


                                <tr>
                                    <td class="checkbox-column text-center"> 1 </td>

                                    <td>Recrutement pour{{ $recrutement_partenaire->nom }}</td>
                                    <td>{{ $recrutement_partenaire->partenaire_nom }}</td>

                                    <td class="text-center">
                                        <a class="dropdown-toggle" href="{{ asset('storage/' . $recrutement_partenaire->file)}}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line>
                                                </svg>
                                        </a>
                                    </td>
                                        @php
                                        $status = $recrutement_partenaire->status;

                                        $statusText = $status ? "Actif" : "Inactif";
                                        $statusClass = $status ? "shadow-none badge badge-success" : "shadow-none badge badge-warning";
                                        @endphp

                                        <td class="text-center">
                                            <button class="{{ $statusClass }} status-button" data-status-url="{{ route('recrutement.partenaire.status', $recrutement->id) }}" data-current-status="{{ $recrutement->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>
                                        </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle"  role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <a class="dropdown-item" href="{{ url('/qui-somme-nous/recrutements/'.$recrutement->slug) }}">Voir</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"  data-bs-target="#inputFormModal2{{ $recrutement_partenaire->id }}" >Modifier</a>
                                                <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('recrutement.partenaire.delete', $recrutement_partenaire->id) }}">Supprimer</button>

                                                {{--  <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('recrutement.partenaire.delete', $recrutement_partenaire->id) }}">Supprimer</button>  --}}

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade inputForm-modal" id="inputFormModal2{{ $recrutement_partenaire->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal2{{ $recrutement_partenaire->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">

                                        <div class="modal-header" id="inputFormModal2Label{{ $recrutement_partenaire->id }}">
                                            <h5 class="modal-title">Modifier un <b>recrutement partenaire</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="mt-0" action="{{ route('recrutement.partenaire.update', $recrutement_partenaire->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')


                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                                                        </span>
                                                        <input type="text" required name="nom" value="{{ $recrutement_partenaire->nom }}" class="form-control" placeholder="Nom du recrutement" aria-label="text">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                        </span>
                                                        <textarea required class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Description du recrutement" rows="3">{{ $recrutement_partenaire->description }}</textarea>

                                                    </div>
                                                </div>




                                                <br>

                                                <div class="form-group">
                                                    <div class="input-group mb-3 ">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                        </span>
                                                            <select required name="id_partenaire" class="form-select form-select " >
                                                                @foreach($partenaires as $partenaire)
                                                                <option value="{{ $partenaire->id }}" {{ $partenaire->id == $recrutement_partenaire->id_partenaire ? 'selected' : '' }}>
                                                                    {{ $partenaire->nom }}
                                                                </option>
                                                            @endforeach
                                                            </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link-2"><path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"></path><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                        </span>
                                                        <input type="text" name="lien" value="{{ $recrutement_partenaire->lien }}" class="form-control" placeholder="Lien du recrutement" aria-label="text">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="product-images"> Document (facultatif)</label>
                                                    <div class="multiple-file-upload">
                                                        <input type="file"
                                                        name="file">
                                                        <p>Fichier actuel : </p>
                                                                    <a class="dropdown-toggle" href="{{ asset('storage/' . $recrutement_partenaire->file)}}" target="_blank">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line>
                                                                            </svg>
                                                                    </a>
                                                        {{--  @if($recrutement_partenaire)
                                                            <p> Fichier actuel: {{ $recrutement_partenaire->file }}</p>
                                                        @else
                                                             <p> Aucun fichier </p>
                                                        @endif  --}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product-images"> Document (facultatif)</label>
                                                    <div class="multiple-file-upload">
                                                        <input type="file"
                                                        name="image">
                                                        <p>Fichier actuel : </p>
                                                    <img width="50px" src="{{ asset('storage/' . $recrutement_partenaire->image)}}" alt="">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success1" data-bs-dismiss="modal">Modifier</button>
                                                </div>

                                            </form>

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










        {{--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.widget-content.warning.confirm');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'êtes vous sure?',
                        text: "Cette suppression est irréversible!!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Supprimer!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Supprimer!',
                                'recrutements supprimer avec success.',
                                'success'
                            )
                        }
                    })
                });
            });
        </script>  --}}
        <!-- Inclure SweetAlert2 -->
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

        <script>
            c4 = $('#style-4').DataTable({
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

        multiCheck(c4); </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
