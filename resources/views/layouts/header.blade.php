<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#009a4e"/>
    <title>{{ $title }}</title>
    <meta name="author" content="ReSCAR-AOC">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="Conseil agricole, Conseil rural, Afrique de l'Ouest, Afrique du Centre, Développement durable, Politiques agricoles, RESCAR-AOC, Acteurs du développement, Synergies professionnelles, Recherche agricole, Formation agricole, Opérationnalisation, Services agricoles, Développement de l'AOC, Durabilité agricole, Renforcement des capacités, Professionnels agricoles, Développement rural, Durabilité environnementale, Échanges d'expertise">

    <!-- SOCIAL MEDIA META -->
    <meta property="og:description" content="Le Réseau des Services de Conseil Agricole et Rural d’Afrique de l’Ouest et du Centre (RESCAR-AOC) - Acteur majeur du conseil agricole et rural pour un développement durable.">
    <meta property="og:site_name" content="RESCAR-AOC">
    <meta property="og:title" content="RESCAR-AOC">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://wwww.rescar.org">

    <!-- TWITTER META -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@RescarAoc">
    <meta name="twitter:creator" content="@RescarAoc">
    <meta name="twitter:title" content="RESCAR-AOC">
    <meta name="twitter:description" content="Le Réseau des Services de Conseil Agricole et Rural d’Afrique de l’Ouest et du Centre (RESCAR-AOC) - Acteur majeur du conseil agricole et rural pour un développement durable.">

<!-- FAVICON FILES -->
{{-- <link href="front/ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
<link href="front/ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
<link href="front/ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
<link href="front/ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
<link href="front/ico/favicon.png" rel="shortcut icon">

<!-- CSS FILES -->
<link rel="stylesheet" href="front/css/lineicons.css">
<link rel="stylesheet" href="front/css/fancybox.min.css">
<link rel="stylesheet" href="front/css/swiper.min.css">
<link rel="stylesheet" href="front/css/odometer.min.css">
<link rel="stylesheet" href="front/css/bootstrap.min.css">
<link rel="stylesheet" href="front/css/style.css"> --}}

 <!-- FAVICON FILES -->
 <link href="{{ asset('front/ico/apple-touch-icon-144-precomposed.png') }}" rel="apple-touch-icon" sizes="144x144">
 <link href="{{ asset('front/ico/apple-touch-icon-114-precomposed.png') }}" rel="apple-touch-icon" sizes="114x114">
 <link href="{{ asset('front/ico/apple-touch-icon-72-precomposed.png') }}" rel="apple-touch-icon" sizes="72x72">
 <link href="{{ asset('front/ico/apple-touch-icon-57-precomposed.png') }}" rel="apple-touch-icon">
 <link href="{{ asset('front/ico/favicon.png') }}" rel="shortcut icon">

 <!-- CSS FILES -->
 <link rel="stylesheet" href="{{ asset('front/css/lineicons.css') }}">
 <link rel="stylesheet" href="{{ asset('front/css/fancybox.min.css') }}">
 <link rel="stylesheet" href="{{ asset('front/css/swiper.min.css') }}">
 <link rel="stylesheet" href="{{ asset('front/css/odometer.min.css') }}">
 <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
 <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('front/css/modules-widgets.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('front/css/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ ('front/css/dt-global_style.css') }}">

{{-- npm install sweetalert2 --}}
<link href="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>







<!-- Inclure la bibliothèque Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js?render=6Ld7GXYnAAAAAMFi6xIEJvU50rQE8Ww0w38lSnhw"></script>

<link rel="stylesheet" href="{{ asset('front/css/tagify.css') }}">


</head>
<body>
<div class="preloader"> <img src="{{ asset('front/images/preloader.gif') }}" alt="Image"> </div>
<!-- end preloader -->
<div class="page-transition"></div>
<!-- end page-transition -->
<div class="search-box">
  <div class="inner">
    <form>
      <input type="search" placeholder="Rechercher">
      <input type="submit" value="Rechercher">
    </form>
  </div>
