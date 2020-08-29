<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('strings.maktoobah') | @yield('title', trans('strings.home'))</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script data-ad-client="ca-pub-2662394717663527" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light navbar-expand-lg border-bottom">
        <div class="container">
            @guest
                <a class="navbar-brand" href="/"><h1>@lang('strings.' . config('app.name'))</h1></a>
            @else
                <a class="navbar-brand" href="{{ route('home') }}"><h1>@lang('strings.' . config('app.name'))</h1></a>
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('strings.login')</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('strings.register')</a>
                            </li>
                        @endif
                    @else
                        <notifications-component user="{{ Auth::user()->id }}"></notifications-component>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('home') }}" class="dropdown-item">@lang('strings.home')</a>
                                <a class="dropdown-item" href="{{ route('chats.index') }}">@lang('strings.chats')</a>
                                <a href="{{ route('favorites.index') }}"
                                   class="dropdown-item">@lang('strings.favorites')</a>
                                <a class="dropdown-item" href="{{ route('users.settings') }}">@lang('strings.settings')</a>
                                <a href="{{route('contacts.create')}}" class="dropdown-item">@lang('strings.contact_us')</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('strings.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center">@lang('strings.welcome')</h1>
    <p class="text-muted text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque dolor dolorum eum excepturi
        facere ipsa laboriosam libero nemo, optio placeat sed tempora unde? Asperiores doloremque, eos esse excepturi
        nulla quae!</p>
    <ul class="list-unstyled">
        @foreach($users as $user)
        <li class="media my-2">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTgsaRe2zqH_BBicvUorUseeTaE4kxPL2FmOQ&usqp=CAU" class="mr-3 img-thumbnail img-thumb" alt="...">
            <div class="media-body bg-white p-2">
                <h5 class="mt-0 mb-1">{{ $user->name }}</h5>
                {{ $user->details }}
            </div>
        </li>
        @endforeach
    </ul>
</div>
</body>
</html>
