
<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">
    <div class="form-check form-switch">
        <input id="{{!empty($name) ? $name : ''}}" type="radio" class="form-check-input"  {{(!empty($checked)) ? 'checked' : ''}} {{(!empty($readonly)) ? 'readonly' : ''}} {{(!empty($disabled)) ? 'disabled' : ''}} {{(!empty($required)) ? 'required' : ''}} {{!empty($attribute) ? $attribute : ''}} name="{{$name}}" value="{{$entry}}"  >

        <label class="form-check-label" for="{{$name}}">{{$title}}</label>

        @if($errors->has($name))
            <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
        @endif
    </div>
</div>