<div class="{{$class ?? 'checkbox'}}">
    <label>
        <input type="checkbox" class="{{$inputClass ?? ''}}@error($name) is-invalid @enderror" @isset($required) required @endisset wire:model.defer="{{$name}}"> {{$label}} @isset($required)<span class="text-danger">*</span>@endisset
    </label>
</div>
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