</div>
<!-- end search-box -->
<aside class="side-widget">
  <div class="inner">
    <div class="logo"> <a href="index.html"><img src="{{ asset('front/images/logo1.png') }}" alt="Image"></a> </div>
    <!-- end logo -->
    <div class="hide-mobile">
      <p>Contribuer à améliorer les conditions de vie des agropasteurs en Afrique et dans se monde</p>
      <figure class="gallery"><a href="{{ asset('front/images/slide02.jpg') }}" data-fancybox><img src="{{ asset('front/images/slide02.jpg') }}" alt="Image"></a><a href="{{ asset('front/images/slide03.jpg') }}" data-fancybox><img src="{{ asset('front/images/slide03.jpg') }}" alt="Image"></a></figure>
      <h6 class="widget-title">CONTACT INFO</h6>
      <address class="address">
      <p><a href="tel: +226 25 40 56 86">+226 25 40 56 86</a><br>
        <a href="tel: +226 05 89 57 57">+226 05 89 57 57</a><br>
      <a href="mailto: contact@rescar.org ">contact@rescar.org</a><br>
      01 BP 6630 Ouagadougou 01 Burkina Faso
      </p>
      </address>
      <h6 class="widget-title">Suivez nous sur</h6>
      <ul class="social-media">
        <li><a href="https://www.linkedin.com/company/rescar-aoc/"><i class="lni lni-linkedin-original"></i></a></li>
        <li><a href="https://twitter.com/RescarAoc"><i class="lni lni-twitter-original"></i></a></li>
      </ul>
    </div>
    <!-- end hide-mobile -->
    <div class="show-mobile">
      <div class="site-menu">
          <ul>
            <li><a href="#">Qui somme nous?</a>
              <ul>
                <li><a href="{{ url('qui-somme-nous/histoire') }}">Notre Histoire </a></li>
                <li><a href="{{ url('qui-somme-nous/objectif-mission') }}">Objectifs et Mission</a></li>
                <li><a href="{{ url('qui-somme-nous/gouvernances') }} ">Gouvernances </a></li>
                <li><a href="{{ url('qui-somme-nous/partenaires-financiers') }}">Partenaires financiers</a></li>
                <li><a href="{{ url('qui-somme-nous/membres') }}">Membres</a></li>
                <li><a href="{{ url('qui-somme-nous/espace') }}">Espaces Membres</a></li>
                <li><a href="{{ url('qui-somme-nous/recrutements') }}">Recrutements</a></li>
              </ul>
            </li>
            <li><a href="{{ url('actualite') }}">Actualités</a></li>

            <li><a href="#">Ressources</a>
              <ul>
                <li><a href="{{ url('ressources/etudes') }}">Etudes et publications</a></li>
                <li><a href="{{ url('ressources/fiches-expériences') }}">Fiches d’expériences</a></li>
                <li><a href="{{ url('ressources/rapport-activités') }}">Rapport d’activités</a></li>
                <li><a href="{{ url('ressources/support-formation') }}">Support de formation</a></li>
                <li><a href="{{ url('ressources/articles-mémoires-recherche') }}">Articles, Mémoires de recherche</a></li>
              </ul>
            </li>
            <li><a href="#">Repertoires</a>
              <ul>
                <li><a href="{{ url('repertoires/organismes') }}">Organisations spécialisées dans le développement</a></li>
                <li><a href="{{ url('repertoires/experts') }}">Experts du développement</a></li>
              </ul>
            </li>
            <li><a href="{{ url('forum') }}">Forum</a></li>
          </ul>
      </div>
      <!-- end site-menu -->
    </div>
    <!-- end show-mobile -->
    <small>© 2023 RESCAR-AOC |Le Réseau des Services de Conseil Agricole et Rural d’Afrique de l’Ouest et du Centre</small> </div>
  <!-- end inner -->
