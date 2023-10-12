@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Support de formation</h2>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>


<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <div class="blog-post">
      <figure><img src="{{ asset('storage/'.$data->image) }}" alt="Image"></figure>
        <div class="post-content">
          <span class="post-date">De {{ $data->created_at->format('d M, Y') }}</span>
          @php
                $tags = $data->tags;
                $tagsArray = json_decode($tags, true);
          @endphp

          <p>Categories :
            @if ($data->categories->isNotEmpty())
                @foreach ($data->categories as $categorie)
                    <button class="btn btn-success  mb-2 me-4 btn-sm">{{ $categorie->nom }}</button>
                @endforeach
            @else
                <p>Aucune catégorie associée.</p>
            @endif


         </p>

          <p style="margin-top:-10px;">Mots clés :
            @if (is_array($tagsArray) && count($tagsArray) > 0)
                 @foreach ($tagsArray as $tag)
            <button class="btn btn-warning   mb-2 me-4 btn-sm" style="background:#ff9a40; color:white;">{{ $tag['value'] }}</button>
                 @endforeach
            @else
                 <p>Aucun tag trouvé.</p>
            @endif
         </p>

        <h3 class="post-title">{{ $data->titre }}</h3>
         {{-- <div class="author"> <img src="{{ asset('storage/'.$data->image) }}" alt="Image"> <span>par <strong>Rescar-aoc</strong></span> </div> --}}
            <!-- end author -->
            @php
            // Divisez la description en paragraphes
                $paragraphs = explode("\n", $data->description);
            @endphp
        <p>{{ $paragraphs[0] }}</p>


        <blockquote>{{ $data->titre }}        </blockquote>
        <p>{{ substr($data->description, strlen($paragraphs[0])) }}</p>
