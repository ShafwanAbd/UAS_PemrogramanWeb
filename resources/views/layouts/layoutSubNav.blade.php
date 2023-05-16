@extends ('layouts.layoutMain')

@section('content')
    <div class="container_subNav">
        <div class="button_nav"></div>
        <div class="isi_nav">
            <h1>Daftar Data</h1>
            <a href="{{ url('zakatFitrah/dataMuzakki') }}"><h3>Data Muzakki</h3></a>
            <a href="{{ url('zakatFitrah/dataKategoriMustahik') }}"><h3>Data Kategori Mustahik</h3></a>
            <a href="{{ url('zakatFitrah/pengumpulanZakat') }}"><h3>Pengumpulan Zakat Fitrah</h3></a>
            <a href="{{ url('zakatFitrah/distribusiZakat') }}"><h3>Distribusi Zakat Fitrah Warga</h3></a>
            <a href="{{ url('zakatFitrah/distribusiLainnya') }}"><h3>Distribusi Zakat Fitrah Lainnya</h3></a>
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