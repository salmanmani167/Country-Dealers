<div class="{{$class ?? 'checkbox'}}">
    <label @isset($id) for="{{$id}}" @endisset>
        <input @isset($id) id="{{$id}}" @endisset type="checkbox" class="{{$inputClass ?? ''}}@error($name) is-invalid @enderror" @isset($required) required @endisset name="{{$name}}"> {{$label}} @isset($required)<span class="text-danger">*</span>@endisset
    </label>
</div>
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
