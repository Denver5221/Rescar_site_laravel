@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Groupe de travail</h2>
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
        
        <span class="rounded-pill">
        <a href="{{ asset('storage/'.$data->file_fr) }}" target="_blank">
        <button class="btn btn-success  mb-2 me-4">
        <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" fill="white"></path> <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" fill="white"></path> </svg>
        <span class="btn-text-inner">Telecharger</span>
        </button></a>
        </span>
        </li>

        @endif

        </ul>
  

        </div>
        <!-- end post-content -->
      </div>
      <br>

     
          


        

      <!-- end blog-post -->

      </div>
      <!-- end col-8 -->
            <div class="col-lg-4">
        <aside class="sidebar">
      <div class="widget">
        <h6 class="widget-title">RECHERCHER</h6>
        <form method="POST" action="{{ route('ressources.groupe-travail.search') }}">
            @csrf
            <input type="search" required name="search" placeholder="Type here to search">
            <input type="submit" value="Search">
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
