@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Récrutements </h2>
    <p>Découvrez nos annonces de récrutement et de ceux de nos partenaires</p>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>

<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">

      <div id="uc" class="pagination-container">

        @if ($sortedCollection->isNotEmpty())
            @foreach($sortedCollection as $item)


                @if ($item->id_partenaire)
                    <!-- end side-image-box -->
                    <div class="side-image-box paginated-item" style="background: #fbdab5;">
                        <figure><img src="{{ asset('storage/'. $item->image) }}" alt="Image"></figure>
                        <div class="content">
                            <h5><i> Recrutement {{ substr($item->partenaire->nom,0, 25) }}</i></h5>
                        <h3>{{ $item->nom }}</h3>
                            <p>{{ substr($item->description, 0, 50) }}...</p>
                            <button class="btn btn-success  mb-2 me-4 btn-sm"><b><a href="{{ url('/qui-somme-nous/recrutements/partenaire/'.$item->slug)  }}">En savoir plus</a></b></button>
                        </div>
                        <!-- end content -->
                        </div>
                @endif
                @if (empty($item->id_partenaire))
                <!-- Le contraire de $item->id_partenaire (c'est-à-dire lorsque id_partenaire n'est pas défini ou est null) -->
                <div class="side-image-box paginated-item" >
                    <figure><img src="{{ asset('storage/'. $item->image) }}" alt="Image"></figure>
                    <div class="content">
                        <h5><i> Recrutement Rescar-aoc </i></h5>
                        <h3>{{ $item->nom }}</h3>
                        <p>{{ substr($item->description, 0, 100) }}...</p>
                        <button class="btn btn-success mb-2 me-4 btn-sm"><b><a href="{{ url('/qui-somme-nous/recrutements/'.$item->slug) }}">En savoir plus</a></b></button>
                    </div>
                    <!-- end content -->
                </div>
            @endif
      @endforeach
      @endif

      </div>
         <ul class="pagination">
          <li class="page-item"> <a class="page-link" id="prevBtn" href="#uc">Précédent</a> </li>
          <li class="page-item"> <a class="page-link" id="nextBtn" href="#uc">Suivant</a> </li>
        </ul>
    </div>

      <div class="col-lg-4">
        <aside class="sidebar">
      <div class="widget">
        <h6 class="widget-title">Rechercher</h6>
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
                    <li><a href="#">{{ $category->nom }}</a></li>
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









    <!-- Scripts JavaScript -->
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
