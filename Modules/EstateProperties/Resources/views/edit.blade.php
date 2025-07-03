@extends('master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush
@section('content')
@include('breadcrump')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <form action="{{route('testcreate.update')}}" id="form" name="form" method="POST">
                @csrf
                <div class="card-header justify-content-between">
                    <div></div>
                    <div class="prism-toggle">
                      <button class="btn btn-sm btn-primary-light" form="form" type="submit">Değişiklikleri Kaydet<i
                                class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card-body">
                            <form method="POST" id="form"
                                action="http://127.0.0.1:8000/manager/estateproperties/update/4"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="yaCSaIaVnksXmB86S1URNJqDYtcYicSs2m5vLmWx">
                                <div class="col-md-12 pl-20 pr-20">
                                    <div class="row">
                                        <div class="form-group mb-3   col-md-3 ">
                                            <label>Özellik Adı</label>
                                            <div class="row align-items-end">
                                                <div class="">
                                                    <input type="text" class="form-control input-default  " id=""
                                                        name="category_name" value="{{$row['category_name']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3   col-md-3 ">
                                            <label>Özellik İkonu</label>
                                            <div class="row align-items-end">
                                                <div class="col-md-10">
                                                <input type="file" class="form-control input-default" id=""
                                                   name="category_icon" value="{{$row['category_icon']}}">
                                                   <input hidden type="text" name="old_photo" value="{{$row['category_icon']}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-sm btn-info"
                                                        href="http://127.0.0.1:8000/uploads/properties/{{$row['category_icon']}}"
                                                        target="_blank"> <i class="ri-eye-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('javascript')
    @yield('add_javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@endsection