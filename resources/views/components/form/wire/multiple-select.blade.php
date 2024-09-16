
<label class="col-form-label" for="{{$id ?? 'id_'.$name}}">{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
<select class="select form-control @error($name) is-invalid @enderror" @isset($required) required @endisset wire:model="{{$name}}" id="{{$id ?? 'id_'.$name}}" multiple>
    {{ $slot }}
</select>
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
