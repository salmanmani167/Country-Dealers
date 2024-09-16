
<label>{{$label}} @isset($required)<span class="text-danger">*</span>@endisset</label>
<div class="custom-file">
    <input type="file" class="custom-file-input @error($name) is-invalid @enderror" id="policy_upload" @isset($required) required @endisset name="{{$name}}">
    <label class="custom-file-label" for="policy_upload">Choose file</label>
</div>
{{ $slot }}
@error($name)
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror



