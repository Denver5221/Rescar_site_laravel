<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/assets/apps/mailbox.scss'])
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])

        @vite(['resources/scss/dark/assets/components/modal.scss'])
        @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/dark/assets/apps/mailbox.scss'])
        @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
        <!--  END CUSTOM STYLE FILE  -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />




    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="row">

                <div class="col-xl-12  col-md-12">

                    <div class="mail-box-container">

                        <div class="mail-overlay"></div>

                        <div class="tab-title">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                    <a id="btn-compose-mail" class="btn btn-block" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 mail-categories-container">

                                    <div class="mail-sidebar-scroll">

                                        <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                            {{-- <li class="nav-item">
                                                <a class="nav-link list-actions active" id="mailInbox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span class="nav-names">Réçu</span> <span class="mail-badge badge"></span></a>
                                            </li> --}}


                                            {{-- <li class="nav-item">
                                                <a class="nav-link list-actions" id="sentmail"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg> <span class="nav-names"> Envoyé</span></a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="trashed"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="nav-names">Supprimé</span></a>
                                            </li> --}}
                                        </ul>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="mailbox-inbox" class="accordion mailbox-inbox">

                            <div class="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                <input type="text" class="form-control input-search" placeholder="Search Here...">
                            </div>

                            {{-- <div class="action-center">
                                <div class="">
                                    <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                        <input class="form-check-input inbox-chkbox" type="checkbox" id="inboxAll">
                                    </div>
                                </div>

                                <div class="">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="tooltip" data-placement="top" data-original-title="Important" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star action-important"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" data-toggle="tooltip" data-placement="top" data-original-title="Revive Mail" stroke-linejoin="round" class="feather feather-activity revive-mail"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete Permanently" class="feather feather-trash permanent-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <div class="dropdown d-inline-block more-actions">
                                        <a class="nav-link dropdown-toggle" id="more-actions-btns-dropdown" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="more-actions-btns-dropdown">
                                            <a class="dropdown-item action-mark_as_read" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg> Marqué comme lu
                                            </a>
                                            <a class="dropdown-item action-mark_as_unRead" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> Marqué comme non lu
                                            </a>
                                            <a class="dropdown-item action-delete" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Supprimé
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}

                            <div class="message-box">

                                <div class="message-box-scroll" id="ct">


                                        @foreach ($subscriptions as $subscription)


                                    <div id="unread-promotion-page" class="mail-item mailInbox">
                                        <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingThree">
                                            <div class="mb-0">
                                                <div class="mail-item-heading social collapsed"  data-bs-toggle="collapse" role="navigation" data-bs-target="#mailCollapseThree" aria-expanded="false">
                                                    <div class="mail-item-inner">

                                                        <div class="d-flex">
                                                            <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                                                <input class="form-check-input inbox-chkbox" type="checkbox" id="form-check-default3">
                                                            </div>
                                                            <div class="f-head">
                                                                <i class="fas fa-envelope user-email-icon"
                                                                style=" font-size: 24px; /* Ajustez la taille de l'icône selon vos besoins */
                                                                color: #1b3edb; /* Couleur de l'icône */
                                                                margin-right: 10px; /* Marge à droite pour espacement */"
                                                                ></i>
                                                            </div>
                                                            <div class="f-body">
                                                                <div class="meta-mail-time">
                                                                    @if (!is_null($subscription['name']) && !is_null($subscription['lastname'] ))
                                                                    <p class="user-email" data-mailTo="{{ $subscription['email'] }}">{{ $subscription['name'] }} {{ $subscription['lastname'] }}</p>
                                                                    @else
                                                                    <p class="user-email" data-mailTo="{{ $subscription['email'] }}">{{ explode('@', $subscription['email'])[0] }}</p>
                                                                    @endif
                                                                </div>
                                                                <div class="meta-title-tag">
                                                                   <a href="mailto:{{ $subscription['email'] }}"> <p class="mail-content-excerpt" data-mailDescription=''><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attachment-indicator"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg><span class="mail-title" data-mailTitle="Promotion Page">Email- </span> {{ $subscription['email'] }}
                                                                    </p></a>
                                                                    @if ($subscription['created_at']->isToday())
                                                                    <span class="g-dot-success"></span>
                                                                    @endif
                                                                    @if ($subscription['created_at']->isToday())
                                                                    <p class="meta-time align-self-center"> Aujourd'hui {{ $subscription['created_at']->format('H:m') }}</p>
                                                                    @else
                                                                    <p class="meta-time align-self-center">{{ $subscription['created_at']->format('d M,Y H:m') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach




















                                </div>
                            </div>



                        </div>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="composeMailModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                                    <div class="compose-box">
                                        <div class="compose-content">
                                            <form id="form" class="mt-0" method="POST" action="{{ route('mail.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-4 mail-form">
                                                            <p>De:</p>
                                                            <select class="form-control" name="email_envoi" id="m-form">
                                                                <option value="infos@rescar.org">Info &lt;infos@rescar.orgcontact@rescar.org&gt;</option>
                                                                {{-- <option value="shaun@mail.com">Shaun Park &lt;shaun@mail.com&gt;</option> --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {{--
                                                    <div class="col-md-6">
                                                        <div class="mb-4 mail-to">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> À:</p>
                                                            <div class="">
                                                                <input type="email" id="m-to" class="form-control">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="col-md-12">
                                                        <div class="mb-4 mail-cc">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> CC:</p>
                                                            <div>
                                                                <input type="text" name="cc" id="m-cc" class="form-control">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4 mail-subject">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Sujet:</p>
                                                    <div class="w-100">
                                                        <input type="text" id="m-subject" name="sujet" required class="form-control">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Joindre des fichiers:</p>
                                                    <!-- <input type="file" class="form-control-file" id="mail_File_attachment" multiple="multiple"> -->
                                                    <input class="form-control file-upload-input" type="file" id="formFile" multiple="multiple" name="fichier">
                                                </div>
                                                <div>
                                                    {{-- <label>Message</label> --}}
                                                    <input type="text" hidden name="blog-description-2" value="">
                                                    <div id="blog-description-2"> </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button id="btn-save" class="btn float-left btn-success"> Sauvegarder</button>
                                                    <button id="btn-reply-save" class="btn float-left btn-success"> Sauvegarder reponse</button>
                                                    <button id="btn-fwd-save" class="btn float-left btn-success"> Sauvegarder Fwd</button> --}}

                                                    <button class="btn" type="button" data-bs-dismiss="modal"> <i class="flaticon-delete-1"></i> Annuler</button>
{{--
                                                    <button id="btn-reply" class="btn btn-primary"> Repondre</button>
                                                    <button id="btn-fwd" class="btn btn-primary"> Repondre</button> --}}
                                                    <button id="btn-send" type="submit" class="btn btn-primary"> Envoyé</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        @vite(['resources/assets/js/apps/mailbox.js'])
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
                     ['bold', 'italic', 'underline',],
                     [{ 'color': [] }, { 'background': [] }],
                     [{ 'align': [] }],
                     ['link', 'blockquote'],
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




          </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
