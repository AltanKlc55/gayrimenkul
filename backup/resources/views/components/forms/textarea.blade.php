<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">

    <label>{{$title}}</label>
    <textarea class="form-control tinymce" name="{{$name}}" >{{$entry}}</textarea>
    @if($errors->has($name))
        <span class="help-block">
            <strong>
                {{$errors->first($name)}}
            </strong>
        </span>
    @endif
</div>