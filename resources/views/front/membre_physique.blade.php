@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
 <h2>Devenir Membre Physique </h2>
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
                <form action="{{ route('qui-somme-nous.membrePhysique_post') }}" method="post">
                    @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 mb-3">

                            <h2>S'inscrire</h2>
                            <p>Veuillez remplir les informations</p>

                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Prenom</label>
                                <input type="text" name="prenom" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="mb-3">
                              <label class="form-label">Année de Naissance</label>
                              <input type="date" name="date_naissance" required class="form-control">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="mb-3">
                              <label for="pays">Pays :</label>
                                <select id="pays" name="pays"></select>
                                <br>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="mb-3">
                              <label for="pays">Sexe :</label>
                                <select id="sexe" name="sexe">
                                  <option>Masculin</option>
                                  <option>Féminin</option>
                                </select>
                                <br>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="mb-3">
                              <label for="pays">Profil Académique :</label>
                                <select id="sexe" name="niveau">
                                  <option>Néant</option>
                                  <option>Cep</option>
                                  <option>Bepc</option>
                                  <option>Bac</option>
                                  <option>Licence</option>
                                  <option>Master</option>
                                  <option>Doctorat</option>
                                </select>
                                <br>
                          </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Fonction actuelle</label>
                                <input type="text" name="fonction" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Domaine de spécialisation</label>
                                <input type="text" name="domaine" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Numéro téléphone (préférence WhatsApp)</label>
                                <input type="text" name="phone" required class="form-control">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Mail</label>
                                <input type="email" name="email" required class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label">Biographie synthétique(3 à 5 phrases)</label>
                               <textarea name="message" placeholder="Message"></textarea>

                            </div>
                        </div>

                        <div class=" col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input me-3" name="terme" type="checkbox" id="form-check-default" required>
                                    <label class="form-check-label" for="form-check-default">
                                        j'accepte les  <a href="javascript:void(0);" class="text-success"> Termes et conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-warning w-100" style="background: #ff9a40;">Envoyer</button>
                            </div>
                        </div>
                        <br>

                    </div>

                </div>
                </form>
            </div>
        </div>




      </div>
    </div>
  </div>
</section>



@include('layouts.footer')
<!-- end footer -->









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

    <script type="text/javascript">

const countries = [
 "Bénin",
  "Burkina Faso",
  "Cap-Vert",
  "Côte d'Ivoire",
  "Gambie",
  "Ghana",
  "Guinée",
  "Guinée-Bissau",
  "Liberia",
  "Mali",
  "Mauritanie",
  "Niger",
  "Nigeria",
  "Sénégal",
  "Sierra Leone",
  "Togo",
  "Cameroun",
  "République centrafricaine",
  "Tchad",
  "Congo-Brazzaville",
  "République démocratique du Congo",
  "Guinée équatoriale",
  "Gabon",
  "Sao Tomé-et-Principe"
];

const selectElement = document.getElementById("pays");

function addCountryOptions() {
  for (const country of countries) {
    const optionElement = document.createElement("option");
    optionElement.value = country;
    optionElement.innerText = country;
    selectElement.appendChild(optionElement);
  }
}

addCountryOptions();

    </script>












</body>
</html>
