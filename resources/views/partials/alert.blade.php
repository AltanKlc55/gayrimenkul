@push('css')
    <link href="{{asset('../assets/libs/toastr/css/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@push('javascript')

    <script src='{{asset("../assets/libs/toastr/js/toastr.min.js")}}'  type="text/javascript"></script>

    <script>
        $( document ).ready(function() {
            @if (session()->has('message'))
            toastr.{{session('message_type')}}("{{session('message')}}");
            @endif
        });
    </script>
@endpush