@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
 <h2>Mots de passe oublié </h2>
    <p>Découvrez nos annonces de récrutement et de ceux de nos partenaires</p>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>



<section class="content-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">

          <div class=" col-12 d-flex flex-column self-center mx-auto">
            <div class="card mt-3 mb-3">
                <div class="card-body">

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">

                            <h2>Mots de passe oublié</h2>
                            <p>Entrez votre adresse e-mail associée à votre compte et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-warning w-100" style="background: #ff9a40; f">Renitialiser le mot de passe</button>
                            </div>
                        </div>
                        <br>

                        <div class="col-12">
                            <div class="text-center">
                                <p class="mb-0">Vous n'avez pas de compte ? <a href="{{ url('/login') }}" class="text-warning">Annuler</a></p>
                            </div>
                        </div>

                    </div>
                    </form>
                    @if (session('status'))
                    <div class="modal-body">
                        Un email contenant un lien de réinitialisation de mot de passe a été envoyé à votre adresse email.
                    </div>
                   @endif

                </div>
            </div>
        </div>
        {{-- <div class="modal-body">
            @if(session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'Un email contenant un lien de réinitialisation de mot de passe a été envoyé à votre adresse email.'
                });
            </script>
        @endif
        @if(session()->has('error'))
       <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ session("error") }}'
                });
            </script>
        @endif --}}



      </div>
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