</aside>
<!-- end side-widget -->
    <div class="topbar"  style="background: #FFEEDE;">
      <div class="container">
        @if(auth()->user())
        <a href="">
            <button class="btn btn-success"
              style="
                margin: 0 20px 0px 0px;
                padding: 3px 15px;
                background-color: #1d934d;
                border: none;
                border-radius: 6px;
                font-size: 13px;
                font-weight: bold;
                color: #fff;
                ">
              Profil </button></a>
              <a href="{{ url('/deconnexion') }}">
                <button class="btn btn-danger"
                  style="
                    margin: 0 20px 0px 0px;
                    padding: 3px 15px;
                    background-color: #ec1f1f;
                    border: none;
                    border-radius: 6px;
                    font-size: 13px;
                    font-weight: bold;
                    color: #fff;
                    ">
                  Deconnexion </button></a>
        @else
        <a href="{{ url('/login') }}">
        <button class="btn btn-warning"
          style="
            margin-left: 20px;
            margin-right: 25px;
            padding: 3px 15px;
            background-color: #EC971F;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            ">
          Connection </button> </a>
        <a href="{{ url('/register') }}">
        <button class="btn btn-success"
          style="
            margin: 0 20px 0px 0px;
            padding: 3px 15px;
            background-color: #1d934d;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            ">
          Inscription </button></a>
          @endif
      </div>
      <div class="dropdown">
        <button class="dropbtn">
            <span class="flag-icon flag-icon-fr"></span>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#"><span class="flag-icon flag-icon-fr"></span>
                Français</a>
            <a href="#"><span class="flag-icon flag-icon-us"></span>
                English</a>

            <!-- Ajoutez d'autres options de langue avec des drapeaux ici -->
        </div>
      </div>




      <!-- end container -->
    </div>
<!-- end topbar -->
    <nav class="navbar">

      <div class="container">
        <div class="logo">
      <!-- L'image par défaut du logo -->
      <a href="/">
        <img src=" {{ asset('front/images/logo.png') }}" width="200px" alt="Logo">
      </a>
    </div>
    <!-- end logo -->
    <div class="logo-scroll">
      <!-- L'image alternative du logo pour le défilement -->
      <a href="/">
        <img src="{{ asset('front/images/logo1.png') }}" width="200px" alt="Logo">
      </a>
    </div>
    <!-- end logo -->
        <div class="site-menu sticky">
          <ul>
            <li><a href="#">Qui somme nous?</a>
              <ul>
                <li><a href="{{ url('qui-somme-nous/histoire') }}">Notre Histoire </a></li>
                <li><a href="{{ url('qui-somme-nous/objectif-mission') }} ">Objectifs et Mission</a></li>
                <li><a href="{{ url('qui-somme-nous/gouvernances') }}">Gouvernances </a></li>
                <li><a href="{{ url('qui-somme-nous/partenaires-financiers') }}">Partenaires financiers</a></li>
                <li><a href="{{ url('qui-somme-nous/membres') }}">Membres</a></li>
                <li><a href="{{ url('qui-somme-nous/espace') }}">Espaces Membres</a></li>
                <li><a href="{{ url('qui-somme-nous/recrutements') }}">Recrutements</a></li>
              </ul>
            </li>
            <li><a href="{{ url('actualite') }}">Actualités</a></li>


            <li><a href="#">Ressources</a>
              <ul>
                <li><a href="{{ url('ressources/etudes') }}">Etudes et publications</a></li>
                <li><a href="{{ url('ressources/fiches-expériences') }}">Fiches d’expériences</a></li>
                <li><a href="{{ url('ressources/rapport-activités') }}">Rapport d’activités</a></li>
                <li><a href="{{ url('ressources/support-formation') }}">Support de formation</a></li>
                <li><a href="{{ url('ressources/articles-mémoires-recherche') }}">Articles, Mémoires de recherche</a></li>
              </ul>
            </li>
            <li><a href="#">Repertoires</a>
              <ul>
                <li><a href="{{ url('repertoires/organismes') }}">Organisations spécialisées dans le développement</a></li>
                <li><a href="{{ url('repertoires/experts') }}">Experts du développement</a></li>
              </ul>
            </li>
            <li><a href="{{ url('forum') }}">Forum</a></li>
          </ul>
        </div>
        <!-- end site-menu -->
        <div class="search-button"><i class="lni lni-search-alt"></i></div>
        <!-- end search-button -->
        <div class="hamburger-menu"> <span  style="background-color:#ff9a40;"></span> <span  style="background-color:#ff9a40;"></span> <span  style="background-color:#ff9a40;"></span>
        </div>
        <!-- end hamburger-menu -->
      </div>
      <!-- end container -->
    </nav>
    @if(session()->has('success') )
    <div class="modal-body">
        @if(session()->has('success') || session()->has('error'))
            <script>
                function showAlert(icon, title, text) {
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: text
                    });
                }

                @if(session()->has('success'))
                    showAlert('success', 'Succès', '{{ session("success") }}');
                @endif

                @if(session()->has('error'))
                    showAlert('error', 'Erreur', '{{ session("error") }}');
                @endif
            </script>
        @endif
    </div>
@endif


