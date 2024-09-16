
<label for="id_{{$name}}">{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
<input id="id_{{$name}}" class="form-control @error($name) is-invalid @enderror @isset($class) {{$class}} @endisset" @isset($placeholder) placeholder="{{$placeholder}}" @endisset type="{{$type ?? 'text'}}" @isset($required) required @endisset @isset($disabled) disabled @endisset @isset($readonly) readonly @endisset name="{{$name}}" value="{{$value ?? old($name)}}">
{{ $slot }}
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
