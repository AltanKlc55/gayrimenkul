@extends('master')

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
                            @yield('button')
                        </div>
                    </div>
                    <div class="card-body">

                        @include('partials.form')



                    </div>
            </div>
    </div>
</div>
<!--End::row-1 -->
@push('javascript')
    @yield('add_javascript')
    <!-- Select2 Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( document ).ready(function() {
        $("select").select2({
            placeholder: "<?= ___('Choose') ?>"
        });
        });

        
    </script>
@endpush
@endsection