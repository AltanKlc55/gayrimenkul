@if($type == "hidden")
    <input type="{{$type}}"
        name="{{$name}}"
        value="{{(isset($entry) and !empty($entry)) ? $entry : ''}}"
    >
@else
<div class="form-group mb-3  {{($type == 'hidden') ? 'hidden' : ''}} {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">
    <label>{{$title}}</label>
    @if(!empty($description))
       <p>{{ $description }}</p>
    @endif
<div class="row align-items-end">
    <div class="{{$type == "file" ? 'col-md-10' : ''}}">
        <input type="{{$type}}" {{!empty($readonly) ? 'readonly' : ''}} {{!empty($disabled) ? 'disabled' : ''}}
        @if($entry == "" and $type !="password")
            {{!empty($required) ? 'required' : ''}}
        @endif

        {{!empty($attribute) ? $attribute : ''}}  class="form-control input-default  {{!empty($class) ? $class : ''}}" id="{{!empty($id) ? $id : ''}}"
               @if(isset($multilang) and $multilang == true)
                   name="{{$name}}[{{$lang}}]"
               value="{{(isset($entry) and !empty($entry)) ? $entry : ''}}"
               @else
                   name="{{$name}}"
               value="{{($type !="password") ? $entry : ''}}"
                @endif
        >

    </div>
    @if($type == "file" and $entry != "")
    <div class="col-md-2">
            @if($filetype == "image")
                    <a class="btn btn-sm btn-info" href="{{asset($path.$entry)}}" target="_blank"> <i class="ri-eye-line"></i>
                    </a>
            @else
                    <a class="btn btn-sm btn-info" href="{{asset($path.$entry)}}" target="_blank"><i class="ri-eye-line"></i></a>
            @endif
    </div>
    @endif

</div>
    @if($errors->has($name))
        <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
    @endif
</div>
@endif
