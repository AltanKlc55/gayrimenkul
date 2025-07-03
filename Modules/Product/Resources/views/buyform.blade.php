@extends('master')
@include('partials.table')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    @include('breadcrump')

    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-sm btn-primary-light" form="form">{{___('Save')}}<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="form" action="{{$page['action']}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <x-forms.input
                                    type="text"
                                    title="{{___('Tedarikçi')}}"
                                    name="supplier"
                                    class=""
                                    grid="col-md-3"
                                    id=""
                                    readonly=""
                                    multilang=""
                                    lang=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry="{{isset($row['supplier']) ?  $row['supplier'] : ''}}"
                            />
                            <x-forms.select
                                    title="{{___('Satın Alma Türü')}}"
                                    name="sub_group"
                                    class="select2"
                                    grid="col-md-3"
                                    :options="$page['financegroup']"
                                    child="title"
                                    id=""
                                    tags=""
                                    selected="{{isset($row['sub_group']) ? $row['sub_group'] : ''}}"
                                    readonly=""
                                    multiple=""
                                    description=""
                                    required=""
                                    disabled=""
                                    attribute=""
                            />
                            <x-forms.input
                                    type="text"
                                    title="{{___('Fatura No')}}"
                                    name="invoice_no"
                                    class=""
                                    grid="col-md-3"
                                    id=""
                                    readonly=""
                                    multilang=""
                                    lang=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry="{{isset($row['supplier']) ?  $row['supplier'] : ''}}"
                            />

                            <x-forms.input
                                    type="file"
                                    title="{{___('Fatura')}}"
                                    name="image"
                                    class=""
                                    grid="col-md-3"
                                    id=""
                                    readonly=""
                                    path="uploads/product/"
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype="image"
                                    attribute=""
                                    entry="{{isset($row['image']) ? $row['image'] : ''}}"

                            />

                            <x-forms.input
                                    type="hidden"
                                    title=""
                                    name="group"
                                    class=""
                                    grid=""
                                    id=""
                                    readonly=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry="3"
                            />
                            <x-forms.input
                                    type="hidden"
                                    title=""
                                    name="code"
                                    class=""
                                    grid=""
                                    id=""
                                    readonly=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry="{{$page['code']}}"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{___('Product Add')}}
                    </div>
                    <div class="prism-toggle">
                        <button type="submit" class="btn btn-sm btn-primary-light" form="formchild">{{___('Add Product')}}<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="formchild"   enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <x-forms.select
                                    title="{{___('Product')}}"
                                    name="product"
                                    class="select2 clear_elem"
                                    grid="col-md-4"
                                    child="title"
                                    :options="$page['product']"
                                    id=""
                                    tags=""
                                    selected="0"
                                    readonly=""
                                    multiple=""
                                    description=""
                                    required=""
                                    disabled=""
                                    attribute=""
                            />
                            <x-forms.input
                                    type="number"
                                    title="{{___('Qty')}}"
                                    name="qty"
                                    class="clear_elem"
                                    grid="col-md-4"
                                    id=""
                                    readonly=""
                                    multilang=""
                                    lang=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry=""
                            />
                            <x-forms.input
                                    type="text"
                                    title="{{___('Birim Fiyat')}}"
                                    name="price"
                                    class="currency clear_elem"
                                    grid="col-md-4"
                                    id=""
                                    readonly=""
                                    multilang=""
                                    lang=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry=""
                            />
                            <x-forms.input
                                    type="hidden"
                                    title=""
                                    name="code"
                                    class=""
                                    grid=""
                                    id=""
                                    readonly=""
                                    path=""
                                    description=""
                                    required=""
                                    disabled=""
                                    filetype=""
                                    attribute=""
                                    entry="{{$page['code']}}"
                            />
                        </div>
                    </form>

                    <div class="col-md-12 ">
                        <hr><br>
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--End::row-1 -->
    @push('javascript')
        <!-- Select2 Cdn -->

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $( document ).ready(function() {
                $("select").select2({
                    placeholder: "<?= ___('Choose') ?>"
                });

                $("#formchild").submit(function(e){
                    e.preventDefault();

                    var string = $("#formchild").serialize();
                    $.ajax({
                        type: "post",
                        url: "{{route('productbuyying.store_child')}}",
                        data : string,
                        dataType: 'json',

                        success: function(json){
                            if(json['success']){

                                toastr.success("{{___('Transaction Successful')}}");
                                $("#formchild .clear_elem").val();


                                setTimeout(function(){
                                    tableupdate()

                                }, 3000);
                            }

                            if(json['error']){
                                toastr.error("{{___('Transaction Failed')}}");
                            }
                        }
                    });
                });

            });
            function removechild(elem){
                var destroy = $(elem).data('url');
                $.ajax({
                    type: "get",
                    url: destroy,
                    dataType: 'json',

                    success: function(json){
                        if(json['success']){

                            toastr.success("{{___('Transaction Successful')}}");

                            setTimeout(function(){
                                tableupdate()
                            }, 3000);
                        }

                        if(json['error']){
                            toastr.error("{{___('Transaction Failed')}}");
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection