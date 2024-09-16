
<div class="input-block mb-3">
    <label for="id_{{$name}}" class="col-form-label">{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
    <div class="input-group time">
        <input id="id_{{$name}}" @isset($placeholder) placeholder="{{$placeholder}}" @endisset class="form-control timepicker @error($name) is-invalid @enderror @isset($class) {{$class}} @endisset" @isset($required) required @endisset @isset($disabled) disabled @endisset @isset($readonly) readonly @endisset name="{{$name}}" value="{{$value ?? old($name)}}">
        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
        {{ $slot }}
    </div>
    @error($name)
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
