
@if($type != "link")
    <button type="{{$type}}"  id="{{!empty($id) ? $id : ''}}"
            @if($onclick)
                onclick="{{$onclick}}"
            @endif
            class="btn btn-{{$color}} btn-wave btn-sm waves-effect waves-light {{!empty($class) ? $class : ''}}">
        {{$title}}

        @if($icon)
            <i class="{{$icon}} ms-2 d-inline-block align-middle"></i>
        @endif
    </button>

@else
    <a href="{{$href}}"  id="{{!empty($id) ? $id : ''}}"
            @if($onclick)
                onclick="{{$onclick}}"
            @endif
                    target="_self"
            class="btn btn-primary btn-wave waves-effect waves-light {{!empty($class) ? $class : ''}}">
        {{$title}}

        @if($icon)
            <i class="{{$icon}} ms-2 d-inline-block align-middle"></i>
        @endif
    </a>

@endif