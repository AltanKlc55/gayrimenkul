<div class="form-group mb-3  {{!empty($grid) ? $grid : ''}} {{$errors->has($name) ? 'has-error' : ''}}">

    <label>{{$title}}</label>
    <p>{{!empty($description) ? $description : ''}}</p>

    <select  class="form-control  {{!empty($class) ? $class : ''}}" {{!empty($multiple) ? 'multiple' : ''}} {{!empty($tags) ? 'tags=true' : ''}}  id="{{!empty($id) ? $id : ''}}" {{!empty($attribute) ? $attribute : ''}}    name="{{$name}}">
        <option value="">Seçiniz...</option>
        {{drawElements(buildCates($options),json_encode([$selected]),0,"")}}
    </select>
    @if($errors->has($name))
        <span class="help-block">
        <strong>
            {{$errors->first($name)}}
        </strong>
    </span>
    @endif
</div>