@extends('master')
@push('css')
    <link rel="stylesheet" href="../assets/libs/jsvectormap/css/jsvectormap.min.css">
    <link rel="stylesheet" href="../assets/libs/swiper/swiper-bundle.min.css">
@endpush
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <p class="fw-semibold fs-18 mb-0">{{___('Gelir Gider Rapor')}}</p>
        </div>
        <div class="btn-list mt-md-0 mt-2">

        </div>
    </div>

    <form method="get">


        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title col-12">
                        <div class="row">
                            <div class="col-md-8">
                                {{___('Genel Satış Raporu')}}
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" name="year">
                                            @foreach(getyear() as $item)
                                                <option value="{{$item['id']}}" {{($page['year'] == $item['id']) ? 'selected' : ''}}>{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="group">
                                            @foreach($page['group'] as $item)
                                                <option value="{{$item['id']}}" {{($page['group'] == $item['id']) ? 'selected' : ''}}>{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary">{{___('Filter')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="content-wrapper">
                        <div id="crm-revenue-analytics"></div>
                    </div>
                </div>
            </div>
        </div>



    </form>

@endsection

@push('javascript')

    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Apex Charts JS -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Chartjs Chart JS -->
    <script src="../assets/libs/chart.js/chart.min.js"></script>

    <!-- CRM-Dashboard -->
    <script>
        var options = {
            series: [
                {
                    type: 'line',
                    name: '{{___('Gelir')}}',
                    data:@json($sales)
                },
                {
                    type: 'line',
                    name: '{{___('Gider')}}',

                    data:@json($pending)
                },

            ],
            chart: {
                height: 350,
                animations: {
                    speed: 500
                },
                dropShadow: {
                    enabled: true,
                    enabledOnSeries: undefined,
                    top: 8,
                    left: 0,
                    blur: 3,
                    color: '#000',
                    opacity: 0.1
                },
            },
            colors: ["rgb(78, 172, 76)","rgb(229, 83, 60)"],
            dataLabels: {
                enabled: true
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4
            },
            stroke: {
                curve: 'smooth',
                width: [2, 2, 2],
                dashArray: [5, 5, 5],
            },
            xaxis: {
                axisTicks: {
                    show: true,
                },
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "TL" + value;
                    }
                },
            },
            tooltip: {
                y: [{
                    formatter: function(e) {
                        return void 0 !== e ? "TL" + e.toFixed(0) : e
                    }
                }, {
                    formatter: function(e) {
                        return void 0 !== e ? "TL" + e.toFixed(0) : e
                    }
                }, {
                    formatter: function(e) {
                        return void 0 !== e ? e.toFixed(0) : e
                    }
                }]
            },
            legend: {
                show: true,
                customLegendItems: ['{{___('Gelir')}}', '{{___('Gider')}}'],
                inverseOrder: true
            },
            title: {
                text: '{{___('Satış Grafiği')}}',
                align: 'left',
                style: {
                    fontSize: '.8125rem',
                    fontWeight: 'semibold',
                    color: '#8c9097'
                },
            },
            markers: {
                hover: {
                    sizeOffset: 10
                }
            }
        };

        document.getElementById('crm-revenue-analytics').innerHTML = '';
        var chart = new ApexCharts(document.querySelector("#crm-revenue-analytics"), options);
        chart.render();


        /* Revenue Analytics Chart */


    </script>

@endpush