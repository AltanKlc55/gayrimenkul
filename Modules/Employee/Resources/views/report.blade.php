@extends('master')

@section('content')
    @include('breadcrump')


    <div class="row row-cols-12 mt-50" id="dashboardicon">

        <div class="col-md-12 mb-20" >
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <form method="get">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label>{{___('Başlangıç')}}</label>
                            <input type="date" name="start" value="{{$page['start'] ? $page['start'] : ''}}" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>{{___('Bitiş')}}</label>
                            <input type="date" name="end" value="{{$page['end'] ? $page['end'] : ''}}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">{{___('Filter')}}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Dashboard icon cards -->
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-md p-2 bg-warning">
                                <span class="bx bx-buildings "></span>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1">{{converttime($page['task_time'])}}</h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Çalışılan Zaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-md p-2 bg-secondary">
                                <span class="bx bx-buildings"></span>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1">{{$page['person']}} <small>Proje</small></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">İşlem Yaptığı Proje</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-md p-2 bg-success">
                                <span class="bx bx-buildings"></span>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1">{{$page['task']}} <small>Bölüm</small></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Çalışma Gerçekleştirilen Bölümler</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-md p-2 bg-success">
                                <span class="bx bx-buildings"></span>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1">{{$page['leave']}} <small>Gün</small></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Gerçekleştirilen İzin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class=" col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Personel Raporu
                    </div>

                </div>
                <div class="card-body p-0 overflow-hidden">
                    <div class="leads-source-chart d-flex align-items-center justify-content-center">
                        <div id="piechart2" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        İşlere Ayrılan Zaman
                    </div>

                </div>
                <div class="card-body p-0 overflow-hidden">
                    <div class="leads-source-chart d-flex align-items-center justify-content-center">

                        <div id="piechart" style="width: 100%; height: 500px;"></div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endpush

@push('javascript')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>

        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Personel', 'Dakika'],
                    @foreach($work as $item)
                ['{{$item['name']}}',{{$item['time']}}],
                @endforeach
            ]);
            var options = {
                colors: [
                    @foreach($work as $item)
                        '{{$item['color']}}',
                    @endforeach
                ], // Renkleri belirleme
                pieHole: 0.4,
                pieSliceText: 'value',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));




            chart.draw(data, options);
        }


        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Personel', 'Dakika',""],
                    @foreach($user as $item)
                ['{{$item['name']}}',{{$item['time']}},{{$item['id']}}],
                @endforeach
            ]);
            var options = {
                colors: [
                    @foreach($user as $item)
                        '{{$item['color']}}',
                    @endforeach
                ], // Renkleri belirleme
                pieHole: 0.4,
                pieSliceText: 'value',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
            google.visualization.events.addListener(chart, 'select', function() {
                var selection = chart.getSelection();
                if (selection.length > 0) {
                    var item = selection[0];
                    var id = data.getValue(item.row, 2);
                    location.href = "manager/project/report-person/"+id+"/{{$page['id']}}";
                }
            });

            chart.draw(data, options);
        }
    </script>
@endpush
