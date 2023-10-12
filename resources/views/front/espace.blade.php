@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Espaces Membres </h2>
    <p>Decouvrez les membres de notre equipe</p>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>


<section class="content-section">
  <center>
  <a href="{{ url('qui-somme-nous/membres/physique') }}"><button class="btn btn-success  mb-2 me-4 btn-lm"><b>Devenir Membre Phyique</b></button></a>
  <a href="{{ url('qui-somme-nous/membres/morale') }}"><button class="btn btn-success  mb-2 me-4 btn-lm"><b>Devenir Membre Morale</b></button></a>

  <br><br>
  <div class="container">
    <div class="row">

      <div class="col-12">
          <div class="">

          <div class="section-title text-left">
          <h3> Liste des membres physique</h3>
          </div>
              <table id="zero-config" class="table dt-table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th>Nom et Prénoms</th>
                          <th>Pays</th>
                          <th>mail</th>
                      </tr>
                  </thead>
                  <tbody>
                    @if ($physique->isNotEmpty())
                    @foreach ($physique as $item)

                      <tr>
                          <td>{{ $item->nom }} {{ $item->prenom }}</td>
                          <td>{{ $item->pays }}</td>
                          <td>{{ $item->email }}</td>

                      </tr>

                    @endforeach
                    @else
                    <p>Aucun</p>
                    @endif

                  </tbody>
              </table>
          </div>
      </div>

    </div>
  </div>

  <br><br>

  </center>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                <h3> Liste des membres morale </h3>
                </div>
            </div>
        </div>
      <div class="experts-slid">
        @if ($morale->isNotEmpty())
            @foreach ($morale as $data)

        <div class="swiper-slid">
          <figure>
            <img src="{{ asset('storage/'.$data->logo) }}" alt="Logo">
            <figcaption>
            <h5>{{ $data->nom }} </h5>
              <small>{{ $data->domaine }}</small>
            </figcaption>
            </figure>
        </div>

        @endforeach
        @else
        <p>Aucun</p>
        @endif
      <!-- end swiper-slide -->

      <!-- end swiper-slide -->





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
<script src="{{ asset('front/js/datatables.js') }}"></script>


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



    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": " Page _PAGE_ sur _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Recherche...",
               "sLengthMenu": "Trier par :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>






</body>
</html>
