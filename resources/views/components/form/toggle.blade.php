<div class="input-block mb-3">
    <label @isset($id) for="{{$id}}" @endisset class="col-form-label {{$inputClass ?? ''}} @error($name) is-invalid @enderror">{{$label}}</label>
    <div class="form-check form-switch">
        <input type="checkbox" @isset($required) required @endisset name="{{$name}}" class="form-check-input {{$inputClass ?? ''}} @error($name) is-invalid @enderror" @isset($id) id="{{$id}}" @endisset checked="">
        <label class="form-check-label" @isset($id) for="{{$id}}" @endisset>{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
    </div>
</div>
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror
