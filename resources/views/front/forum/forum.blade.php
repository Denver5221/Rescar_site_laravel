@include('layouts.header')
<!-- end navbar -->

<header class="page-header" data-background="{{ asset('front/images/page-header-bg.jpg') }}" data-stellar-background-ratio="0.7">
  <div class="container">
  <h2>Forum </h2>
    <p>Partager votre opinion avec les autres</p>
  </div>
  <!-- end container -->
   <div class="parallax-element" data-stellar-ratio="2"></div>
    <!-- end parallax-element -->
</header>

<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">



    <div class="tab-menu">
<button class="tablink" onclick="openTab('forum')" data-tab="forum"><b>Forum</b></button>
<button class="tablink" onclick="openTab('profil')" data-tab="profil"><b>Profil</b></button>
<button class="tablink" onclick="openTab('activites')" data-tab="activites"><b>Activités</b></button>
<button class="tablink" onclick="openTab('poser-une-question')" data-tab="poser-une-question"><b>Poser question</b></button>

  </div>

  <div id="forum" class="tab-content">
    <div class="pagination-container">


      <table class="services-list-boxede" >
        <tr>
            <th>Question</th>
            <th>
              <ul>
              <li class="titre">
                <div class="content">
                  <h6>Vues</h6>
                </div>
              </li>
              </ul>
            </th>


            <th>
            <ul>
              <li class="titre">
                <div class="content">
                  <h6>Comments</h6>
                </div>
              </li>
            </ul>
            </th>

            <th>
              <ul>
              <li class="titre">
                <div class="content">
                  <h6>Likes</h6>
                </div>
              </li>
              </ul>
            </th>
        </tr>

        @if ($forums->isNotEmpty())
            @foreach ($forums as $item)
                {{-- @if ($item->thematique->status == 1) --}}


                @php
                 $res = $item->id % 2;
                 $statusClass =  $res === 0 ? "vert" : "orange ";

                @endphp


        <tr class="{{ $statusClass }} paginated-item">
          <td>
           <ul>
            <li class="{{ $statusClass }}" >
              <figure>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </figure>
              <div class="content">
                <h6>{{ $item->user->information->nom }} {{ $item->user->information->prenom }}</h6>
                <a href="{{ url('/forum/detail/'.$item->slug) }}">
                <p>{{ substr($item->thematique->thematique, 0,200) }}</p>
                 </a>
              </div>
            </li>
          </ul>
            </td>
                <td class="cent"><b>{{ $item->vues->count() }}<b></td>
                <td class="cent"><b>{{ $item->comments->count() }}<b></td>
                <td class="cent"><b>{{ $item->likes->count() }}<b></td>
        </tr>

        @endforeach

    @endif
      </table>
      <br>
      </div>
      <ul class="pagination">
        <li class="page-item"> <a class="page-link" style="height: 60px;
    line-height: 60px;
    padding: 0 40px;
    border-radius: 0 !important;
    font-size: 12px;
    font-weight: 600;
    color: #212529;
    outline: none !important;" id="prevBtn" href="#">Précédent</a> </li>
        <li class="page-item"> <a class="page-link" style="height: 60px;
            line-height: 60px;
            padding: 0 40px;
            border-radius: 0 !important;
            font-size: 12px;
            font-weight: 600;
            color: #212529;
            outline: none !important;" id="nextBtn" href="#">Suivant</a> </li>
      </ul>
            <!-- Contenu de l'onglet "Forum" -->
  </div>

  <div id="profil" class="tab-content">
   <h2> Informations personnelles</h2>
    <div class="table-responsive">
        @auth
      <table class="table table-bordered">
        <thead>

        </thead>
        <tbody>
            <tr>
                <td>NOM</td>

                <td class="text-center">
                   {{ Auth::user()->information->nom }}
                </td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td class="text-center"> {{ Auth::user()->information->prenom }}</td>
            </tr>
            @if (Auth::user()->information->date_naissance)

            <tr>
                <td>Date d'anniversaire</td>

                <td class="text-center">{{ Auth::user()->information->date_naissance }}</td>

            </tr>

            @endif
            <tr>
                <td>Mail</td>

                <td class="text-center">{{ Auth::user()->email }}</td>

            </tr>

            <tr>
                <td>Numero</td>

                <td class="text-center">+226 {{ Auth::user()->information->phone }}</td>

            </tr>

            <tr>
                <td>Nombre de post</td>

                <td class="text-center">{{ auth()->user()->roles()->first()->nom}}</td>

            </tr>

            <tr>
                <td>Nombre de Commentaire</td>

                <td class="text-center">{{ auth()->user()->comment_forums->count()}}</td>

            </tr>
        </tbody>
      </table>

      @endauth
    </div>
    <!-- Contenu de l'onglet "Profil" -->
  </div>

  <div id="activites" class="tab-content">

    <div class=" layout-spacing">


      <div class="widget widget-activity-four">

          <div class="widget-heading">
              <h5 class="">Vos question</h5>
          </div>

          <div class="widget-content">

              <div class="mt-container-ra mx-auto">
                  <div class="timeline-line">

                    <table class="services-list-boxede" >
                      @auth
                      <tr>
                          <th>Question</th>
                          <th>
                            <ul>
                            <li class="titre">
                              <div class="content">
                                <h6>Vues</h6>
                              </div>
                            </li>
                            </ul>
                          </th>


                          <th>
                          <ul>
                            <li class="titre">
                              <div class="content">
                                <h6>Comments</h6>
                              </div>
                            </li>
                          </ul>
                          </th>

                          <th>
                            <ul>
                            <li class="titre">
                              <div class="content">
                                <h6>Likes</h6>
                              </div>
                            </li>
                            </ul>
                          </th>
                      </tr>


                      @if ($forums->isNotEmpty())
                      @foreach ($forums as $item)
                          {{-- @if ($item->thematique->status == 1) --}}
                      @if ($item->id_user ===  Auth::user()->id)

                          @if ($item->id % 2 === 0)

                      <tr class="vert ">
                        <td>
                         <ul>
                          <li>
                            <figure>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                              <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </figure>
                            <div class="content">
                                <h6>{{ $item->user->information->nom }} {{ $item->user->information->prenom }}</h6>
                                <p>{{ substr($item->thematique->thematique, 0,100) }}</p>
                              <div class="dte">{{ $item->created_at->format('d M, Y') }}</div>

                            </div>
                          </li>
                        </ul>
                          </td>
                            <td class="cent"><b>{{ $item->vues->count() }}<b></td>
                            <td class="cent"><b>{{ $item->comments->count() }}<b></td>
                            <td class="cent"><b>{{ $item->likes->count() }}<b></td>
                      </tr>
                      @else
                      <tr class="orange">
                          <td>
                            <ul>
                            <li class="orange" >
                            <figure>
                              <svg class="orange" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                              <path d="M15.9999 17.3333C19.6818 17.3333 22.6666 14.3486 22.6666 10.6667C22.6666 6.98477 19.6818 4 15.9999 4C12.318 4 9.33325 6.98477 9.33325 10.6667C9.33325 14.3486 12.318 17.3333 15.9999 17.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M26.6666 28C26.6666 25.1711 25.5428 22.458 23.5424 20.4576C21.542 18.4572 18.8289 17.3334 15.9999 17.3334C13.1709 17.3334 10.4578 18.4572 8.45745 20.4576C6.45706 22.458 5.33325 25.1711 5.33325 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </figure>
                            <div class="content">
                                <h6>{{ $item->user->information->nom }} {{ $item->user->information->prenom }}</h6>
                                <p>{{ substr($item->thematique->thematique, 0,50) }}</p>
                              <div class="dte">{{ $item->created_at->format('d M, Y') }}</div>
                            </div>
                            <!-- end content -->
                          </li>
                        </ul>
                        </td>
                            <td class="cent"><b>{{ $item->vues->count() }}<b></td>
                            <td class="cent"><b>{{ $item->comments->count() }}<b></td>
                            <td class="cent"><b>{{ $item->likes->count() }}<b></td>
                      </tr>
                      @endif
                      @endif

                      {{-- @endif --}}
                          @endforeach
                          @endif
                          @endauth

                      <!-- Ajoutez d'autres questions ici -->


                    </table>

                  </div>
              </div>

          </div>
      </div>

        <br> <br>


      <div class="widget widget-activity-five">

          <div class="widget-heading">
              <h5 class="">Notifications</h5>
          </div>

          <div class="widget-content">

              <div class="w-shadow-top"></div>

              <div class="mt mx-auto">
                  <div class="timeline-line">
                    @auth

                        @if($commentaires->isNotEmpty())
                        @php $deuxActualites = $commentaires->where('id_user',  Auth::user()->id)->take(2); @endphp
                            @if ($deuxActualites->isNotEmpty())
                               @foreach ($deuxActualites as $data)
                               @if (empty($data->parent_id))
                      <div class="item-timeline timeline-new">
                          <div class="t-dot">
                              <div class="t-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="258" height="200" viewBox="0 0 258 200" fill="none">
                                <path d="M185.714 71.4286C185.714 31.9643 144.152 0 92.8571 0C41.5625 0 0 31.9643 0 71.4286C0 86.7411 6.29464 100.848 16.9643 112.5C10.9821 125.982 1.11607 136.696 0.982143 136.83C0 137.857 -0.267857 139.375 0.3125 140.714C0.892857 142.054 2.14286 142.857 3.57143 142.857C19.9107 142.857 33.4375 137.366 43.1696 131.696C57.5446 138.705 74.5536 142.857 92.8571 142.857C144.152 142.857 185.714 110.893 185.714 71.4286ZM240.179 169.643C250.848 158.036 257.143 143.884 257.143 128.571C257.143 98.7054 233.259 73.125 199.42 62.4554C199.821 65.4018 200 68.3929 200 71.4286C200 118.705 151.92 157.143 92.8571 157.143C88.0357 157.143 83.3482 156.786 78.7054 156.295C92.7679 181.964 125.804 200 164.286 200C182.589 200 199.598 195.893 213.973 188.839C223.705 194.509 237.232 200 253.571 200C255 200 256.295 199.152 256.83 197.857C257.411 196.563 257.143 195.045 256.161 193.973C256.027 193.839 246.161 183.17 240.179 169.643Z" fill="white"/>
                                </svg>
                              </div>
                          </div>
                          <div class="t-content">
                              <div class="t-uppercontent">
                                @if ($data->id_user == auth()->user()->id)

                                <h5><a href="{{ url('forum/detail/'.$data->forum->slug) }}"><span>[Vous aviez commenté votre question]</span> <span>"{{ substr($data->forum->thematique->thematique, 0,50) }}"</span></a> </h5>

                                @else
                                  <h5><a href="{{ url('forum/detail/'.$data->forum->slug) }}"><span>[{{ $data->user->information->nom }} {{ $data->user->information->prenom }}]</span> : a repondu a votre commentaire <span>"{{ substr($data->forum->thematique->thematique, 0,50) }}"</span></a> </h5>

                                  @endif
                                </div>
                              <p>{{ $data->created_at->format('d M, Y') }}</p>
                          </div>
                      </div>
                      @endif
                      @endforeach
                      @endif
                      @endif



                    @if($commentaires->isNotEmpty())
                        @php $deuxActualites = $commentaires->where('id_user',  Auth::user()->id)->take(2); @endphp
                            @if ($deuxActualites->isNotEmpty())
                               @foreach ($deuxActualites as $data)
                               @if ($data->parent_id)
                      <div class="item-timeline timeline-new">
                          <div class="t-dot">
                              <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="31" height="24" viewBox="0 0 31 24" fill="none">
                                <g clip-path="url(#clip0_529_8)">
                                  <path d="M12.0001 2.182H11.8951C10.1801 2.182 8.54107 2.507 7.03607 3.1L7.12607 3.069C5.75294 3.56912 4.51906 4.38988 3.52707 5.463L3.52107 5.469C2.68227 6.34595 2.20456 7.50667 2.18307 8.72V8.725C2.19383 9.70034 2.51309 10.6472 3.09507 11.43L3.08607 11.418C3.75032 12.3313 4.60285 13.0914 5.58607 13.647L5.62507 13.667L7.27907 14.625L6.68207 16.057C7.06807 15.8297 7.4204 15.608 7.73907 15.392L8.48907 14.864L9.39207 15.034C10.1751 15.184 11.0761 15.271 11.9981 15.274H12.1051C13.8201 15.274 15.4591 14.949 16.9641 14.356L16.8741 14.387C18.2472 13.8869 19.4811 13.0661 20.4731 11.993L20.4791 11.987C21.3061 11.151 21.8171 10.001 21.8171 8.731C21.8171 7.461 21.3061 6.311 20.4791 5.475C19.5023 4.41401 18.2887 3.59885 16.9371 3.096L16.8741 3.075C15.3478 2.47833 13.7228 2.1747 12.0841 2.18H11.9941H11.9991L12.0001 2.182ZM12.0001 -4.88292e-06L12.1511 -0.00100488C14.2701 -0.00100488 16.2891 0.427995 18.1251 1.205L18.0241 1.167C19.7185 1.83909 21.217 2.92601 22.3821 4.328L22.3961 4.346C23.3921 5.52 23.9981 7.052 23.9981 8.726C23.9981 10.4 23.3921 11.933 22.3881 13.116L22.3961 13.106C21.247 14.4973 19.7696 15.5806 18.0971 16.258L18.0241 16.284C16.2881 17.023 14.2681 17.453 12.1491 17.453L11.9921 17.452H12.0001C10.9581 17.4496 9.91856 17.3529 8.89407 17.163L9.00007 17.179C7.59714 18.1739 6.02485 18.9051 4.36007 19.337L4.26007 19.359C3.87107 19.459 3.37407 19.554 2.86907 19.623L2.79507 19.631H2.74407C2.6148 19.6294 2.49047 19.5811 2.39407 19.495C2.28668 19.4053 2.21676 19.2787 2.19807 19.14V19.137C2.1866 19.1025 2.18086 19.0664 2.18107 19.03V19.024C2.18107 18.986 2.18407 18.948 2.19007 18.911L2.18907 18.915C2.19557 18.8788 2.20737 18.8438 2.22407 18.811L2.22307 18.813L2.26507 18.727L2.32507 18.633L2.39307 18.547L2.47307 18.461L2.54107 18.381C2.5984 18.313 2.72907 18.171 2.93307 17.955C3.13707 17.739 3.28474 17.5713 3.37607 17.452C3.4674 17.3327 3.59507 17.168 3.75907 16.958C3.91107 16.767 4.05207 16.552 4.17407 16.325L4.18507 16.302C4.3044 16.0747 4.42107 15.8247 4.53507 15.552C3.22444 14.8169 2.09566 13.7968 1.23207 12.567L1.21107 12.535C0.424562 11.4195 0.000683494 10.0889 -0.00292969 8.724V8.722C0.00187424 7.11493 0.571399 5.56068 1.60607 4.331L1.59707 4.342C2.74612 2.95067 4.22358 1.86741 5.89607 1.19L5.96907 1.164C7.70507 0.424995 9.72507 -0.00500488 11.8441 -0.00500488L12.0051 -0.00400488H11.9971L12.0001 -4.88292e-06ZM26.0101 19.925C26.1234 20.1977 26.2401 20.4477 26.3601 20.675C26.4931 20.925 26.6341 21.14 26.7931 21.34L26.7861 21.331C26.9507 21.541 27.0784 21.7057 27.1691 21.825C27.2597 21.9443 27.4074 22.112 27.6121 22.328C27.8161 22.5413 27.9467 22.6833 28.0041 22.754C28.0154 22.7653 28.0381 22.792 28.0721 22.834C28.1061 22.876 28.1327 22.9047 28.1521 22.92C28.176 22.9461 28.1981 22.9738 28.2181 23.003L28.2201 23.005C28.2412 23.0338 28.2606 23.0638 28.2781 23.095L28.2801 23.099L28.3221 23.185L28.3561 23.287L28.3651 23.397L28.3481 23.507C28.321 23.6537 28.2431 23.7861 28.1281 23.881L28.1271 23.882C28.0752 23.9258 28.0152 23.9588 27.9505 23.9793C27.8858 23.9997 27.8177 24.0071 27.7501 24.001H27.7521C25.4962 23.7091 23.3496 22.8557 21.5091 21.519L21.5481 21.546C20.6471 21.717 19.6101 21.816 18.5501 21.819H18.5481C15.6795 21.8908 12.856 21.0951 10.4471 19.536L10.5031 19.57C11.1624 19.6153 11.6624 19.638 12.0031 19.638H12.0701C13.9251 19.638 15.7141 19.358 17.3971 18.837L17.2691 18.871C18.8986 18.3895 20.4349 17.6359 21.8131 16.642L21.7691 16.672C23.0887 15.7266 24.193 14.5123 25.0091 13.109L25.0381 13.054C25.7908 11.7365 26.1846 10.2444 26.1801 8.727C26.1801 7.801 26.0371 6.909 25.7711 6.072L25.7881 6.134C27.1536 6.85979 28.3358 7.88711 29.2451 9.13799L29.2651 9.167C30.0991 10.3039 30.547 11.678 30.5431 13.088C30.5453 14.4661 30.1175 15.8107 29.3191 16.934L29.3331 16.913C28.4764 18.1381 27.3576 19.1571 26.0581 19.896L26.0081 19.922L26.0101 19.925Z" fill="white"/>
                                </g>
                                <defs>
                                  <clipPath id="clip0_529_8">
                                    <rect width="31" height="24" fill="white"/>
                                  </clipPath>
                                </defs>
                              </svg></div>
                          </div>
                          <div class="t-content">
                              <div class="t-uppercontent">
                                <h5><a href="javascript:void(0);">Vous avez repondu au commentaire de : <span>[{{ $data->user->information->nom }} {{ $data->user->information->prenom }}]</span>  <span>"{{ substr($data->forum->thematique->thematique, 0,50) }}"</span></a> </h5>
                              </div>
                              <p>{{ $data->created_at->format('d M, Y') }}</p>

                          </div>
                      </div>
                      @endif
                      @endforeach
                      @endif
                      @endif

                      @if($commentaires->isNotEmpty())
                      @php
                      $forum = $forums->where('id_user', Auth::user()->id)->take(3)
                    //   $deuxActualites = $commentaires->where('id_lier',  Auth::user()->id)->take(2);
                      @endphp
                          @if ($forum->isNotEmpty())
                             @foreach ($forum as $data)
                      @php
                           $deuxActualites = $commentaires->where('id_lier',  $data->id)->take(2);
                      @endphp
                            @if ($deuxActualites->isNotEmpty())
                            @foreach ($deuxActualites as $data)
                      <div class="item-timeline timeline-new">
                          <div class="t-dot">
                              <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="536" height="416" viewBox="0 0 536 416" fill="none">
                                <path d="M492 354.2C519.5 327.1 536 293.1 536 256C536 176 459.5 109.9 359.8 98.1C328.3 40.5 254.3 0 168 0C53.0999 0 -40.0001 71.6 -40.0001 160C-40.0001 197 -23.5001 231 3.9999 258.2C-11.3001 288.9 -33.3001 312.7 -33.7001 313.1C-40.0001 319.8 -41.8001 329.6 -38.1001 338.1C-34.5001 346.6 -26.1001 352.1 -16.9001 352.1C36.5999 352.1 79.7999 331.9 108.3 313.3C117.5 315.4 127 317 136.7 318.2C168.1 375.6 241.8 416 328 416C348.8 416 368.8 413.6 387.8 409.2C416.3 427.7 459.4 448 513 448C522.2 448 530.5 442.5 534.2 434C537.8 425.5 536.1 415.7 529.8 409C529.4 408.7 507.3 384.9 492 354.2ZM99.1999 261.9L82.0999 273C67.9999 282.1 53.5999 289.3 38.9999 294.4C41.6999 289.7 44.3999 284.7 46.9999 279.6L62.4999 248.5L37.6999 224C24.1999 210.6 7.9999 188.7 7.9999 160C7.9999 99.3 81.2999 48 168 48C254.7 48 328 99.3 328 160C328 220.7 254.7 272 168 272C151.5 272 135 270.1 119 266.4L99.1999 261.9ZM458.3 320L433.6 344.4L449.1 375.5C451.7 380.6 454.4 385.6 457.1 390.3C442.5 385.2 428.1 378 414 368.9L396.9 357.8L377 362.4C361 366.1 344.5 368 328 368C274 368 225.8 347.9 196.7 318.3C298 307.5 376 240.9 376 160C376 156.6 375.6 153.3 375.3 150C439.7 164.5 488 206.8 488 256C488 284.7 471.8 306.6 458.3 320Z" fill="white"/>
                              </svg></div>
                          </div>
                          <div class="t-content">
                              <div class="t-uppercontent">
                                <h5><a href="javascript:void(0);"> <span>[{{ $data->user->information->nom }} {{ $data->user->information->prenom }}]</span> :  a commenté a votre question  <span>"{{ substr($data->forum->thematique->thematique, 0,50) }}"</span></a> </h5>
                              </div>
                              <p>{{ $data->created_at->format('d M, Y') }}</p>

                          </div>
                      </div>
                      @endforeach
                      @endif
                      @endforeach
                      @endif
                      @endif


                      @if($forums->isNotEmpty())
                      @php $forums = $forums->where('id_user',  Auth::user()->id)->take(3); @endphp
                          @if ($forums->isNotEmpty())
                             @foreach ($forums as $data)
                      <div class="item-timeline timeline-new">
                          <div class="t-dot">
                              <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="353" height="512" viewBox="0 0 353 512" fill="none">
                                <path d="M177.021 0C97.2019 0 45.5029 32.703 4.91394 91.026C-2.44906 101.606 -0.179059 116.112 10.0919 123.9L53.2299 156.609C63.6029 164.474 78.3619 162.635 86.4829 152.461C111.532 121.08 130.113 103.012 169.24 103.012C200.004 103.012 238.056 122.811 238.056 152.643C238.056 175.195 219.439 186.777 189.063 203.807C153.64 223.667 106.764 248.383 106.764 310.212V320C106.764 333.255 117.509 344 130.764 344H203.235C216.49 344 227.235 333.255 227.235 320V314.227C227.235 271.367 352.503 269.582 352.503 153.6C352.504 66.256 261.902 0 177.021 0ZM167 373.459C128.804 373.459 97.7289 404.534 97.7289 442.73C97.7289 480.925 128.804 512 167 512C205.196 512 236.271 480.925 236.271 442.729C236.271 404.533 205.196 373.459 167 373.459Z" fill="white"/>
                              </svg></div>
                          </div>
                          <div class="t-content">
                              <div class="t-uppercontent">
                                <h5><a href="javascript:void(0);">Vous avez poser une question  <span>"{{ $data->thematique->thematique }}"</span></a> </h5>
                              </div>
                              <p>{{ $data->created_at->format('d M, Y') }}</p>
                          </div>
                      </div>
                      @endforeach
                      @endif
                      @endif

                      @if($commentaires->isNotEmpty())
                        @php $deuxActualites = $commentaires->where('id_user',  Auth::user()->id)->take(4); @endphp
                            @if ($deuxActualites->isNotEmpty())
                               @foreach ($deuxActualites as $data)
                               @if (empty($data->parent_id))
                      <div class="item-timeline timeline-new">
                          <div class="t-dot">
                              <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M14.7701 5.87C14.9998 6.00037 15.2716 6.03464 15.5264 5.96532C15.7812 5.896 15.9982 5.72873 16.1301 5.5C16.2393 5.30736 16.4093 5.15639 16.6135 5.07078C16.8177 4.98517 17.0446 4.96975 17.2585 5.02694C17.4724 5.08414 17.6613 5.21071 17.7955 5.38681C17.9297 5.56291 18.0017 5.77858 18.0001 6C18.0001 6.26522 17.8948 6.51957 17.7072 6.70711C17.5197 6.89464 17.2654 7 17.0001 7C16.7349 7 16.4806 7.10536 16.293 7.29289C16.1055 7.48043 16.0001 7.73478 16.0001 8C16.0001 8.26522 16.1055 8.51957 16.293 8.70711C16.4806 8.89464 16.7349 9 17.0001 9C17.5267 8.99966 18.0438 8.86075 18.4997 8.59723C18.9555 8.33371 19.334 7.95486 19.597 7.49875C19.8601 7.04264 19.9984 6.52533 19.9982 5.9988C19.998 5.47227 19.8592 4.95507 19.5958 4.49917C19.3324 4.04326 18.9536 3.66472 18.4976 3.40156C18.0415 3.13841 17.5243 2.99992 16.9977 3C16.4712 3.00008 15.954 3.13874 15.498 3.40204C15.042 3.66534 14.6634 4.04401 14.4001 4.5C14.334 4.61413 14.2911 4.74022 14.274 4.871C14.2568 5.00178 14.2656 5.13466 14.3 5.262C14.3344 5.38934 14.3937 5.50862 14.4743 5.61297C14.555 5.71732 14.6556 5.80467 14.7701 5.87ZM19.0701 13C18.8076 12.9659 18.5423 13.0373 18.3324 13.1985C18.1225 13.3597 17.985 13.5976 17.9501 13.86C17.7403 15.5552 16.9179 17.1151 15.6378 18.246C14.3577 19.3769 12.7082 20.0007 11.0001 20H5.41014L6.06014 19.35C6.24639 19.1626 6.35093 18.9092 6.35093 18.645C6.35093 18.3808 6.24639 18.1274 6.06014 17.94C5.08509 16.9611 4.42153 15.7156 4.15303 14.3603C3.88454 13.005 4.02313 11.6005 4.55134 10.3238C5.07955 9.04714 5.97376 7.95532 7.12133 7.18589C8.2689 6.41646 9.6185 6.00384 11.0001 6C11.2654 6 11.5197 5.89464 11.7072 5.70711C11.8948 5.51957 12.0001 5.26522 12.0001 5C12.0001 4.73478 11.8948 4.48043 11.7072 4.29289C11.5197 4.10536 11.2654 4 11.0001 4C9.30937 4.00705 7.65478 4.49024 6.22594 5.39419C4.79709 6.29815 3.65177 7.58632 2.9212 9.11112C2.19064 10.6359 1.90436 12.3357 2.09519 14.0157C2.28601 15.6956 2.9462 17.2879 4.00014 18.61L2.29014 20.29C2.15138 20.4306 2.05739 20.6092 2.02001 20.8032C1.98264 20.9972 2.00356 21.1979 2.08014 21.38C2.15516 21.5626 2.28256 21.7189 2.44628 21.8293C2.61 21.9396 2.80271 21.999 3.00014 22H11.0001C13.1916 22.0003 15.3079 21.201 16.952 19.7521C18.596 18.3031 19.655 16.3041 19.9301 14.13C19.9484 13.9993 19.9406 13.8662 19.9072 13.7385C19.8738 13.6107 19.8155 13.4909 19.7355 13.3858C19.6556 13.2808 19.5556 13.1926 19.4414 13.1264C19.3272 13.0602 19.201 13.0172 19.0701 13ZM17.3801 10.07C17.1981 9.98945 16.9961 9.96508 16.8001 10L16.6201 10.06L16.4401 10.15L16.2901 10.28C16.2002 10.3721 16.1289 10.4808 16.0801 10.6C16.021 10.7247 15.9935 10.8621 16.0001 11C15.9972 11.1334 16.021 11.266 16.0701 11.39C16.1219 11.51 16.1966 11.6187 16.2901 11.71C16.3836 11.8027 16.4944 11.876 16.6162 11.9258C16.7381 11.9755 16.8685 12.0008 17.0001 12C17.2654 12 17.5197 11.8946 17.7072 11.7071C17.8948 11.5196 18.0001 11.2652 18.0001 11C18.0035 10.8688 17.9761 10.7387 17.9201 10.62C17.8127 10.3797 17.6204 10.1875 17.3801 10.08V10.07Z" fill="white"/>
                              </svg></div>
                          </div>
                          <div class="t-content">
                              <div class="t-uppercontent">
                                <h5><a href="javascript:void(0);">Vous avez commenter la question de : <span>[{{ $data->forum->user->information->nom }} {{ $data->forum->user->information->prenom }}]</span>   <span>"{{ $data->forum->thematique->thematique }}"</span></a> </h5>
                              </div>
                              <p>{{ $data->created_at->format('d M, Y') }}</p>
                          </div>
                      </div>
                      @endif
                      @endforeach
                      @endif
                      @endif
                      @endauth
                  </div>
              </div>

              <div class="w-shadow-bottom"></div>
          </div>
      </div>
    </div>





    <!-- Contenu de l'onglet "Activités" -->
  </div>

  <div id="poser-une-question" class="tab-content">
    <div class="blog-post">

      <div class=" col-lg-12 d-flex flex-column self-center mx-auto">
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <form  method="POST" action="{{ route('front.forum.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">

                        <h3>Poser une question</h3>

                    </div>

                        @csrf
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Votre Question</label>
                            <textarea style="width: 100%; height: 200px;" name="thematique" required placeholder="Entrez votre question..."></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">Tags</label>
                              <input type="text" class="form-control" name="tags[]" id="tag-input" placeholder="Entrée des tags">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">Categorie</label>
                            <input name='category[]' class='form-control' placeholder="Sélectionner la categorie" />
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="mb-4">
                            <button type="submit" class="btn btn-warning w-100" style="background: #ff9a40; f">Poster</button>
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

      <div class="col-lg-4">
        <aside class="sidebar">
      <div class="widget">
        <h6 class="widget-title">RECHERCHER</h6>
        <form method="POST" action="{{ route('front.forum.search') }}">
            @csrf
            <input type="search" required name="search" placeholder="Type here to search">
            <input type="submit" value="Search">
        </form>
        </div>
        <!-- end widget -->
        <div class="widget">
        <h6 class="widget-title">CATEGORIES</h6>
        <ul class="categories">
            @if ($categori->isNotEmpty())
                @foreach ($categori as $category)

            <li><a href="{{ url('forum/recherche_par_category/'.$category->id) }}">{{ $category->nom }}</a></li>

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
<script src="{{ asset('front/js/modules-widgets.js') }}"></script>



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
const itemsPerPage = 8;
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
 // Fonction pour afficher la page "Forum" par défaut
