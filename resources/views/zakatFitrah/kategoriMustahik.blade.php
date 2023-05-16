@extends('layouts.layoutSubNav')

@section('content2')

<div class="container_zakatFitrah">
    
    @if(Session::has('success'))
        <p class="alert alert-success section" id="sixSeconds">{{ Session::get('success') }}</p>
    @endif

    <div class="container_isi">

        <div class="header flex">
            <h1 class="title">Kategori Mustahik</h1>
            <div class="container_item flex no_view">
                <button type="submit" class="item search" for="form_search">
                    <form action="{{ url('/zakatFitrah/dataKategoriMustahik') }}" method="GET">
                        @csrf
                        <input type="text" name="keyword" placeholder="Search">  
                    </form>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/search.png') }}">
                    </div>
                </button>
                @if (auth()->check())
                <button type="button" class="item tambah" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    <h4 class="first">Tambah</h4>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/plus.png') }}">
                    </div>
                </button>

                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/zakatFitrah/dataKategoriMustahik') }}" method="POST">
                                @csrf
                                        
                                <div class="row align-items-start">   
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                            <input name="namaKategori" class="form-control" id="message-text" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Jumlah Hak:</label>
                                            <input name="jumlahHak" type="text" class="form-control" id="message-text" required>
                                        </div>
                                    </div>

                                    <div class="col mt-2">
                                        <h4>Deskripsi</h4>
                                        <p>
                                            Silahkan isi kolum kategori dan jumlah hak untuk membuat kategori yang nantinya akan dijadikan kategori untuk mustahik.
                                        </p>
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
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jumlah Hak</th>
                        @if(auth()->check())
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    
                    @foreach($datas as $key=>$value)
                    <tr class="row_animate">
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->namaKategori }}</td> 
                        <td>{{ @money($value->jumlahHak) }}</td>
                        @if(auth()->check())
                        
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
                                                <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                                <input value="{{ $value->namaKategori }}" name="namaKategori" class="form-control" id="message-text" disabled> 
                                            </div>

                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Jumlah Hak:</label>
                                                <input value="{{ $value->jumlahHak }}" name="jumlahHak" type="text" class="form-control" id="message-text" disabled>
                                            </div>
                                        </div>

                                        <div class="col mt-2">
                                            <h4>Deskripsi</h4>
                                            <p>
                                                Data kategori mustahik merupakan kategori yang akan digunakan sebagai pelabelan kategori para mustahik.
                                            </p>
                                        </div>
                                    </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
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
                                        <form action="{{ url('/zakatFitrah/dataKategoriMustahik/'.$value->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        
                                        <div class="row align-items-start">   
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                            <input value="{{ $value->namaKategori }}" name="namaKategori" class="form-control" id="message-text" required> 
                                        </div>

                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Jumlah Hak:</label>
                                            <input value="{{ $value->jumlahHak }}" name="jumlahHak" type="text" class="form-control" id="message-text" required>
                                        </div>
                                    </div>

                                    <div class="col mt-2">
                                        <h4>Deskripsi</h4>
                                        <p>
                                            Disini Anda bisa mengubah data kategori yang telah dibuat.
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
                                        
                                        <form method="POST" action="{{ url('/zakatFitrah/dataKategoriMustahik/'.$value->id) }}">
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
        

    </div>
</div>

@endsection