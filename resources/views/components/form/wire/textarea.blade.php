
<label for="id_{{$name}}">{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
<textarea id="id_{{$name}}" class="form-control @error($name) is-invalid @enderror" rows="{{ $rows ?? '4'}}" @isset($required) required @endisset wire:model.defer="{{$name}}"> {{$placeholder ?? old($name)}}</textarea>
{{ $slot }}
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
