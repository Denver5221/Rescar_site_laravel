@include('layouts.header')

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Partenaires </h2>
    <p>Decouvrez nos partenaires</p>
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
                <h2>Partenaires </h2>
                </div>
            </div>
        </div>



      <div class="experts-slid">
        @if ($partenaires->isNotEmpty())
            @foreach ($partenaires as $patern )
                @if ($patern->status == 1)


      <div class="swiper-slid">
          <figure>
            <img src="{{ asset('storage/'. $patern->image)  }}" alt="Image">
            <figcaption>
            <center>
            <h5>{{ $patern->nom }}</h5>
              <small>{{ $patern->description }}</small>
              <ul>
                @if ($patern->site)

                  <li><a href="{{ $patern->site }}"><i class="lni lni-link"></i> : <strong>www.web.com </strong> </a></li>

                @endif
                  <li><a href="#"><i class="lni lni-phone"></i> : <strong> +226 {{ $patern->numero }} </strong></a></li>


              </ul>
              </center>
            </figcaption>
            </figure>
      </div>

      @endif
      @endforeach
  @endif
      <!-- end swiper-slide -->









        </div>
    </div>

</section>



@include('layouts.footer')
<!-- end footer -->









<!-- JS FILES -->
{{-- <script src="front/js/jquery.min.js"></script>
<script src="front/js/bootstrap.min.js"></script>
<script src="front/js/swiper.min.js"></script>
<script src="front/js/fancybox.min.js"></script>
<script src="front/js/imagesloaded.pkgd.min.js"></script>
<script src="front/js/isotope.min.js"></script>
<script src="front/js/jquery.stellar.js"></script>
<script src="front/js/odometer.min.js"></script>
<script src="front/js/scripts.js"></script> --}}
<!-- JS FILES -->
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
