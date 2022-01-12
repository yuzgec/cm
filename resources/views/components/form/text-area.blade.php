<label class="form-label">{{$label}}</label>
{{Form::textarea($name, null, ["class" => $class . (($errors->has($name))?" is-invalid":""), "rows" => $row])}}
@if($errors->has($name))
    <div class="invalid-feedback">{{$errors->first($name)}}</div>
@endif
