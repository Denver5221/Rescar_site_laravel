@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>articles-mémoires-recherche</h2>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>

<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">

      <div class="pagination-container">

        @if ($articles->isNotEmpty())
            @foreach ($articles as $item)

      <!-- end side-image-box -->
      <div class="side-image-box paginated-item">
      <figure><img src="{{ asset('storage/'.$item->image) }}" alt="Image"></figure>
        <div class="content">
        <h3>{{ substr($item->titre, 0, 50) }}...</h3>
          <p>{{ substr($item->description, 0, 100) }}... </p>
          <button class="btn btn-success  mb-2 me-4 btn-sm"><b><a href="{{ url('ressources/articles-mémoires-recherche/'.$item->slug) }}">En savoir plus</a></b></button>
        </div>
        <!-- end content -->
      </div>
      <!-- end side-image-box -->

      @endforeach
      @endif
      </div>
         <ul class="pagination">
          <li class="page-item"> <a class="page-link" id="prevBtn" href="#">Précédent</a> </li>
          <li class="page-item"> <a class="page-link" id="nextBtn" href="#">Suivant</a> </li>
        </ul>
    </div>

      <div class="col-lg-4">
        <aside class="sidebar">
      <div class="widget">
        <h6 class="widget-title">Rechercher</h6>
        <form method="POST" action="{{ route('ressources.articles-mémoires-recherche.search') }}">
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

            <li><a href="{{ url('ressources/articles-mémoires-recherche/recherche_par_category/'.$category->id) }}">{{ $category->nom }}</a></li>

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


@include('layouts.footer')<!-- end footer -->








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



<!--Java script PAGINATION-->
<script>
// Fonction pour masquer tous les éléments paginés
function hideAllItems() {
  const paginatedItems = document.querySelectorAll(".paginated-item");
  paginatedItems.forEach(item => {
    item.classList.add("hidden");
  });
}

// Fonction pour afficher les éléments de la page spécifiée
function showItems(pageNumber, itemsPerPage) {
  const startIndex = (pageNumber - 1) * itemsPerPage;
  const paginatedItems = document.querySelectorAll(".paginated-item");
  for (let i = startIndex; i < startIndex + itemsPerPage; i++) {
    if (paginatedItems[i]) {
      paginatedItems[i].classList.remove("hidden");
    }
  }
}
// Pagination setup
const itemsPerPage = 4;
let currentPage = 1;
const totalItems = document.querySelectorAll(".paginated-item").length;
const totalPages = Math.ceil(totalItems / itemsPerPage);

// Affiche les éléments de la première page
hideAllItems();
showItems(currentPage, itemsPerPage);

// Gestionnaire de clic pour le bouton Suivant
document.getElementById("nextBtn").addEventListener("click", function () {
  if (currentPage < totalPages) {
    currentPage++;
    hideAllItems();
    showItems(currentPage, itemsPerPage);
  }
});

// Gestionnaire de clic pour le bouton Précédent
document.getElementById("prevBtn").addEventListener("click", function () {
  if (currentPage > 1) {
    currentPage--;
    hideAllItems();
    showItems(currentPage, itemsPerPage);
  }
});
</script>
<!-- Fin Java script PAGINATION-->







</body>
</html>
