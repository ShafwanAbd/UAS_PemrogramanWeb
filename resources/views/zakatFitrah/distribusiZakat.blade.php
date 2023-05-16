@extends('layouts.layoutSubNav')

@section('head')  

@endsection

@section('content2')

<div class="container_zakatFitrah">
    
    @if(Session::has('success'))
        <p class="alert alert-success section" id="sixSeconds">{{ Session::get('success') }}</p>
    @elseif (Session::has('failed'))
        <p class="alert alert-success section failed" id="sixSeconds">{{ Session::get('failed') }}</p>
    @endif 
    
    <div class="container_isi">

        <div class="header flex">
            <h1 class="title">Distribusi Zakat Fitrah Warga</h1>
            <div class="container_item flex">
                <button type="submit" class="item search" for="form_search">
                    <form action="{{ url('/zakatFitrah/distribusiZakat') }}" method="GET">
                        @csrf
                        <input type="text" name="keyword" placeholder="Search">  
                    </form>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/search.png') }}">
                    </div>
                </button>

                <button class="item view" href="#" data-bs-toggle="modal" data-bs-target="#modal_view">
                    <h4 class="first">Penerima</h4>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/view.png') }}">
                    </div>
                </button>

                <div class="modal fade modal_nohide1" id="modal_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="header flex">
                                    <h3 class="title">Mustahik Yang Sudah Menerima Zakat</h3>
                                    <div class="flex"> 
                                        @if ($result->totalUang || $result->totalBeras)
                                        <a href="{{ url('/zakatFitrah/pengumpulanZakat/resetTotalUang') }}" class="btn btn-third item_inner blue">Reset Total Beras/Uang</a>
                                        @endif
                                        @if ($datas_accepted->count() > 1)
                                        <a href="{{ url('/zakatFitrah/distribusiZakat/destroyAll') }}" class="btn btn-third item_inner">Hapus Semua</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="container_table">
                                    @if ($datas_accepted->isEmpty() != true)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Id</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Diterima</th>
                                                <th scope="col">Hak</th>
                                                @if (Auth()->user())
                                                    <th scope="col">Hapus</th> 
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $totalUang = 0;
                                                $totalBeras = 0;
                                                $totalUangButuh = 0;
                                                $totalBerasButuh = 0;
                                            @endphp
                                            @foreach($datas_accepted as $key3=>$value3)  
                                            <tr class="id_row_clickable row_animate">
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $value3->id }}</td>
                                                <td>{{ $value3->nama }}</td>
                                                <td>{{ $value3->kategori }}</td>
                                                <td>{{ $value3->jenisTerima }}</td>
                                                @if ($value3->jenisTerima == 'Beras')
                                                    <td>{{ number_format($value3->hak/16000, 2) }} Kg</td>
                                                @else {
                                                    <td>{{ @money($value3->hak) }}</td>
                                                }
                                                @endif
                                                @php
                                                    if ($value3->jenisTerima == 'Uang'){
                                                        $totalUangButuh += $value3->hak;
                                                    } else {
                                                        $totalBerasButuh += ($value3->hak / 16000);
                                                    }
                                                @endphp
                                                @if (Auth()->user())
                                                <td class="container_button">
                                                    <form method="POST" action="{{ url('/zakatFitrah/distribusiZakat/'.$value3->id) }}">
                                                    @csrf
                                                        <input type="hidden" name="_method" value="DELETE">   

                                                        <button type="button" class="hapus insideModal_hapus">Hapus</button>     
                                                        <button type="submit" class="hapus disappear insideModal_yakin">Yakin?</button>
                                                    </form>

                                                    <script>
                                                        let i = 0;
                                                        $(document).ready(function() {

                                                            $('.insideModal_hapus').click(function() {
                                                                $(this).addClass('disappear');
                                                                $(this).siblings('.insideModal_yakin').removeClass('disappear');
                                                                i++; 
                                                            }) 

                                                            $('.id_row_clickable').click(function() {
                                                                if (i == 2){ 
                                                                    $('.insideModal_yakin').addClass('disappear');
                                                                    $('.insideModal_hapus').removeClass('disappear'); 
                                                                    i = 0
                                                                }
                                                            });  
                                                        }); 
                                                    </script>
                                                </td>
                                                @endif
                                            </tr> 
                                            @endforeach  
                                        </tbody>
                                        <tfoot class="row_animate">
                                            @foreach($datas3 as $key=>$value)
                                                @php
                                                    $totalUang += $value->totalUang;
                                                    $totalBeras += $value->totalBeras;
                                                @endphp
                                            @endforeach
                                            <th></th>
                                            <th colspan="2">Total Zakat Beras/Uang</th>
                                            <th>{{ $totalBeras }} Kg/{{ @money($totalUang) }}</th> 
                                            <th colspan="1">Terbayarkan</th>
                                            <th colspan="3">{{ $totalBerasButuh }} Kg/{{ @money($totalUangButuh) }}</th> 
                                        </tfoot>
                                    </table>
                                    @else
                                    <div class="container_empty inside">
                                        <div class="container_img">
                                            <img src="{{ asset('images/common/empty1.png') }}">
                                        </div>
                                        <h5>Yaaah Data Masih Kosong Nih... <br>Kamu Bisa Isi Data Lewat Tombol Tambah Loh...</h5>
                                    </div>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->check())
                <button type="button" class="item tambah" data-bs-toggle="modal" data-bs-target="#modal_tambah">
                    <h4 class="first">Tambah</h4>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/plus.png') }}">
                    </div>
                </button>

                <div class="modal fade modal_nohide1" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/zakatFitrah/distribusiZakat') }}" method="POST">
                                @csrf
                                        
                                <div class="row align-items-start">   
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="kumpulZakat_select" class="col-form-label">Nama:</label>
                                            <select name="nama" type="text" class="form-select" id="kumpulZakat_select" required autofocus>
                                                <option value="" disabled selected>-- select --</option>
                                                @foreach($datas1 as $key1=>$value1)
                                                    <option value="{{ $value1->namaMuzakki }}">{{ $value1->namaMuzakki }}</option> 
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kumpulZakat_text" class="col-form-label">Kategori:</label>
                                            <select name="kategori" type="text" class="form-select" id="kumpulZakat_text" required> 
                                                <option value="" disabled selected>-- select --</option>
                                                @foreach($datas2_warga as $key2=>$value2)
                                                    <option value="{{ $value2->namaKategori }}">{{ $value2->namaKategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="input_hak" class="col-form-label">Hak:</label>
                                            <input name="hak" type="text" class="form-control" id="input_hak" readonly>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#kumpulZakat_text').change(function() { 
                                                    var answ = $(this).val(); 
                                                    $.ajax({
                                                        url: '{{ url("get_kategori_muzakki") }}' + '/' + answ,
                                                        success: function(response) { 
                                                            $('#input_hak').val(response.jumlahHak);
                                                        },
                                                        error: function(xhr) {
                                                            console.log(xhr.responseText);
                                                        }
                                                    });
                                                })
                                            })
                                        </script>
                                    </div>
                                    <div class="col mt-2"> 
                                        <h4>Deskripsi</h4>
                                        <p>Silahkan untuk mengisi data mustahik/warga sesuai dengan kategori mustahik/warga.</p> 
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Buat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <button class="item tambah" href="{{ url('login') }}" data-bs-toggle="modal" data-bs-target="#modal_login">
                    <h4 class="first">Tambah</h4>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/plus.png') }}">
                    </div>
                </button>

                <div class="modal fade hapusModal" id="modal_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Kamu Belum Login Nih ...</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="container_img">
                                    <img src="{{ asset('images/modal/login1.png') }}">
                                </div>
                                <p>Kamu harus melakukan login terlebih dahulu jika ingin menambahkan data</p>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                <a href="{{ url('login') }}" class="btn btn-secondary">Login</a>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class="container_table">
            <table class="table table-hover">
                @if ($datas->isEmpty() != true)
                <thead>
                    <tr class="header-row">
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        @if(Auth()->check())
                            <th scope="col">Kategori</th>
                        @else
                            <th scope="col" colspan="2">Kategori</th>
                        @endif
                        <th scope="col">Hak</th> 
                        @if (auth()->check())
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Terima</th>
                        <th>Hapus</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $totalUang = 0;
                        $totalBeras = 0;
                        $totalUangButuh = 0;
                    @endphp
                    
                    @foreach($datas as $key=>$value)
                    <tr class="row_animate">
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->nama }}</td>
                        @if(Auth()->check())
                            <td>{{ $value->kategori }}</td>
                        @else
                            <td colspan="2">{{ $value->kategori }}</td>
                        @endif
                        <td>{{ number_format($value->hak/16000, 2) }} Kg/{{ @money($value->hak) }}</td>
                        @php
                            $totalUangButuh += $value->hak
                        @endphp
                        
                        @if (auth()->check())
                        <td class="container_button"><button class="detail" data-bs-toggle="modal" data-bs-target="#detailModal{{$value->id}}">Detail</button></td>

                        <div class="modal fade" id="detailModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="row align-items-start">   
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Nama:</label>
                                                    <input value="{{ $value->nama }}" type="text" class="form-control" id="recipient-name" disabled>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Kategori:</label>
                                                    <input value="{{ $value->kategori }}" type="text" class="form-select" id="message-text" disabled>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Hak:</label>
                                                    <input value="{{ $value->hak }}" type="text" class="form-control" id="message-text" disabled>
                                                </div>
                                            </div>
                                            <div class="col mt-2">  
                                                <h4>Deskripsi</h4>
                                                <p>
                                                    Disini Anda bisa melihat detail data mustahik/warga yang berhak menerima zakat fitrah.
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>  
                                        <a class="btn btn-secondary" href="{{ url('zakatFitrah/dataMuzakki?keyword='.$value->nama) }}">Go to Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td class="container_button"><button class="edit" data-bs-toggle="modal" data-bs-target="#editModal{{$value->id}}">Edit</button></td>

                        <div class="modal fade" id="editModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/zakatFitrah/distribusiZakat/'.$value->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        
                                        <div class="row align-items-start">   
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="kumpulZakat_select" class="col-form-label">Nama:</label>
                                            <select name="nama" type="text" class="form-select" id="kumpulZakat_select" required autofocus>
                                                <option value="" disabled selected>-- select --</option>
                                                @foreach($datas1 as $key1=>$value1)
                                                    <option value="{{ $value1->namaMuzakki }}" {{ $value->nama == $value1->namaMuzakki ? 'selected' : '' }}>{{ $value1->namaMuzakki }}</option> 
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kumpulZakat_text{{$value->id}}" class="col-form-label">Kategori:</label>
                                                <select name="kategori" type="text" class="form-select" id="kumpulZakat_text{{$value->id}}" required> 
                                                    <option value="" disabled selected>-- select --</option>
                                                    @foreach($datas2_warga as $key2=>$value2)
                                                        <option value="{{ $value2->namaKategori }}" {{ $value->kategori == $value2->namaKategori ? 'selected' : '' }}>{{ $value2->namaKategori }}</option>
                                                    @endforeach
                                                </select>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="input_hak{{ $value->id }}" class="col-form-label">Hak:</label>
                                            <input value='{{ $value->hak }}' name="hak" type="text" class="form-control" id="input_hak{{ $value->id }}" readonly>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#kumpulZakat_text{{$value->id}}').change(function() { 
                                                    var answ = $(this).val(); 
                                                    $.ajax({
                                                        url: '{{ url("get_kategori_muzakki") }}' + '/' + answ,
                                                        success: function(response) { 
                                                            $('#input_hak{{ $value->id }}').val(response.jumlahHak);
                                                        },
                                                        error: function(xhr) {
                                                            console.log(xhr.responseText);
                                                        }
                                                    });
                                                })
                                            })
                                        </script>
                                    </div>
                                    <div class="col mt-2">
                                        <h4>Deskripsi</h4>
                                        <p>
                                            Disini Anda bisa mengedit data mustahik/warga yang berhak menerima zakat fitrah.
                                        </p>
                                    </div>
                                </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-secondary">Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        
                        <td class="container_button"><button class="hapus terima" data-bs-toggle="modal" data-bs-target="#terimaModal{{$value->id}}">Terima</button></td>

                        <div class="modal fade" id="terimaModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="row align-items-start">   
                                            <div class="col"> 
                                                <form method="POST" action="{{ url('/zakatFitrah/distribusiZakat/addTerima/'.$value->id) }}">
                                                @csrf
                                                    <div class="mb-3">
                                                        <label for="distZakat_select{{ $value->id }}" class="col-form-label">Jenis Bayar:</label>
                                                        <select name="jenisBayar" class="form-select" id="distZakat_select{{ $value->id }}" required>
                                                            <option value="" disabled selected>-- select --</option>
                                                            <option value="Beras">Beras</option>
                                                            <option value="Uang">Uang</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label id="label_message-text-label{{ $value->id }}" for="message_text_label{{ $value->id }}" class="col-form-label">Bayar (Kg/Rp):</label>
                                                        <input name="" type="text" class="form-control" id="message_text_label{{ $value->id }}" readonly>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            var jenisBayar; 
                                                            $('#distZakat_select{{ $value->id }}').change(function(){
                                                                jenisBayar = $(this).val();
                                                                jumlahBayar = "{{ $value->hak }}";
                                                                if (jenisBayar == 'Beras'){ 
                                                                    $('#label_message-text-label{{ $value->id }}').html('Beras (Kg)');
                                                                    $('#message_text_label{{ $value->id }}').attr('name', 'bayarBeras');  
                                                                    $('#message_text_label{{ $value->id }}').val(jumlahBayar/16000); 
                                                                } else if (jenisBayar == 'Uang'){
                                                                    $('#label_message-text-label{{ $value->id }}').html('Uang (Rp)');
                                                                    $('#message_text_label{{ $value->id }}').attr('name', 'bayarUang'); 
                                                                    $('#message_text_label{{ $value->id }}').val(jumlahBayar); 
                                                                } 
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            
                                                <div class="col mt-2">
                                                    <h4>Deskripsi</h4>
                                                    <p>
                                                        Silahkan pilih jenis pembayaran yang akan dikasihkan kepada mustahik.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                            <button type="submit" class="hapus terima btn-secondary">Terima</button>
                                        </div> 
                                    </form> 
                                </div>
                            </div>
                        </div>

                        <td class="container_button"><button class="hapus" data-bs-toggle="modal" data-bs-target="#hapusModal{{$value->id}}">Hapus</button></td>
                        
                        <div class="modal fade hapusModal" id="hapusModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container_img">
                                            <img src="{{ asset('images/modal/sampah1.png') }}">
                                        </div>
                                        <p>Data yang sudah dihapus tidak bisa dikembalikan.</p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        
                                        <form method="POST" action="{{ url('/zakatFitrah/distribusiZakat/'.$value->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-secondary">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </tr>
                    @endforeach
                    
                    <script>
                        const targetElements = document.querySelectorAll('.row_animate');
                        
                        const observer = new IntersectionObserver(entries => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting && entry.intersectionRatio > 0) {
                                    entry.target.classList.add('animate__animated');
                                    entry.target.classList.add('animate__fadeIn');
                                } 
                            });
                        });
                        
                        targetElements.forEach(element => {
                            observer.observe(element);
                        });
                    </script>
                </tbody>
                <tfoot class="row_animate"> 
                    @foreach($datas3 as $key=>$value)
                        @php 
                            $totalUang += $value->totalUang; 
                            $totalBeras += $value->totalBeras; 
                        @endphp
                    @endforeach
                    <th></th>
                    <th colspan="2">Total Zakat Beras/Uang</th>   
                    <th>{{ $totalBeras }} Kg/{{ @money($totalUang) }}</th>   
                    @if ($totalUangButuh > $totalUang && $totalUangButuh/16000 > $totalBeras)
                        <th colspan="1">Dibutuhkan</th>
                        <th colspan="3" class="color_red">{{ $totalUangButuh/16000 }} Kg/{{ @money($totalUangButuh) }}</th>
                    @elseif ($totalUangButuh > $totalUang)
                        <th colspan="1">Dibutuhkan</th>
                        <th colspan="3">{{ $totalUangButuh/16000 }} Kg/<span class="color_red">{{ @money($totalUangButuh) }}</span></th>
                    @elseif ($totalUangButuh/16000 > $totalBeras)
                        <th colspan="1">Dibutuhkan</th>
                        <th colspan="3"><span class="color_red">{{ $totalUangButuh/16000 }} Kg</span>/{{ @money($totalUangButuh) }}</th>
                    @else
                        <th colspan="1">Dibutuhkan</th>
                        <th colspan="3">{{ $totalUangButuh/16000 }} Kg/{{ @money($totalUangButuh) }}</th>
                    @endif
                </tfoot>

                @else  
                <div class="container_empty">
                    <div class="container_img">
                        <img src="{{ asset('images/common/empty1.png') }}">
                    </div>
                    <h5>Yaaah Data Masih Kosong Nih... <br>Kamu Bisa Isi Data Lewat Tombol Tambah Loh...</h5>
                </div>
                @endif
            </table>
        </div> 

        <script>
            const targetElements2 = document.querySelectorAll('.row_animate');
            
            const observer2 = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > 0) {
                        entry.target.classList.add('animate__animated');
                        entry.target.classList.add('animate__fadeIn');
                    } 
                });
            });
            
            targetElements2.forEach(element => {
                observer2.observe(element);
            });
        </script>
         
    </div>
</div>

@endsection