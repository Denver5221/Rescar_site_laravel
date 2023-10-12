@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Forum </h2>
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

        <div class="post-content">

            @if ($forum->user->roles->first()->nom === "Administrateur" || $forum->user->roles->first()->nom === "Editeur")
            <div class="author"> <img src="{{ asset('front/images/avatar.jpg') }}" alt="Image"> <span>par <strong>Rescar-aoc</strong></span> </div>
             @else
             <div class="author">
                 <img src="{{ asset('front/images/avatar.jpg') }}" alt="Image">
                  <span>par <strong>{{ $forum->user->information->nom }} {{ $forum->user->information->prenom }}</strong></span> </div>
            @endif

          <h4 class="post-title"> {{ $forum->thematique->thematique }} . <br>  {{ $forum->thematique->description }}</h4>
            <span class="post-dat">{{ $forum->created_at->format('d M, Y') }}</span><br>
            @php
            $tags = $forum->thematique->tags;
            $tagsArray = json_decode($tags, true);
            @endphp

    <p>Categories :
        @if ($forum->categories->isNotEmpty())
            @foreach ($forum->categories as $cat)
                <button class="btn btn-success  mb-2 me-4 btn-sm">{{ '#'.$cat->nom }}</button>


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
              <!-- end author -->



              {{-- <form method="POST" action="{{ route('front.forum.like') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $forum->id }}"> --}}
          <div class="widget-content widget-content-area text-center">

            <button type="submit" class="btn btn-outline-success mb-2 me-4 like-button" data-post-id="{{ $forum->id }}" id="likeButton">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
              </svg>
              <span class="btn-text-inner">{{ $forum->likes->count() }} J'aimes</span>
            </button>
        {{-- </form> --}}
        {{-- @livewire('like-dislike', ['forum' => $forum], key($forum->id)) --}}

              <button class="btn btn-  mb-2 me-4" style="background:#ff9a40; color:white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                <span class="btn-text-inner">{{ $forum->comments->count() }} Commentaires</span>
              </button>

              <button class="btn btn-secondary  mb-2 me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="none">
                  <path d="M16 8.28601C8.454 8.28601 2.5 16 2.5 16C2.5 16 8.454 23.715 16 23.715C21.77 23.715 29.5 16 29.5 16C29.5 16 21.77 8.28601 16 8.28601ZM16 20.806C13.35 20.806 11.193 18.65 11.193 16C11.193 13.35 13.35 11.193 16 11.193C18.65 11.193 20.807 13.35 20.807 16C20.807 18.65 18.65 20.806 16 20.806ZM16 13.194C15.6271 13.187 15.2566 13.2543 14.91 13.3922C14.5635 13.53 14.2479 13.7355 13.9817 13.9967C13.7155 14.2579 13.5041 14.5696 13.3597 14.9135C13.2154 15.2574 13.141 15.6266 13.141 15.9995C13.141 16.3725 13.2154 16.7417 13.3597 17.0855C13.5041 17.4294 13.7155 17.7411 13.9817 18.0023C14.2479 18.2635 14.5635 18.469 14.91 18.6069C15.2566 18.7447 15.6271 18.8121 16 18.805C16.7349 18.7911 17.435 18.4895 17.9498 17.9648C18.4646 17.4402 18.753 16.7345 18.753 15.9995C18.753 15.2645 18.4646 14.5588 17.9498 14.0342C17.435 13.5096 16.7349 13.2079 16 13.194Z" fill="white"/>
                </svg>
                <span class="btn-text-inner">{{ $forum->vues->count() }}  Vues</span>
              </button>

            <button class="btn btn-primary  mb-2 me-4" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M11 6.91394V2.58594L6.29304 7.29294L2.51904 11.0669L6.36004 14.2679L11 18.1349V13.8999C19.146 13.2859 22 17.9999 22 17.9999C22 15.0629 21.758 12.0149 19.449 9.70694C16.765 7.02194 12.878 6.83194 11 6.91394Z" fill="white"/>
                </svg>
                <span class="btn-text-inner">Partager</span>
            </button>
          </div>


        </div>

        <!-- end post-content -->
      </div>
      <br>

      @if ($forum->thematique->active_commentaire == 1)
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
              <button style="color: #fff;" data-toggle="modal" data-target="#ajouterRoleModal{{ $comment->id }}">Repondre</button>


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
                            <form action="{{ route('front.forum.commentaire') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_lier" value="{{ $comment->id_forum }}">
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                <div class="form-group">
                                    <label for="reponseMessage{{ $comment->id }}">Votre réponse :</label>
                                    <textarea id="reponseMessage{{ $comment->id }}" name="content" class="form-control" rows="4" cols="50"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" style="margin-right: 0px; background: red;" data-dismiss="modal">Fermer</button>
                           <button type="submit" id="actualiser" style="margin-right: 0px;">Répondre</button>
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
        @endif




        @if ($forum->thematique->active_commentaire == 1)

        <div class="blog-post">
          <div class="col-lg-12">
            <h3 class="post-title">Postez un commentaire</h3>
            <form method="post" action="{{ route('front.forum.commentaire') }}">
                @csrf
            <textarea name="content"> </textarea>
            <input type="hidden" name="id_lier" value="{{ $forum->id }}">
            <button type="submit" id="actualiser1" class="btn btn-success  mb-2 me-4">
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
            <script>
                // Code JavaScript pour actualiser la page
                document.getElementById('actualiser').addEventListener('click', function() {
                    location.reload(); // Cette fonction recharge la page
                });
            </script>
         <script>
            // Code JavaScript pour actualiser la page
            document.getElementById('actualiser1').addEventListener('click', function() {
                location.reload(); // Cette fonction recharge la page
            });
        </script>
        </div>
        </div>

        @endif


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
            @if ($categori->isNotEmpty())
            @foreach ($categori as $category )

            <li><a href="{{ url('forum/recherche_par_category/'.$category->id) }}">{{ $category->nom }}</a></li>

            @endforeach
        @endif
          </ul>
        </div>
        <!-- end widget -->
        @if ($forum->thematique->active_commentaire == 1)
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
        @endif
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
<script src="{{ asset('front/js/modules-widgets.js') }}"></script>

