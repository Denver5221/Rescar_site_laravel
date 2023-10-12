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
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />

    </x-slot>




    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{getRouterValue();}}/forum">Forum</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{getRouterValue();}}/actualites/spams">Spams</a></li>
            </ol>
        </nav>
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
    </div>

    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class=" widget-content seperator-header text-center">
            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#inputFormModal" >Ajouter un spams</button>
        </div>

    </div>



    <div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Ajouter un <b>spams</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">

                <form id="form" class="mt-0" method="POST" action="{{ route('spams.store') }}" enctype="multipart/form-data">

                    @csrf


                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                            </span>
                            <input type="text" name="nom" required class="form-control" placeholder="Nom du spams" aria-label="text">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                    </div>

                </form>

            </div>


                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
                <script>
                    document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Spams ajouté avec succès',
                        });
                    });
                </script>
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
                                <h4>Liste des spams</h4>
                            </div>
                        </div>
                    </center>
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column text-center">N°</th>
                                <th >Nom du spams (Francais)</th>
                                <th >Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if($spams->isNotEmpty())
                            @php
                                $num = 1
                            @endphp
                            @foreach($spams as $spam)


                            <tr>
                                <td class="checkbox-column text-center"> {{ $num++ }} </td>
                                <td>{{ $spam->nom }}</td>
                                     <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">

                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#inputFormModal{{ $spam->id }}" href="javascript:void(0);">Modifier</a>
                                            <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('spams.delete', $spam->id) }}">Supprimer</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>




                            <div class="modal fade" id="inputFormModal{{ $spam->id }}" tabindex="-1" role="dialog" aria-labelledby="inputFormModal{{ $spam->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">

                                    <div class="modal-header" id="inputFormModal{{ $spam->id }}Label">
                                        <h5 class="modal-title">Modifier une <b>categorie</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="mt-0" action="{{ route('spams.update', $spam->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')


                                            <div class="form-group">
                                                <label for="product-images"> Francais </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                                                    </span>
                                                    <input type="text" name="nom" required value="{{ $spam->nom }}" re\ class="form-control" placeholder="Nom de la categorie" aria-label="text">
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary mt-2 mb-2 widget-content icon-success1" data-bs-dismiss="modal">Modifier</button>
                                            </div>

                                        </form>

                                    </div>


                                            <script>
                                            const modifyButtons = document.querySelectorAll('.widget-content.icon-success1');
                                                    modifyButtons.forEach((button) => {
                                                        button.addEventListener('click', function() {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Spams modifié avec succès',
                                                            });
                                                        });
                                                    });
                                            </script>
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
                                <h4>Liste des posts spammés du forum</h4>
                            </div>
                        </div>
                    </center>
                    <table id="style-4" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom & Prénom</th>
                                <th>Posts</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($thematiquesWithSpam->isNotEmpty())

                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($thematiquesWithSpam  as $thematique)


                            <tr>
                                <td class="checkbox-column text-center"> {{ $num++ }} </td>
                                <td>{{ $thematique->forums()->first()->user->information->nom }} {{ $thematique->forums()->first()->user->information->prenom }}</td>
                                <td>{{ substr( $thematique->thematique, 0,25) }} </td>
                                <td class="text-center">{{ $thematique->created_at->format('d/m/Y') }}</td>

 @php
                                $status =$thematique->status;

                                $statusText = $status ? "Actif" : "Inactif";
                                $statusClass = $status ? "shadow-none badge badge-success" : "shadow-none badge badge-warning";
                                @endphp

                                <td class="text-center">
                                    <button class="{{ $statusClass }} status-button" data-status-url="{{ route('forum.status', $thematique->id)  }}" data-current-status="{{ $thematique->status ? 'active' : 'inactive' }}">{{ $statusText }}</button>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <a href=""><button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light">Voir</button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>




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
                                        'Poste supprimé avec succès.',
                                        'success'
                                    ).then(() => {
                                        // Recharger la page après la suppression
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Erreur',
                                        'Une erreur s\'est produite lors de la suppression du poste.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.log(error);
                                Swal.fire(
                                    'Erreur',
                                    'Une erreur s\'est produite lors de la suppression du poste.',
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

            multiCheck(c4);

        </script>



    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
