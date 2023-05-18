@extends('layouts.layoutSubNavLaporan')

@section('content2')
    <div class="container_zakatFitrah laporan ringkasan">

        @if(Session::has('success'))
            <p class="alert alert-success section" id="sixSeconds">{{ Session::get('success') }}</p>
        @endif 

        <div class="container_isi mt-4"> 
            <div class="header flex laporan">
                <h1 class="title mx-3">Ringkasan</h1>
                
                <div class="container_item flex">    
                    <button class="item tambah" id="printButton1">
                        <h4 class="first">Download</h4>
                        <div class="container_img">
                            <img src="{{ asset('images/icon/download.png') }}">
                        </div>
                    </button> 
                </div> 
            </div>

            <div id="printThiss" class="px-3 py-3 w-100"> 
                <div class=" bg-grey rounded mx-2">
                    <canvas id="myChart"></canvas>
                </div> 

                <script>
                    const ctx = document.getElementById('myChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Fakir', 'Miskin', 'Mampu', 'Amil', 'Mu\'allaf', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil', 'Lainnya'],
                            datasets: [{
                                label: 'Jumlah Warga Berdasarkan Kategori',
                                data: [
                                    '{{ $datas["fakir"] }}',
                                    '{{ $datas["miskin"] }}',
                                    '{{ $datas["mampu"] }}',
                                    '{{ $datas["amil"] }}',
                                    '{{ $datas["muallaf"] }}',
                                    '{{ $datas["riqab"] }}',
                                    '{{ $datas["gharim"] }}',
                                    '{{ $datas["fiSabilillah"] }}',
                                    '{{ $datas["ibnuSabil"] }}',
                                    '{{ $datas["lainnya"] }}', 
                                ],
                                borderWidth: 1,
                                backgroundColor: 'rgb(14,176,0)'
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            },
                            aspectRatio: 2.45
                        }
                    });
                </script>

                <div class="d-flex mt-5">
                    <div class="w-50 mx-2 p-4 bg-grey rounded">
                        <div class="">
                            <canvas id="myChart2"></canvas>
                        </div>  

                        <script>
                            const ctx2 = document.getElementById('myChart2');

                            new Chart(ctx2, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Muzakki', 'Tanggungan'],
                                    datasets: [{  
                                        data: ['{{ $datas["muzakki"] }}', '{{ $datas["tanggungan"] }}'],
                                        borderWidth: 0, 
                                        backgroundColor: [
                                            'rgb(77,216,65)',
                                            'rgb(216, 65, 65)',
                                        ]
                                    }]
                                },
                                options: { 
                                    aspectRatio: 2,
                                    plugins: {
                                        legend: {
                                            labels: {
                                                boxHeight: 40,
                                                boxWidth: 10,
                                                padding: 40
                                            },
                                            position: 'right'
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="w-50 mx-2 p-4 bg-grey rounded">
                        <div class="">
                            <canvas id="myChart3"></canvas>
                        </div>  

                        <script>
                            const ctx3 = document.getElementById('myChart3');

                            new Chart(ctx3, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Beras (Kg)', 'Uang/K (Rp)'],
                                    datasets: [{  
                                        data: ['{{ $datas["result"]->totalBeras }}', '{{ $datas["result"]->totalUang / 1000 }}'],
                                        borderWidth: 0,
                                        backgroundColor: [
                                            'rgb(77,216,65)',
                                            'rgb(216, 65, 65)',
                                        ]
                                    }]
                                },
                                options: { 
                                    aspectRatio: 2,
                                    plugins: {
                                        legend: {
                                            labels: {
                                                boxHeight: 40,
                                                boxWidth: 10,
                                                padding: 40
                                            },
                                            position: 'left'
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>  

                <script>
                    $(document).ready(function() {
                        $('#printButton1').click(function() {
                            $('#printThiss').printThis({
                                pageTitle: "Ringkasan Laporan", 
                                filename: "example.pdf", 
                            });
                        })
                    })
                </script>

            </div>
        </div> 
    </div>
</div>
@endsection