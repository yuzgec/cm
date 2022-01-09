<label class="form-label">{{$label}}</label>
{{Form::password($name, ["class" => $class . (($errors->has($name))?" is-invalid":"")])}}
@if($errors->has($name))
    <div class="invalid-feedback">{{$errors->first($name)}}</div>
@endif
