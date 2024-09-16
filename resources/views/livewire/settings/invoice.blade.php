<div>
    <form wire:submit.prevent="update" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Invoice prefix</label>
            <div class="col-lg-9">
                <input class="form-control @error('prefix') is-invalid @enderror" wire:model.defer="prefix" type="text">
                @error('prefix')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Invoice Logo</label>
            <div class="col-lg-7">
                <input type="file" class="form-control @error('logo') is-invalid @enderror" wire:model.defer="logo">
                @error('logo')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="form-text text-muted">Recommended image size is 200px x 40px</span>
            </div>
            <div class="col-lg-2">
                <div class="img-thumbnail float-end">
                    @if(is_object($logo) && !empty($logo->temporaryUrl()))
                    <img src="{{$logo->temporaryUrl()}}" class="img-fluid" alt="logo" width="140" height="40">
                    @else
                    <img src="{{!empty($logo) ? asset('storage/settings/invoice/'.$logo): asset('assets/img/logo3.png')}}" class="img-fluid" alt="logo" width="140" height="40">
                    @endif
                </div>
            </div>
        </div>

        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Save</button>
        </div>
    </form>
</div>