function showDefaultTab() {
  document.getElementById("forum").classList.add("active");
  document.querySelector(".tablink[data-tab='forum']").classList.add("active");
}

// Fonction pour gérer le changement d'onglet lors du clic
function openTab(tabName) {
  var i, tabContent, tabLinks;

  // Cacher tous les contenus d'onglet
  tabContent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].classList.remove("active");
  }

  // Désactiver tous les liens d'onglet
  tabLinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tabLinks.length; i++) {
    tabLinks[i].classList.remove("active");
  }

  // Afficher le contenu de l'onglet sélectionné et activer le lien d'onglet correspondant
  document.getElementById(tabName).classList.add("active");
  event.currentTarget.classList.add("active");
}

// Afficher la page "Forum" par défaut au chargement de la page
document.addEventListener("DOMContentLoaded", showDefaultTab);

</script>


<!-- Inclure la bibliothèque Tagify (JavaScript) -->
<script src="{{ asset('front/js/tagify.min.js') }}"></script>

 <script>
  // Initialiser Tagify sur l'élément de champ de texte
  var input = document.getElementById('tag-input');
  new Tagify(input);

</script>

<script>
  // Sélectionnez l'élément DOM pour le champ de saisie de texte
  var input = document.querySelector('input[name="category[]"]');

  // Initialiser Tagify sur l'élément de champ de saisie de texte
  var tagify = new Tagify(input, {
                whitelist: {!! json_encode($categories) !!},
                userInput: false
            });

  // Obtenir une référence à la liste déroulante de Tagify
  var tagifyDropdown = tagify.DOM.dropdown;

  // Écoutez l'événement lorsque l'utilisateur sélectionne une option dans la liste déroulante de Tagify
  tagifyDropdown.addEventListener('click', function(event) {
    if (event.target.tagName === 'LI') {
      // Récupérer le texte de l'option sélectionnée
      var selectedOptionText = event.target.textContent;

      // Ajouter l'option sélectionnée comme un tag
      tagify.addTags([selectedOptionText]);

      // Supprimer l'option sélectionnée de la liste déroulante de Tagify
      tagify.settings.whitelist = tagify.settings.whitelist.filter(item => item !== selectedOptionText);
    }
  });
</script>










</body>
</html>
