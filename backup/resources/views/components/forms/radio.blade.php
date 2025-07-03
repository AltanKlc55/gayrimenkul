<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">


<div class="custom-control custom-checkbox mb-3">
        <input type="radio" class="custom-control-input"  {{(isset($checked)) ? 'checked' : ''}} {{(isset($disabled)) ? 'disabled' : ''}} {{(isset($required)) ? 'required' : ''}} {{!empty($attribute) ? $attribute : ''}} name="{{$name}}" value="{{$value}}" >
        <label class="custom-control-label" for="{{$name}}">{{$title}}</label>
    </div>
    @if($errors->has($name))
        <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
    @endif
</div>