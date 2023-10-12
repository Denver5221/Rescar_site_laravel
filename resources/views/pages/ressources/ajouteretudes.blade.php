<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/tagify/tagify.css')}}">

        @vite(['resources/scss/light/assets/forms/switches.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
        @vite(['resources/scss/light/assets/apps/blog-create.scss'])


        <!--  END CUSTOM STYLE FILE  -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    </x-slot>


        <!-- BREADCRUMB -->
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">Ressources</li>
                    <li class="breadcrumb-item"><a href="{{getRouterValue();}}/ressources/etudes">Etudes et publications</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->
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
        <form id="form" class="mt-0" method="POST" action="{{ route('etudes.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="row mb-4 layout-spacing layout-top-spacing">

                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">


                    <div class="widget-content widget-content-area blog-create-section">

                        <br><h5 class="modal-title"><b>Français</b></h5><br>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <input type="text" name="titre" required class="form-control" id="Post-Title" placeholder="Titre">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                                <textarea name="description" required class="form-control" id="exampleFormControlTextarea1" placeholder="Description" rows="10"></textarea>

                            </div>
                        </div>

                    </div>


                    <div class="widget-content widget-content-area blog-create-section mt-4">

                        <h5 class="mb-4">Parametrage SEO</h5>

                        <div class="row mb-4">
                            <div class="col-xxl-12 mb-4">
                                <input type="text" name="meta_title" required class="form-control" id="post-meta-title" placeholder="Meta Title">
                            </div>
                            <div class="col-xxl-12">
                                <label for="post-meta-description">Meta Description</label>
                                <textarea name="meta_description" required class="form-control" id="post-meta-description" cols="10" rows="5"></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area blog-create-section">
                        <div class="row">
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" type="checkbox" role="switch" id="showPublicly" name="status" checked>
                                    <label class="switch-label" for="showPublicly">Publié</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" type="checkbox" role="switch" id="enableComment" name="active_commentaire" checked>
                                    <label class="switch-label" for="enableComment">Activer les comments</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="tags">Tags</label>
                                <input id="tags" name="tags[]" class="blog-tags" value="">
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="category">Categories</label>
                                <input id="category" name="category[]" required placeholder="Choisissez...">
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="product-images">Fichier Image</label>
                                <input type="file" name="image" accept="image/png, image/jpeg, image/gif">
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="product-images">Doccument Francais (Facultatif) </label>
                                <input type="file" name="file_fr" >
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="product-images">Doccument Anglais  (Facultatif)</label>
                                <input type="file" name="file_an" >
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="product-images">>Doccument Portuguais  (Facultatif)</label>
                                <input type="file" name="file_pr" >
                            </div>



                            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                <button class="btn btn-success w-100">Ajouter une etude</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>






    <x-slot:footerFiles>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/tagify/tagify.min.js')}}"></script>


        <script>




            /**
             * =====================
             *      Blog Tags
             * =====================
            */
            // The DOM element you wish to replace with Tagify
            var input = document.querySelector('.blog-tags');

            // initialize Tagify on the above input node reference
            new Tagify(input)


            FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            // FilePondPluginImageEdit
            );

            // Select the file input and use
            // create() to turn it into a pond
            window.ecommerce = FilePond.create(document.querySelector('.file-upload-multiple'));


            /**
             * =======================
             *      Blog Category
             * =======================
            */
            var input = document.querySelector('input[name="category[]"]');


            new Tagify(input, {
                whitelist: {!! json_encode($categories) !!},
                userInput: false
            });


          </script>


    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
