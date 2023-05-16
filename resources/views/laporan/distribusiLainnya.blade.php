@extends('layouts.layoutSubNavLaporan')

@section('content2')

<div class="container_zakatFitrah laporan">
    
    @if(Session::has('success'))
        <p class="alert alert-success section" id="sixSeconds">{{ Session::get('success') }}</p>
    @endif 

    <div class="container_isi"> 
        <div class="header flex laporan">
            <h1 class="title">Laporan Distribusi Ke Mustahik Lainnya</h1>
            
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
                        $amil_totalKK = 0;
                        $muallaf_totalKK = 0;
                        $fisabilillah_totalKK = 0;
                        $ibnusabil_totalKK = 0;
                        $lainnya_totalKK = 0;

                        $amil_totalBeras = 0;
                        $muallaf_totalBeras = 0;
                        $fisabilillah_totalBeras = 0;
                        $ibnusabil_totalBeras = 0;
                        $lainnya_totalBeras = 0;

                        $amil_totalUang = 0;
                        $muallaf_totalUang = 0;
                        $fisabilillah_totalUang = 0;
                        $ibnusabil_totalUang = 0;
                        $lainnya_totalUang = 0;
                    @endphp

                    @foreach($datas2 as $key2=>$value2)
                        @php
                            if ($value2->kategori == 'Amil'){ 
                                $amil_totalKK++; 
                            } else if ($value2->kategori == 'Mu\'allaf'){ 
                                $muallaf_totalKK++;
                            } else if ($value2->kategori == 'Fi Sabilillah'){ 
                                $fisabilillah_totalKK++;
                            } else if ($value2->kategori == 'Ibnu Sabil'){ 
                                $ibnusabil_totalKK++;
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
                                @if ($value->kategori == 'Amil')
                                    <td>{{ $amil_totalKK }}</td>
 
                                    @foreach ($amilAll as $keyAmil=>$valueAmil)  
                                        @php
                                            if ($valueAmil->jenisTerima == "Beras")
                                                $amil_totalBeras += $valueAmil->hak / 16000;
                                            else if ($valueAmil->jenisTerima == "Uang")
                                                $amil_totalUang += $valueAmil->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($amil_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($amil_totalUang) }}</td>
                                @elseif ($value->kategori == 'Mu\'allaf')
                                    <td>{{ $muallaf_totalKK }}</td>
 
                                    @foreach ($muallafAll as $keyMuallaf=>$valueMuallaf)  
                                        @php
                                            if ($valueMuallaf->jenisTerima == "Beras")
                                                $muallaf_totalBeras += $valueMuallaf->hak / 16000;
                                            else if ($valueMuallaf->jenisTerima == "Uang")
                                                $muallaf_totalUang += $valueMuallaf->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($muallaf_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($muallaf_totalUang) }}</td>
                                @elseif ($value->kategori == 'Fi Sabilillah')
                                    <td>{{ $fisabilillah_totalKK }}</td>
 
                                    @foreach ($fiSabilillahAll as $keyfisabilillah=>$valuefisabilillah)  
                                        @php
                                            if ($valuefisabilillah->jenisTerima == "Beras")
                                                $fisabilillah_totalBeras += $valuefisabilillah->hak / 16000;
                                            else if ($valueMuallaf->jenisTerima == "Uang")
                                                $fisabilillah_totalUang += $valuefisabilillah->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($fisabilillah_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($fisabilillah_totalUang) }}</td>
                                @elseif ($value->kategori == 'Ibnu Sabil')
                                    <td>{{ $ibnusabil_totalKK }}</td>
 
                                    @foreach ($ibnuSabilAll as $keyibnusabil=>$valueibnusabil)  
                                        @php
                                            if ($valueibnusabil->jenisTerima == "Beras")
                                                $ibnusabil_totalBeras += $valueibnusabil->hak / 16000;
                                            else if ($valueibnusabil->jenisTerima == "Uang")
                                                $ibnusabil_totalUang += $valueibnusabil->hak;
                                        @endphp
                                    @endforeach

                                    <td>{{ number_format(($ibnusabil_totalBeras), 2) }} Kg</td>
                                    <td>{{ @money($ibnusabil_totalUang) }}</td>
                                @else
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                            @endif
                        </tr>
                        @endif
                    @endforeach 

                    @foreach($lainnya as $key2=>$value2) 
                        @php 
                            $lainnya_totalKK++;

                            if ($value2->jenisTerima == "Beras"){
                                $lainnya_totalBeras += $value2->hak;
                            }else if ($value2->jenisTerima == "Uang"){
                                $lainnya_totalUang += $value2->hak;
                            }
                        @endphp
                    @endforeach

                    @if ($lainnya_totalBeras != 0 || $lainnya_totalUang != 0 || $lainnya_totalKK != 0) 
                    <tr class="row_animate">
                        <th scope="row">{{ $i++ }}</th>
                        <td>Lainnya</td> 
                        @if ($lainnya_totalUang != 0 && $lainnya_totalBeras != 0)
                            <td>{{ number_format(($lainnya_totalUang / 16000 / $lainnya_totalKK ) + ($lainnya_totalBeras / 16000 / $lainnya_totalKK), 2) }} Kg +-</td>   
                        @elseif ($lainnya_totalUang != 0)
                            <td>{{ number_format((($lainnya_totalUang / $lainnya_totalKK) / 16000), 2) }} Kg +-</td>  
                        @elseif ($lainnya_totalBeras != 0)
                            <td>{{ number_format((($lainnya_totalBeras / 16000 / $lainnya_totalKK)), 2) }} Kg +-</td> 
                        @else
                            <td>0 Kg +-</td> 
                        @endif
                        <td>{{ $lainnya_totalKK }}</td>
                        <td>{{ number_format(($lainnya_totalKK * ($lainnya_totalBeras / 16000 / $lainnya_totalKK)), 2) }} Kg</td> 
                        <td>{{ @money($lainnya_totalKK * ($lainnya_totalUang / $lainnya_totalKK)) }}</td> 
                    </tr> 
                    @endif
                </tbody>
                <tfoot class="row_animate">  
                    @php
                        $totalKK =  $amil_totalKK + $muallaf_totalKK + $fisabilillah_totalKK + $ibnusabil_totalKK + $lainnya_totalKK; 

                        if ($lainnya_totalBeras != 0 || $lainnya_totalUang != 0 || $lainnya_totalKK != 0) {
                            $totalBeras =  $amil_totalBeras + $muallaf_totalBeras + $fisabilillah_totalBeras + $ibnusabil_totalBeras + ($lainnya_totalKK * ($lainnya_totalBeras / 16000 / $lainnya_totalKK)); 
                            $totalUang =  $amil_totalUang + $muallaf_totalUang + $fisabilillah_totalUang + $ibnusabil_totalUang + $lainnya_totalUang; 
                        }
                        else {
                            $totalBeras =  $amil_totalBeras + $muallaf_totalBeras + $fisabilillah_totalBeras + $ibnusabil_totalBeras; 
                            $totalUang =  $amil_totalUang + $muallaf_totalUang + $fisabilillah_totalUang + $ibnusabil_totalUang; 
                        }
                    @endphp
                    <th></th>
                    <th colspan="2">Total</th> 
                    <th colspan="1">{{ $totalKK }}</th>     
                    <th colspan="1">{{ number_format(($totalBeras), 2) }} Kg</th>   
                    <th colspan="1">{{ @money($totalUang) }}</th>     
                </tfoot>
                
                <script>
                    $(document).ready(function() {
                        $('#printButton1').click(function() {
                            $('.container_table').printThis({
                                pageTitle: "Laporan Distribusi Ke Mustahik Lainnya", 
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