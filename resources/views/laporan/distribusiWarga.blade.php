@extends('layouts.layoutSubNavLaporan')

@section('content2')

<div class="container_zakatFitrah laporan">
    
    @if(Session::has('success'))
        <p class="alert alert-success section" id="sixSeconds">{{ Session::get('success') }}</p>
    @endif 

    <div class="container_isi"> 
        <div class="header flex laporan">
            <h1 class="title">Laporan Distribusi Ke Mustahik Warga</h1>
            
            <div class="container_item flex">    
                <button class="item tambah" id="printButton1">
                    <h4 class="first">Download</h4>
                    <div class="container_img">
                        <img src="{{ asset('images/icon/download.png') }}">
                    </div>
                </button> 
            </div>
        </div>

        <div class="container_table">
            <table class="table table-hover"> 
                <thead>
                    <tr class="header-row">
                        <th scope="col">No</th> 
                        <th scope="col">Kategori</th>
                        <th scope="col">Hak Beras</th>
                        <th scope="col">Jumlah KK</th>
                        <th scope="col">Total Beras</th> 
                        <th scope="col">Total Uang</th> 
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $fakir_totalKK = 0;
                        $miskin_totalKK = 0;
                        $mampu_totalKK = 0; 
                        
                        $fakir_totalBeras = 0;
                        $miskin_totalBeras = 0;
                        $mampu_totalBeras = 0;
                        
                        $fakir_totalUang = 0;
                        $miskin_totalUang = 0;
                        $mampu_totalUang = 0;
                    @endphp

                    @foreach($datas2 as $key2=>$value2)
                        @php
                            if ($value2->kategori == 'Fakir'){ 
                                $fakir_totalKK++; 
                            } else if ($value2->kategori == 'Miskin'){ 
                                $miskin_totalKK++;
                            } else if ($value2->kategori == 'Mampu'){ 
                                $mampu_totalKK++;
                            }
                        @endphp
                    @endforeach
                    
                    @foreach($datas as $key=>$value) 
                        @if(isset($value->kategori))
                        <tr class="row_animate">
                            <th scope="row">{{ $i++ }}</th>  
                            <td>{{ isset($value->kategori) ? $value->kategori : '-' }}</td>
                            <td>{{ isset($value->hak) ? $value->hak/16000 : '-' }} Kg</td>
                            @if (isset($value->kategori))
                                @if ($value->kategori == 'Fakir')
                                    <td>{{ $fakir_totalKK }}</td>
 
                                    @foreach ($fakirAll as $keyfakir=>$valuefakir)  
                                        @php
                                            if ($valuefakir->jenisTerima == "Beras")
                                                $fakir_totalBeras += $valuefakir->hak / 16000;
                                            else if ($valuefakir->jenisTerima == "Uang")
                                                $fakir_totalUang += $valuefakir->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($fakir_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($fakir_totalUang) }}</td>
                                @elseif ($value->kategori == 'Miskin')
                                    <td>{{ $miskin_totalKK }}</td>
                                    
                                    @foreach ($miskinAll as $keymiskin=>$valuemiskin)  
                                        @php
                                            if ($valuemiskin->jenisTerima == "Beras")
                                                $miskin_totalBeras += $valuemiskin->hak / 16000;
                                            else if ($valuemiskin->jenisTerima == "Uang")
                                                $miskin_totalUang += $valuemiskin->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($miskin_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($miskin_totalUang) }}</td>
                                @elseif ($value->kategori == 'Mampu')
                                    <td>{{ $mampu_totalKK }}</td>
                                    
                                    @foreach ($mampuAll as $keymampu=>$valuemampu)  
                                        @php
                                            if ($valuemampu->jenisTerima == "Beras")
                                                $mampu_totalBeras += $valuemampu->hak / 16000;
                                            else if ($valuemampu->jenisTerima == "Uang")
                                                $mampu_totalUang += $valuemampu->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($mampu_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($mampu_totalUang) }}</td>
                                @else 
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                            @endif
                        </tr>
                        @endif
                    @endforeach 
                </tbody>
                <tfoot class="row_animate">  
                    @php
                        $totalKK = $fakir_totalKK + $miskin_totalKK + $mampu_totalKK;
                        $totalBeras = $fakir_totalBeras + $miskin_totalBeras + $mampu_totalBeras;
                        $totalUang = $fakir_totalUang + $miskin_totalUang + $mampu_totalUang;
                    @endphp
                    <th></th>
                    <th colspan="2">Total</th> 
                    <th colspan="1">{{ $totalKK }}</th>     
                    <th colspan="1">{{ number_format($totalBeras, 2) }} Kg</th>     
                    <th colspan="1">{{ @money($totalUang) }}</th>     
                </tfoot>
                
                <script>
                    $(document).ready(function() {
                        $('#printButton1').click(function() {
                            $('.container_table').printThis({
                                pageTitle: "Laporan Distribusi Ke Mustahik Warga", 
                                filename: "example.pdf", 
                            });
                        })
                    })
                </script>

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
            </table>
        </div> 
    </div>
</div>

@endsection