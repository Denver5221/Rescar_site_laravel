@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Experts </h2>
    <p>Decouvrez les Experts du développement</p>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>


<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                <h2>Experts </h2>
                </div>
            </div>
        </div>



      <div class="experts-slid">


      <!-- end swiper-slide -->




      <!-- end swiper-slide -->
        @if ($experts->isNotEmpty())
            @foreach ($experts as $data)

        <div class="swiper-slid">
            <figure>
            <img src="{{ asset('storage/'.$data->photo) }}" alt="Image">
            <figcaption>
            <h5>{{ $data->nom }}</h5>
            <small>{{ $data->description }}</small>
            <ul>
               @if($data->facebook) <li><a href="{{ $data->facebook }}" target="_blank"><i class="lni lni-facebook-filled"></i></a></li> @endif
              @if($data->linkedin) <li><a href="{{ $data->linkedin }}"><i class="lni lni-linkedin-original"></i></a></li>@endif
               @if($data->site)<li><a href="{{ $data->site }}"><i class="lni lni-site"></i></a></li>@endif
                {{-- <li><a href="#"><i class="lni lni-youtube"></i></a></li>
                <li><a href="#"><i class="lni lni-pinterest"></i></a></li> --}}
            </ul>
            </figcaption>
            </figure>
        </div>

        @endforeach
        @endif








        </div>
    </div>

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
