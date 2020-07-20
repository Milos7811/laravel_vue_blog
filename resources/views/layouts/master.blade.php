<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="940603961668-4idosoka5hqd6hohtmdp3vq20dipif3u.apps.googleusercontent.com">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link type="text/css" rel="stylesheet" href="{{ mix('app/app.scss') }}"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="container">



                                <ul class="nav justify-content-center  btn-group mb-5 fix" >
                                    <li class="nav-item btn btn-secondary">
                                        <a  class="nav-link active text-white" href="/"> Home</a>
                                    </li>
                                    <li class="nav-item btn btn-secondary">
                                        <a  class="nav-link active text-white" href="/posts"> Posts</a>
                                    </li>
                                    <li class="nav-item btn btn-secondary">
                                        <a  class="nav-link active text-white" href="/about"> About</a>
                                    </li>
                                     <li class="nav-item btn btn-secondary">
                                        <a  class="nav-link active text-white" href="/#"> Chat</a>
                                    </li>
                                </ul>

    @if(session('verified'))
    <p  class="d-block p-2 bg-success text-white">You've successfully verified your email!</p>
    @endif

    @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
    <article  class="d-block p-2 bg-danger text-white">  Please verify your email address. An email containing verification instructions was sent to {{ Auth::user()->email }} or <form class="d-inline" tag="p"  method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
       </article>
    @endif

        @if(Auth::check() && Auth::user()->isAdmin() == "true")
        <a class="btn btn-dark float-left" href="/admin">Admin</a>
        @endif


        @guest
        <div class="login-reigster-container float-right">
            <div class="float-right">
            <a class="btn btn-success" href="{{route('login')}}">Prihlasit</a>
            <a class="btn btn-success" href="{{route('register')}}">Registracia</a>
            </div>

            <ul class="social-icons float-right d-block">
                <a tag="li" class="text-dark"  href="/auth/facebook"> <i class=" fab fa-facebook"></i></a>
                <a tag="li" class="text-dark" href="/auth/github"> <i class=" fab fa-github"></i></a>
                <a tag="li" class="text-dark" href="/auth/google"> <i class=" fab fa-google"></i></a>
            </ul>
            </div>
            @endguest

        @auth
            <nav class="float-right mb-4">@include('layouts.usernavigation')  </nav>
        @endauth

        <main class="content" >@yield('content')
            </main>
            <flash-message text='{{ session('flash') }}'></flash-message>

                <image-slider />
    </div>
</body>
</html>
