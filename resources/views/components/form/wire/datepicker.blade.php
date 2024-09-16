
<label for="id_{{$name}}">{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
<div class="cal-icon"><input id="id_{{$name}}" class="form-control datepicker @error($name) is-invalid @enderror" @isset($placeholder) placeholder="{{$placeholder}}" @endisset type="{{$type ?? 'text'}}" @isset($required) required @endisset wire:model.defer="{{$name}}"></div>
{{ $slot }}
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
