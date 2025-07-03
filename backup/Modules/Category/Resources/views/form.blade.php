@extends('form')
@section('title') {{$page['title']}} @endsection
@section('css')
@endsection

@section('button')
    <button class="btn btn-sm btn-primary-light" form="form">Kaydet<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
@endsection

@section('javascript')

    {{--@include('backend.partials.tinymce')--}}

@endsection