<br>
        <center>
            <h5>Fichiers</h5>

        </center>


        <ul class="list-group">
        @if ($data->file_fr)
        <li class="list-group-item d-flex justify-content-between align-items-center">
        Fichier (Francais)
        <span class="rounded-pill">
        <a href="{{ asset('storage/'.$data->file_fr) }}" target="_blank">
        <button class="btn btn-success  mb-2 me-4">
        <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" fill="white"></path> <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" fill="white"></path> </svg>
        <span class="btn-text-inner">Telecharger</span>
        </button></a>
        </span>
        </li>

        @endif
        @if ($data->file_an)

        <li class="list-group-item d-flex justify-content-between align-items-center">
        Fichier (Anglais)
        <span class="rounded-pill">
        <a href="{{ asset('storage/'.$data->file_an) }}" target="_blank">
        <button class="btn btn-success  mb-2 me-4">
        <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" fill="white"></path> <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" fill="white"></path> </svg>
        <span class="btn-text-inner">Telecharger</span>
        </button></a>
        </span>
        </li>

        @endif
        @if ($data->file_pr)

        <li class="list-group-item d-flex justify-content-between align-items-center">
        Fichier (Portugal)
        <span class="rounded-pill">
        <a href="{{ asset('storage/'.$data->file_pr) }}" target="_blank">
        <button class="btn btn-success  mb-2 me-4">
        <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" fill="white"></path> <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" fill="white"></path> </svg>
        <span class="btn-text-inner">Telecharger</span>
        </button></a>
        </span>
        </li>

        @endif

        </ul>
        @if ($data->file_fr && $data->file_an && $data->file_pr)
            <p> Aucun fichier associer </p>
        @endif

        </div>
        <!-- end post-content -->
      </div>
      <br>

      <h2 class="post-title"> Commentaires</h2>

      <div class="services-list-boxedsingle">
          @if ($comments->isNotEmpty())
          <ul>
              @foreach ($comments as $comment)
              @if(empty($comment->parent_id))
          <li>
            <figure>
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
              <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </figure>
            <div class="content">
              <h6>{{ $comment->user->information->nom }} {{ $comment->user->information->prenom }}</h6>
              <p>{{ $comment->content }}...</p>
              {{-- <button style="color: #fff;" id="repondreBtn">Repondre </button> --}}
              @if ($data->active_commentaire == 1)

              <button style="color: #fff;" data-toggle="modal" data-target="#ajouterRoleModal{{ $comment->id }}">Repondre</button>
                @endif

            </div>
            <!-- end content -->
          {{-- ///////////////////////////////////////// --}}
          {{-- <button style="color: #fff;" class="btn btn-primary" data-toggle="modal" data-target="#ajouterRoleModal{{ $comment->id }}">Repondre</button> --}}

  <!-- Modal pour répondre au commentaire -->
  <div class="modal fade" id="ajouterRoleModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="ajouterRoleModalLabel{{ $comment->id }}" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="ajouterRoleModalLabel{{ $comment->id }}">Répondre au commentaire</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('ressources.support-formation.commentaire') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id_lier" value="{{ $comment->id_lier }}">
                      <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                      <div class="form-group">
                          <label for="reponseMessage{{ $comment->id }}">Votre réponse :</label>
                          <textarea id="reponseMessage{{ $comment->id }}" name="content" class="form-control" rows="4" cols="50"></textarea>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" style="margin-right: 0px; background: red;" data-dismiss="modal">Fermer</button>
                  <button type="submit" style="margin-right: 0px;">Répondre</button>
              </div>
                  </form>
          </div>
      </div>
  </div>
  @endif
          @if ($comment->comments->count() > 0)
              <ul>
                  @foreach ($comments as $reponse)
                  @if ($reponse->parent_id === $comment->id)
                <li>
                  <figure>
                    <svg class="orange"xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </figure>
                  <div class="content">
                    <h6>{{ $reponse->user->information->nom }} {{ $reponse->user->information->prenom }}</h6>
                    <p>{{ $reponse->content }}...</p>
                  </div>
                </li>
                @endif
                @endforeach
              </ul>
          </li>
          @endif
          @endforeach
          </ul>
          @else
          <p>Aucun commentaire....</p>
          @endif

        </div>

        <div class="blog-post">
            <div class="col-lg-12">
              <h3 class="post-title">Postez un commentaire</h3>
              <form method="post" action="{{ route('ressources.support-formation.commentaire') }}">
                  @csrf
              <textarea name="content"> </textarea>
              <input type="hidden" name="id_lier" value="{{ $data->id }}">
              <button type="submit" class="btn btn-success  mb-2 me-4">
                  <span class="btn-text-inner">Commenter</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <g clip-path="url(#clip0_468_39)">
                      <path d="M14.954 0.709983C14.9295 0.763498 14.8956 0.812247 14.854 0.853983L5.40005 10.306L8.07005 14.757C8.11735 14.8361 8.18562 14.9007 8.26731 14.9435C8.349 14.9862 8.44093 15.0056 8.53293 14.9994C8.62494 14.9932 8.71343 14.9616 8.78863 14.9083C8.86384 14.8549 8.92281 14.7818 8.95905 14.697L14.954 0.709983ZM4.69405 9.59998L0.243047 6.92798C0.163888 6.88068 0.0993508 6.81241 0.0565714 6.73072C0.0137921 6.64903 -0.00556275 6.5571 0.000646798 6.4651C0.00685635 6.37309 0.0383884 6.2846 0.0917566 6.2094C0.145125 6.13419 0.21825 6.07522 0.303047 6.03898L14.293 0.0449829C14.2387 0.0696711 14.1893 0.103877 14.147 0.145983L4.69405 9.59998Z" fill="#F8F8F8"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_468_39">
                        <rect width="15" height="15" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
              </button>
              </form>
          </div>
          </div>

      <!-- end blog-post -->

      </div>
      <!-- end col-8 -->
            <div class="col-lg-4">
        <aside class="sidebar">
      <div class="widget">
        <h6 class="widget-title">RECHERCHER</h6>
        <form>
          <input type="search" placeholder="recherche">
          <input type="submit" value="Rechercher">
        </form>
        </div>
        <!-- end widget -->
        <div class="widget">
        <h6 class="widget-title">CATEGORIES</h6>
        <ul class="categories">
            @if ($categories->isNotEmpty())
            @foreach ($categories as $category )

            <li><a href="{{ url('ressources/support-formation/recherche_par_category/'.$category->id) }}">{{ $category->nom }}</a></li>

            @endforeach
        @endif
          </ul>
        </div>
        <!-- end widget -->
        <div class="widget">
        <h6 class="widget-title">COMMENTAIRES RECENTS</h6>
        <div class="services-list-boxed">
            @if ($recenteComent->isNotEmpty())

            <ul>
                @foreach ($recenteComent as $rcoment )
                @if (empty($rcoment->parent_id))

            <li>
              <figure>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </figure>
              <div class="content">
                <h6>{{ $rcoment->user->information->nom }} {{ $rcoment->user->information->prenom }}</h6>
                <p>{{ substr($rcoment->content, 0, 100) }}...</p>
              </div>
            </li>
            @else
            <li>
              <figure>
                <svg class="orange" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </figure>
              <div class="content">
                <h6>{{ $rcoment->user->information->nom }} {{ $rcoment->user->information->prenom }}</h6>
                <p>{{ substr($rcoment->content, 0, 100) }}...</p>
              </div>
              <!-- end content -->
            </li>
            @endif
            @endforeach
            </ul>
            @else
               <p>Aucun ...</p>
            @endif
          </div>
        </div>
        <!-- end widget -->
      </aside>
      <!-- end sidebar -->
      </div>
      <!-- end col-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>


@include('layouts.footer')
<!-- end footer -->







<!-- JS FILES -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/swiper.min.js') }}"></script>
<script src="{{ asset('front/js/fancybox.min.js') }}"></script>
<script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('front/js/isotope.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.stellar.js') }}"></script>
<script src="{{ asset('front/js/odometer.min.js') }}"></script>
<script src="{{ asset('front/js/scripts.js') }}"></script>



<!-- Java script Nav Bar-->
<script type="text/javascript">
 window.addEventListener("scroll", function() {
  var nav = document.querySelector("nav");
  nav.classList.toggle("sticky", window.scrollY > 0);
});
</script>
<!--  Fin Java script Nav Bar-->


<script>
        document.getElementById('repondreBtn').addEventListener('click', function() {
            // Formulaire HTML à afficher dans la popup
            const formHtml = `
                <form id="reponseForm">
                    <label for="reponseMessage">Votre réponse :</label>
                    <textarea id="reponseMessage" name="reponseMessage" rows="4" cols="50"></textarea>
                </form>
            `;

            Swal.fire({
                title: 'Répondre au commentaire',
                html: formHtml,
                icon: 'info',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Répondre',
                cancelButtonText: 'Fermer',
                focusConfirm: false,
                customClass: {
                    confirmButton: 'swal2-repondre-button', // Ajoute une classe personnalisée au bouton "Répondre"
                },
            }).then((result) => {
                // Vérifier si le bouton "Répondre" a été cliqué
                if (result.isConfirmed) {
                    const reponse = document.getElementById('reponseMessage').value;
                    // Ici, vous pouvez traiter la réponse du formulaire
                    // Par exemple, l'envoyer vers un serveur ou l'utiliser dans votre application.
                    console.log('Réponse : ', reponse);
                }
            });
        });
    </script>












</body>
</html>
