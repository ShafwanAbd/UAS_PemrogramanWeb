<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JQuery -->
    <script src="{{ asset('js/jquery-3.6.4.min.js')}}"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <!-- Bootstrap External -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Private External -->
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- printThis() --> 
    <script src="{{ asset('js/printThis.js') }}"></script>

    @yield('head')

    <title>Judul</title>
</head>
<body>
    <nav class="" id="navbar">
        <div class="container_nav">
            <h4 class="title">Fitrah.ly</h4>
            <div class="container_inner_nav">
                <a href="{{ url('beranda') }}"><h4>Beranda</h4></a>
                <a href="{{ url('zakatFitrah/dataMuzakki') }}"><h4>Zakat Fitrah</h4></a>
                <a href="{{ url('laporan/distribusiWarga') }}"><h4>Laporan</h4></a>
                @guest
                    @if (Route::has('login'))
                            <a href="{{ route('login') }}"><h4>{{ __('Login') }}</h4></a>
                    @endif 
                @else
                    <li class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <h4>{{ Auth::user()->uname }}</h4>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="{{ asset('js/js.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>