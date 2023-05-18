@extends ('layouts.layoutMain')

@section('content')
    <div class="container_subNav">
        <div class="button_nav"></div>
        <div class="isi_nav">
            <h1>Daftar Laporan</h1>
            <a href="{{ url('laporan/ringkasan') }}"><h3>Ringkasan</h3></a>
            <a href="{{ url('laporan/distribusiWarga') }}"><h3>Distribusi Ke Mustahik Warga</h3></a>
            <a href="{{ url('laporan/distribusiLainnya') }}"><h3>Distribusi Ke Mustahik Lainnya</h3></a> 
        </div>
    </div>

    <script>
        let container_subNav = document.querySelector('.container_subNav');
        let button_nav = document.querySelector('.button_nav');
        let isi_nav = document.querySelector('.isi_nav');

        button_nav.onclick = function() {
            button_nav.classList.toggle('active');
            isi_nav.classList.toggle('active');
            container_subNav.classList.toggle('active');
        }
    </script>
@yield('content2')
@endsection