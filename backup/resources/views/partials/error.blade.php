@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        @dd($error)
        <div class="alert alert-danger">{{$error}} </div>
    @endforeach
@endif