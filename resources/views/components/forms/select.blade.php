<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">

    <label>{{$title}}</label>
    @if(!empty($description))
        <p>{{ $description }}</p>
    @endif
    @php $optname =  (isset($child) and !empty($child)) ? $child : 'name' @endphp

    <select  class="form-control  {{!empty($class) ? $class : ''}}"  {{!empty($multiple) ? 'multiple' : ''}} {{!empty($tags) ? 'tags=true' : ''}}  id="{{!empty($id) ? $id : ''}}" {!!  !empty($attribute) ? $attribute : '' !!}
    name="{{!empty($multiple) ? $name."[]" : $name }}">


        <option></option>
        @if(is_array($options) and !empty($options))
            @foreach($options as $option)


                @if(isset($format) && $format == "select_json")

                    @if(in_array($option['id'],$selected))
                        @php

                            $is_select = "selected";
                        @endphp
                    @else
                        @php
                            $is_select = "";
                        @endphp
                    @endif

                @else
                    @php
                        $is_select = ($selected == $option['id']) ? 'selected' : '';
                    @endphp

                @endif

                <option value="{{$option['id']}}" {{$is_select}}>
                    @if(is_array(json_decode($option[$optname],true)))
                        {{getlanguage($option[$optname],get_language())}}
                    @else
                        {{$option[$optname]}}
                    @endif
                </option>
            @endforeach
        @endif

    </select>
    @if($errors->has($name))
        <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
    @endif
</div>