<label class="form-label">{{$label}}</label>
{{Form::text($name, null, ["class" => $class . (($errors->has($name))?" is-invalid":""),"picker" => "date", "date-picker" => str_replace(["[","]"], ["_",""], $name), "id" => str_replace(["[","]"], ["_",""], $name)])}}
@if($errors->has($name))
    <div class="invalid-feedback">{{$errors->first($name)}}</div>
@endif
