@include('layouts.header')

<!-- end navbar -->
<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
	<div class="container">
	<h2>Objectifs et Missions</h2>
		<p>Wild flowers, plants and fungi are the life support</p>
	</div>
	<!-- end container -->
	 <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>
<!-- end page-header -->
<section class="content-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="section-title text-left">
        <h2>Objectifs et Missions</h2>
      </div>
      <!-- Fin de section-tittle -->

		  <div class="col-lg-8">
        <figure class="side-image"> <img src="{{ asset('front/images/side-image01.jpg') }}" alt="Image"> </figure>
      </div>
      <!-- end col-8 -->
	    <div class="col-lg-4">
        <div class="side-content right">
          <h5>Vision</h5>
          <p>
            Le conseil agricole et rural est en adéquation avec la
            demande et contribue efficacement au développement durable
            en Afrique de l'Ouest et du centre
          </p>
			  </div>
        <!-- end side-content -->
      </div>
      <!-- end col-4 -->
      <div class="col-12 spacing-100"></div>
      <!-- end spacing-100 -->
      <div class="col-lg-4">
        <div class="side-content left">
          <h5>Mission</h5>
          <p>Offrir un espace d'échange, d'apprentissage, de partage, de développement
            des capacités entre les acteurs du conseil agricole en Afrique de
            l'Ouest et du Centre afin d'améliorer leurs performances et impacts
          </p>
        </div>
        <!-- end side-content -->
      </div>
      <!-- end col-4 -->
      <div class="col-lg-8">
        <figure class="side-image"> <img src="{{ asset('front/images/side-image02.jpg') }}" alt="Image"> </figure>
      </div>
      <!-- end col-8 -->
		 <div class="col-12 spacing-100"></div>
      <!-- end spacing-100 -->

      <div class="col-lg-8">
        <figure class="side-image"> <img src="{{ asset('front/images/side-image01.jpg') }}" alt="Image"> </figure>
      </div>
      <!-- end col-8 -->
	    <div class="col-lg-4">
        <div class="side-content right">
          <h5>Objectif</h5>
          <p>
            Contribuer à améliorer les conditions
            de vie des agropasteurs en Afrique et dans le monde
          </p>
			  </div>
        <!-- end side-content -->
      </div>
      <!-- end col-4 -->
      <div class="col-12 spacing-100"></div>

	  </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end content-section -->
@include('layouts.footer')
<!-- end footer -->

 <!-- Charger les fichiers JavaScript -->
 <script src="{{ asset('front/js/jquery.min.js') }}"></script>
 <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('front/js/swiper.min.js') }}"></script>
 <script src="{{ asset('front/js/fancybox.min.js') }}"></script>
 <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('front/js/isotope.min.js') }}"></script>
 <script src="{{ asset('front/js/jquery.stellar.js') }}"></script>
 <script src="{{ asset('front/js/odometer.min.js') }}"></script>
 <script src="{{ asset('front/js/scripts.js') }}"></script>

</body>
</html>
