<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/apps/chat.scss'])
        @vite(['resources/scss/dark/assets/apps/chat.scss'])        
        <!--  END CUSTOM STYLE FILE  -->
        
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="chat-section layout-top-spacing">
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="chat-system">
                    <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                    <div class="user-list-box">
                        <div class="search">
                            <input type="text" class="form-control" placeholder="Rechercher utilisateurs" />
                        </div>
                        <div class="people">

                            <div class="person" data-chat="person6">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-4.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Nia Hillyer">Nia Hillyer</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">How do you do?</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person1">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-3.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Sean Freeman">Sean Freeman</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">I was wondering...</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person2">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-11.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Alma Clarke">Alma Clarke</span>
                                            <span class="user-meta-time">1:44 PM</span>
                                        </div>
                                        <span class="preview">I've forgotten how it felt before</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person3">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-23.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Alan Green">Alan Green</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">But we’re probably gonna need a new carpet.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person4">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-7.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Shaun Park">Shaun Park</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">It’s not that bad...</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person5">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-15.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Roxanne">Roxanne</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person7">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-32.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Ernest Reeves">Ernest Reeves</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person8">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-33.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Laurie Fox">Laurie Fox</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person9">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-21.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Xavier">Xavier</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person10">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-12.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Susan Phillips">Susan Phillips</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person" data-chat="person11">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-26.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Dale Butler">Dale Butler</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>

                            <div class="person border-none" data-chat="person12">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{Vite::asset('resources/images/profile-20.jpeg')}}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name" data-name="Grace Roberts">Grace Roberts</span>
                                            <span class="user-meta-time">2:09 PM</span>
                                        </div>
                                        <span class="preview">Wasup for the third time like is you bling bitch</span>
                                    </div>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                    <div class="chat-box" style="background-image: url({{Vite::asset('resources/images/bg.png')}});">

                        <div class="chat-not-selected">
                            <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Click User To Chat</p>
                        </div>

                        <div class="chat-box-inner">
                            <div class="chat-meta-user">
                                <div class="current-chat-user-name"><span><img src="{{Vite::asset('resources/images/90x90.jpg')}}" alt="dynamic-image"><span class="name"></span></span></div>

                                
                            </div>
                            <div class="chat-conversation-box">
                                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                    <div class="chat" data-chat="person1">
                                        <div class="conversation-start">
                                            <span>Today, 6:48 AM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hello,
                                        </div>
                                        <div class="bubble you">
                                            It's me.
                                        </div>
                                        <div class="bubble you">
                                            I have a question regarding project.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person2">
                                        <div class="conversation-start">
                                            <span>Today, 5:38 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hello!
                                        </div>
                                        <div class="bubble me">
                                            Hey!
                                        </div>
                                        <div class="bubble me">
                                            How was your day so far.
                                        </div>
                                        <div class="bubble you">
                                            It was a bit dramatic.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person3">
                                        <div class="conversation-start">
                                            <span>Today, 3:38 AM</span>
                                        </div>
                                        <div class="bubble me">
                                            Hey Buddy.
                                        </div>
                                        <div class="bubble me">
                                            What's up
                                        </div>
                                        <div class="bubble you">
                                            I am sick
                                        </div>
                                        <div class="bubble you">
                                            Not comming to office today.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person4">
                                        <div class="conversation-start">
                                            <span>Yesterday, 4:20 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi, collect your check
                                        </div>
                                        <div class="bubble me">
                                            Ok, I will be there in 10 mins
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person5">
                                        <div class="conversation-start">
                                            <span>Today, 6:28 AM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi
                                        </div>
                                        <div class="bubble you">
                                            Uploaded files to server.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person6">
                                        <div class="conversation-start">
                                            <span>Monday, 1:27 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi, I am back from vacation
                                        </div>
                                        <div class="bubble you">
                                            How are you?
                                        </div>
                                        <div class="bubble me">
                                            Welcom Back
                                        </div>
                                        <div class="bubble me">
                                            I am all well
                                        </div>
                                        <div class="bubble you">
                                            Coffee?
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person7">
                                    </div>
                                    <div class="chat" data-chat="person8">
                                    </div>
                                    <div class="chat" data-chat="person9">
                                    </div>
                                    <div class="chat" data-chat="person10">
                                    </div>
                                    <div class="chat" data-chat="person11">
                                    </div>
                                    <div class="chat" data-chat="person12">
                                    </div>
                                </div>
                            </div>
                            <div class="chat-footer">
                                <div class="chat-input">
                                    <form class="chat-form" action="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                        <input type="text" class="mail-write-box form-control" placeholder="Message"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/apps/chat.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>