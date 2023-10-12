@include('layouts.header')
    <!-- end navbar -->

    <header class="page-header" data-background="front/images/page-header-bg.jpg" data-stellar-background-ratio="0.7">
      <div class="container">
     <h2>Modifiez votre mot de passe </h2>
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
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">

                                <h2>Modifiez votre mot de passe</h2>
                                <p>Veuillez remplir les informations</p>

                            </div>

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Mail</label>
                                    <input type="email" name="email" required value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Mots de Passe</label>
                                    <input type="password" name="password" required value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                              <div class="mb-4">
                                  <label class="form-label"> Repeter mots de Passe</label>
                                  {{-- <input type="password" required class="form-control"> --}}
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                              </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-warning w-100" style="background: #ff9a40;">Réinitialiser le mot de passe</button>
                                </div>
                            </div>
                            <br>




                            {{-- <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Vous avez deja un compte ? <a href="/login" class="text-warning"> Connectez Vous</a></p>
                                </div>
                            </div> --}}

                        </div>
                        </form>

                    </div>
                </div>
            </div>




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
