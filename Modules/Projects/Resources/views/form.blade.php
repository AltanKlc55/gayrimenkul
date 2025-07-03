@extends('form')
@section('title') {{$page['title']}} @endsection
@section('css')
@endsection

@section('button')
    <button class="btn btn-sm btn-success" form="form">Kaydet<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
@endsection



@section('add_javascript')


        <script>
            $(document).ready(function () {
                $('.repeater').repeater( );
            });
        </script>
        <script src="{{ asset('assets/js/jquery.repeater.min.js') }}"></script>

    {{--@include('backend.partials.tinymce')--}}

@endsection