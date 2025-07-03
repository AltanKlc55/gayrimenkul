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


        <script>
            function get_child(id){
                $.ajax({
                    type: "get",
                    url: "{{route('collection.child')}}",
                    data: {id:id},
                    dataType: 'json',
                    success: function(json){
                        if(json){
                            $('#project').html(json);
                        }
                    }
                });
            }


            $( document ).ready(function() {
                @if(isset($page['row']->id))
                $.ajax({
                    type: "get",
                    url: "{{route('collection.child')}}",
                    data: {id: {{$page['row']->group_id}},selected:{{$page['row']->child_id}}},
                    dataType: 'json',
                    success: function(json){
                        if(json){
                            $('#project').html(json);
                        }
                    }
                });
                @endif

            });
        </script>

@endsection