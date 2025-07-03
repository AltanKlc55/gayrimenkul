<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">
    <label>{{$title}}</label>
    <p>{{!empty($description) ? $description : ''}}</p>
    <input type="{{$type}}" {{!empty($readonly) ? 'readonly' : ''}} {{!empty($disabled) ? 'disabled' : ''}} {{!empty($required) ? 'required' : ''}} {{!empty($attribute) ? $attribute : ''}}  class="form-control input-default  {{!empty($class) ? $class : ''}}" id="{{!empty($id) ? $id : ''}}" name="{{$name}}" value="{{$entry}}">
    @if($type == "file" and $entry != "")
    @if($filetype == "image")

        <div class="mt-20">
            <img class="img-fluid"  src="{{asset($path.$entry)}}">
        </div>

        @else
            <div class="mt-20">
                <a href="{{asset($path.$entry)}}" target="_blank">Dosyayı Görüntüle</a>
            </div>
    @endif
    @endif
    @if($errors->has($name))
        <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
    @endif
</div>