<!-- Java script Nav Bar-->
<script type="text/javascript">
 window.addEventListener("scroll", function() {
  var nav = document.querySelector("nav");
  nav.classList.toggle("sticky", window.scrollY > 0);
});
</script>
<!--  Fin Java script Nav Bar-->

<script>
    $(document).ready(function() {
      $('.like-button').click(function(e) {
        e.preventDefault();
        var postId = $(this).data('post-id');

        // Vérifier si l'utilisateur est connecté
        @auth
          // L'utilisateur est connecté, envoyer une requête AJAX pour liker le post
          $.ajax({
            type: 'POST',
            url: '/forum/like',
            data: {
              post_id: postId,
              _token: '{{ csrf_token() }}'
            },
            success: function(data) {
              // Mettez à jour l'interface utilisateur pour refléter le "like"
              $('.likes-count[data-post-id="' + postId + '"]').text(data.likes);
            },
            error: function() {
              alert('Une erreur est survenue lors de la mise à jour du like.');
            }
          });
        @else
          // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
          window.location.href = '/login';
        @endauth
      });
    });
    </script>





    <script>
        $('form').on('submit', function() {
        // Envoyez une requête AJAX au serveur
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
        });

        return false;
        });

// Récupérer l'élément du DOM pour le bouton "Like"
const likeButton = document.getElementById('likeButton');

// Compteur initial
let likes = {{ $forum->likes->count() }};
let isLiked = false; // Variable pour suivre l'état du bouton "Like"

// Fonction pour mettre à jour le texte du bouton et le nombre de likes
function updateLikeButton() {
  likeButton.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
      <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
    </svg>
    <span class="btn-text-inner">${likes} J'aimes</span>
  `;

  // Ajouter ou supprimer les classes pour changer le design du bouton
  if (isLiked) {
    likeButton.classList.remove('btn-outline-success');
    likeButton.classList.add('btn-danger');
  } else {
    likeButton.classList.add('btn-outline-success');
    likeButton.classList.remove('btn-danger');
  }
}

// Fonction pour gérer le clic sur le bouton "Like"
likeButton.addEventListener('click', () => {
  if (isLiked) {
    // Si le bouton était déjà "Dislike", on revient à "Like"
    likes--;
    isLiked = false;
  } else {
    // Sinon, on passe de "Like" à "Dislike"
    likes++;
    isLiked = true;
  }
  updateLikeButton();
});

// Appel initial pour mettre à jour le bouton "Like"
updateLikeButton();
;

    </script>












</body>
</html>
