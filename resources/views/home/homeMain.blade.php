@extends('layouts.layoutMain')

@section('content')

<div class="container_main">

    <div class="section_one">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="isi_one" id="isi_one_animate">
                <h1>وَاَقِيْمُوا الصَّلٰوةَ وَاٰتُوا الزَّكٰوةَ وَارْكَعُوْا مَعَ الرَّاكِعِيْنَ</h1>
                <h3>“Dan laksanakanlah sholat, tunaikanlah zakat, dan rukuklah beserta orang yang rukuk.”</h3>
                <h4>QS. Al Baqarah: 43</h4>
            </div>
 
            <script>
                // get the element you want to animate
                const targetElement3 = document.querySelector('#isi_one_animate');

                // create a new intersection observer
                const observer3 = new IntersectionObserver(entries => {
                    // loop through the entries that intersect the target element
                    entries.forEach(entry => {
                        // if the target element is intersecting and the entry is visible
                        if (entry.isIntersecting && entry.intersectionRatio > 0) {
                        // add a CSS class to the target element to start the animation
                        targetElement3.classList.add('animate__animated');
                        targetElement3.classList.add('animate__fadeIn');
                        } 
                    });
                });

                // observe the target element
                observer3.observe(targetElement3); 
            </script>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('/images/beranda/img1.png') }}" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('/images/beranda/img2.png') }}" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('/images/beranda/img3.png') }}" class="d-block" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="section_two">
        <div class="isi_one">
            <div class="inner_one">
                <div class="container_img">
                    <img src="{{ asset('images/beranda/img4.jpg') }}">
                </div>
            </div>
            <div class="inner_two" id="inner_two_id">
                <div class="inner_isi_one">
                    <h1>Apa itu Zakat Fitrah?</h1>
                </div>
                <div class="inner_isi_two">
                    <p>Zakat Fitrah yaitu harta yang wajib dikeluarkan oleh setiap muslim, baik dewasa maupun anak-anak pada bulan Ramadhan untuk menyucikan diri dan diberikan kepada mustahik zakat.</p>
                    <a href="{{ url('/zakatFitrah/dataMuzakki') }}">Bayar</a>
                </div>
            </div>   

            <script>
                // get the element you want to animate
                const targetElement = document.querySelector('#inner_two_id');
                const targetElementpre = document.querySelector('.inner_one');

                // create a new intersection observer
                const observer = new IntersectionObserver(entries => {
                    // loop through the entries that intersect the target element
                    entries.forEach(entry => {
                        // if the target element is intersecting and the entry is visible
                        if (entry.isIntersecting && entry.intersectionRatio > 0) {
                        // add a CSS class to the target element to start the animation
                        targetElement.classList.add('animate__animated');
                        targetElement.classList.add('animate__fadeInRight');

                        targetElementpre.classList.add('animate__animated');
                        targetElementpre.classList.add('animate__fadeInLeft');
                        } 
                    });
                }, {
                    rootMargin: "0px 0px -100px 0px"
                });

                // observe the target element
                observer.observe(targetElement); 
            </script>
        </div>
    </div>

    <div class="section_three" id="3">
        <h1 class="title">8 Golongan yang Berhak Menerima Zakat Fitrah atau Mustahik</h1>

        <div class="isi_one">
            <div class="container_item_one">
                <button class="item"><h4>Fakir</h4></button>
                <button class="item"><h4>Miskin</h4></button>
                <button class="item"><h4>Amil</h4></button>
                <button class="item"><h4>Mu’allaf</h4></button>
            </div>
            <div class="container_item_two">
                <button class="item"><h4>Riqab</h4></button>
                <button class="item"><h4>Gharim</h4></button>
                <button class="item"><h4>Fi Sabilillah</h4></button>
                <button class="item"><h4>Ibnu Sabil</h4></button>
            </div>

            <div class="container_explanation">
                <h4 id="cont_explanation">Silahkan Klik Golongan Mustahik Diatas Untuk Penjelasannya </h4>
            </div> 

            <script>
                // get the element you want to animate
                const targetElement2 = document.querySelector('#cont_explanation');

                // create a new intersection observer
                const observer2 = new IntersectionObserver(entries => {
                    // loop through the entries that intersect the target element
                    entries.forEach(entry => {
                        // if the target element is intersecting and the entry is visible
                        if (entry.isIntersecting && entry.intersectionRatio > 0) {
                        // add a CSS class to the target element to start the animation
                        targetElement2.classList.add('animate__animated');
                        targetElement2.classList.add('animate__headShake');
                        } 
                    });
                });

                // observe the target element
                observer2.observe(targetElement2);  

                $(document).ready(function() {

                    $('.item').click(function() { 
                        $('.item').removeClass('animate_animated');
                        $('.item').removeClass('animate__bounceIn');
                        $('.item').removeClass('active');
                        $(this).addClass('active');
                        $(this).addClass('animate_animated');
                        $(this).addClass('animate__bounceIn');


                        var answ = $(this).text().trim();
                        switch (answ) {
                            case 'Fakir':
                                $('#cont_explanation').html('Fakir yaitu orang-orang yang memiliki harta namun sangat sedikit. Orang-orang ini tak memiliki penghasilan sehingga jarang bisa memenuhi kebutuhan sehari-hari dengan baik.');
                                break;
                            case 'Miskin':
                                $('#cont_explanation').html('Miskin adalah orang-orang yang memiliki harta namun juga sangat sedikit. Penghasilannya sehari-hari hanya cukup untuk memenuhi makan, minum dan tak lebih dari itu.');
                                break;
                            case 'Amil':
                                $('#cont_explanation').html('Amil adalah orang-orang yang mengurus zakat mulai dari penerimaan zakat hingga menyalurkannya kepada orang yang membutuhkan.');
                                break;
                            case 'Mu’allaf':
                                $('#cont_explanation').html('Mu\'allaf menjadi golongan yang berhak menerima zakat. Ini bertujuan agar orang-orang semakin mantap meyakini Islam sebagai agamanya, Allah sebagai tuhan dan Muhammad sebagai rasulNya.');
                                break;
                            case 'Riqab':
                                $('#cont_explanation').html('Zakat digunakan untuk membayar atau menebus para budak agar mereka dimerdekakan. Orang-orang yang memerdekakan budak juga berhak menerima zakat.');
                                break;
                            case 'Gharim':
                                $('#cont_explanation').html('Gharim adalah orang yang memiliki hutang berhak menerima zakat. Namun, orang-orang yang berhutang untuk kepentingan maksiat, hak mereka untuk mendapat zakat akan gugur.');
                                break;
                            case 'Fi Sabilillah':
                                $('#cont_explanation').html('Segala sesuatu yang bertujuan untuk kepentingan di jalan Allah. Misal, pengembang pendidikan, dakwah, kesehatan, panti asuhan, madrasah diniyah dan masih banyak lagi.');
                                break;
                            case 'Ibnu Sabil':
                                $('#cont_explanation').html('Ibnu Sabil disebut juga sebagai musaffir atau orang-orang yang sedang melakukan perjalanan jauh termasuk pekerja dan pelajar di tanah perantauan.');
                                break;
                            default:
                                break;
                        }

                        targetElement2.classList.remove('animate__animated');
                        targetElement2.classList.remove('animate__fadeIn');
                        void targetElement2.offsetWidth;
                        targetElement2.classList.add('animate__animated');
                        targetElement2.classList.add('animate__fadeIn');
                    })
                });
            </script>
        </div>

        <h2>Sementara Orang yang Wajib Membayar Zakat Fitrah Disebut Sebagai Muzakki</h2>
    </div>

    <footer>
        <div class="container_one">
            <h3 class="title">Fitrah.ly</h3>
            <p>Fitrah.ly merupakan sebuah aplikasi untuk mengelola zakat fitrah, seperti data muzakki, mustahik, dan pendistribusian zakat fitrah.</p>
            <div>
                <h4>Contact Me</h4>
                <h6>Stairways</h6>
                <div class="container_contact_img">
                    <a href="https://wa.me/+6281311073610" target="_blank"><div class="container_img">
                        <img src="{{ asset('/images/icon/whatsapp.png') }}">
                    </div></a> 
                    <a href="https://www.instagram.com/shafwanabd/" target="_blank"><div class="container_img">
                        <img src="{{ asset('/images/icon/instagram.png') }}">
                    </div></a> 
                    <a href="https://mail.google.com/mail/u/0/#search/217006104%40student.unsil.ac.id?compose=new" target="_blank"><div class="container_img">
                        <img src="{{ asset('/images/icon/email.png') }}">
                    </div></a> 
                </div>
            </div>
        </div>
        <div class="container_two flex">

            <div class="container_column">
                <h3>Highlights</h3>
                <a href="{{ url('beranda') }}"><h6>Beranda</h6></a>
                <a href="{{ url('zakatFitrah/dataMuzakki') }}"><h6>Data Muzakki</h6></a>
                <a href="{{ url('zakatFitrah/dataKategoriMustahik') }}"><h6>Data Kategori</h6></a>
                <a href="{{ url('zakatFitrah/pengumpulanZakat') }}"><h6>Pengumpulan Zakat</h6></a>
                <a href="{{ url('zakatFitrah/distribusiZakat') }}"><h6>Distribusi Zakat Warga</h6></a>
                <a href="{{ url('zakatFitrah/distribusiLainnya') }}"><h6>Distribusi Zakat Lainnya</h6></a>
            </div>

            <div class="container_column">
                <h3>Beranda</h3>
                <a href="#"><h6>Top Page</h6></a>
                <a href="#inner_two_id"><h6>Apa itu Zakat Fitrah</h6></a>
                <a href="#3"><h6>8 Golongan Mustahik</h6></a>
            </div>

            <div class="container_column">
                <h3>More</h3>
                <a href="#"><h6>Zakat Fitrah Anak</h6></a>
                <a href="#"><h6>Syarat Zakat Fitrah</h6></a>
                <a href="#"><h6>Manfaat Zakat Fitrah</h6></a>
                <a href="#"><h6>Pengertian Zakat Fitrah</h6></a>
                <a href="#"><h6>Waktu Zakat Fitrah</h6></a>
            </div>

            <div class="container_column">
                <h3>And More!</h3>
                <a href="#"><h6>Nishab Zakat Fitrah</h6></a>
                <a href="#"><h6>Penerima Zakat Fitrah</h6></a>
                <a href="#"><h6>Cara Zakat Fitrah</h6></a>
                <a href="#"><h6>Besaran Zakat Fitrah</h6></a>
                <a href="#"><h6>Tujuan Zakat Fitrah</h6></a>
            </div> 
        </div>
    </footer>

</div>

@endsection