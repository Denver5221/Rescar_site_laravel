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
                    <li class="breadcrumb-item"><a href="{{getRouterValue();}}/actualites">Actualités</a></li>
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
        <form id="form" class="mt-0" method="POST" action="{{ route('actualites.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="row mb-4 layout-spacing layout-top-spacing">

                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">


                    <div class="widget-content widget-content-area blog-create-section">

                        {{--  <h5 class="modal-title"><b> Français</b></h5><br>  --}}


                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <input type="text" name="titre" required class="form-control" id="Post-Title" placeholder="Titre du posts">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label>Contenu</label>
                                <input type="text" hidden name="blog-description-2" value="" >
                                <div id="blog-description-2"></div>
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
                                <textarea name="meta_description" required  class="form-control" id="post-meta-description" cols="10" rows="5"></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area blog-create-section">
                        <div class="row">
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" name="status" type="checkbox" role="switch" id="showPublicly" checked>
                                    <label class="switch-label" for="showPublicly">Publié</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" name="active_commentaire" type="checkbox" role="switch" id="enableComment" checked>
                                    <label class="switch-label" for="enableComment">Activer les comments</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="tags">Tags</label>
                                <input id="tags" name="tags[]" class="blog-tags" value="" required>
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="category">Categories</label>
                                <input id="category" name="category[]" placeholder="Choisissez..." required>
                            </div>

                            <div class="col-xxl-12 col-md-12 mb-4">

                                <label for="product-images">Image de couverture</label>

                                    <input type="file" name="image" accept="image/png, image/jpeg, image/gif">


                            </div>

                            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                <button type="submit" class="btn btn-success w-100">Ajouter une actualité</button>
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
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>



        <script src="https://unpkg.com/quill-image-resize@3.0.9/image-resize.min.js"></script>
        <script src="https://unpkg.com/quill-image-drop-module@1.0.3/index.js"></script>
        <script src="https://unpkg.com/quill-image-drop-module@1.0.3/index.js"></script>











        <script>
            var quill1 = new Quill('#blog-description-2',  {
                theme: 'snow',
                 modules: {
                    imageResize: {
                      displaySize: true
                    },
                   toolbar: [
                     [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                     ['bold', 'italic', 'underline', 'strike'],
                     [{ 'color': [] }, { 'background': [] }],
                     [{ 'align': [] }],
                     ['link', 'image' , 'video', 'blockquote'],
                     [{'list':'ordered'}, {'list':'bullet'}],

                     ['clean']
                   ],
                   syntax: true,
                }
            });
           /* var quill1 = new Quill('#blog-description-2', {
              modules: {
                toolbar: [
                  [{ header: [1, 2, false] }],
                  ['bold', 'italic', 'underline', 'strike'],
                  ['image', 'code-block', 'video', 'blockquote', 'code', 'align',{align:'center'}, 'link'],
                  [{'list':'ordered'}, {'list':'bullet'}],
                ],
                imageResize: {
                    displayStyles: {
                      backgroundColor: 'black',
                      border: 'none',
                      color: 'white'
                    },
                    modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                  }
                  clipboard: {
                    matchVisual: false
                  },
                  formats: {
                    // ...
                    image: true, // Prend en charge les images
                  },
                  syntax: true, // Prend en charge les syntaxes
              },
              placeholder: 'Ecrivez la description...',
              theme: 'snow'  // or 'bubble'
            });*/


             // Récupérer la valeur du contenu de Quill lors de la soumission du formulaire

            var form = document.getElementById('form');
            form.onsubmit = function() {
                var text = document.querySelector('input[name=blog-description-2]');
                //var fileInput = document.querySelector('input[name=image]');

                text.value = quill1.root.innerHTML;
               // fileInput.value = fileInput.files[0] ? fileInput.files[0].name : '';
                return true;
            };
            /*form.addEventListener('submit', function(event) {
                var contenu = quill.root.innerHTML;
                document.querySelector('#contenu').value = contenu;
            });*/


            /*FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            // FilePondPluginImageEdit
            );*/

            // Select the file input and use
            // create() to turn it into a pond
           // window.ecommerce = FilePond.create(document.querySelector('.file-upload-multiple'));
            // ecommerce.addFiles('../src/assets/img/product-1.jpg');

            /**
             * =====================
             *      Blog Tags
             * =====================
            */
            // The DOM element you wish to replace with Tagify
            var input = document.querySelector('.blog-tags');

            // initialize Tagify on the above input node reference
            new Tagify(input)


            /**
             * =======================
             *      Blog Category
             * =======================
            */
            //var input = document.querySelector('input[name=category]');
            var input = document.querySelector('input[name="category[]"]');


            new Tagify(input, {
                whitelist: {!! json_encode($categories) !!},
                userInput: false
            })




          </script>


    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
