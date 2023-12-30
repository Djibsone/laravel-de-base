<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mon blog')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>
<body>

  @php
    $routeName = request()->route()->getName()
  @endphp

  <nav class="navbar navbar-expand-lg navbar-light bg-primary mb-3">
    <a class="navbar-brand text-white" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        @auth
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a @class(['nav-link text-white', 'active' => str_starts_with($routeName, 'blog.')], 'text-white') href="{{ route('blog.index') }}">Blog</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-white" href="#">Link</a>
              </li>
          </ul>
          <div class="ml-auto">
              {{-- @auth --}}
                  <div class="d-flex align-items-center">
                      <span class="text-white rounded-pill p-2 mx-1 bg-secondary">{{ Auth::user()->name }}</span>
                      <form class="nav-item ml-2" action="{{ route('auth.logout') }}" method="post">
                          @method('delete')
                          @csrf
                          <button class="btn btn-light text-dark">Se déconnecter</button>
                      </form>
                  </div>
              {{-- @endauth --}}
              {{-- @guest
                @if (str_starts_with($routeName, 'auth.login'))
                  <a class="text-white" href="{{ route('auth.register') }}">S'inscrire</a>
                @else
                  <a class="text-white" href="{{ route('auth.login') }}">Se connecter</a>
                @endif
              @endguest --}}
          </div>
        @endauth
    </div>
  </nav>
  
  <div class="container">

    @if (session('message'))

      <div class="alert alert-{{ session('message.type') }}">
          {{ session('message.text') }}
      </div>

      @php session()->forget('message'); @endphp

    @endif

    @yield('content')

  </div>

  <script src="{{ asset('jquery.min.js') }}"></script>
  <script src="{{ asset('bootstrap.min.js') }}"></script>
</body>
</html>