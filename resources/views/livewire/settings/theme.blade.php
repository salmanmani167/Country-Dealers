<div>
    <form wire:submit.prevent="update" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Website Name</label>
            <div class="col-lg-9">
                <input class="form-control @error('site_name') is-invalid @enderror" wire:model.defer="site_name" type="text">
                @error('site_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Logo</label>
            <div class="col-lg-7">
                <input type="file" class="form-control @error('logo') is-invalid @enderror" wire:model.defer="logo">
                @error('logo')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="form-text text-muted">Recommended image size is 40px x 40px</span>
            </div>
            <div class="col-lg-2">
                <div class="img-thumbnail float-end">
                    @if(is_object($logo) && !empty($logo->temporaryUrl()))
                    <img src="{{$logo->temporaryUrl()}}" alt="logo" width="40" height="40">
                    @else
                    <img src="{{!empty($logo) ? asset('storage/settings/theme/'.$logo): asset('assets/img/logo2.png')}}" alt="logo" width="40" height="40">
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Favicon</label>
            <div class="col-lg-7">
                <input type="file" wire:model.defer="favicon" class="form-control @error('favicon') is-invalid @enderror">
                @error('favicon')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="form-text text-muted">Recommended image size is 16px x 16px</span>
            </div>
            <div class="col-lg-2">
                <div class="settings-image img-thumbnail float-end">
                    @if(is_object($favicon) && !empty($favicon->temporaryUrl()))
                    <img src="{{ $favicon->temporaryUrl() }}" class="img-fluid" width="16" height="16" alt="favicon">
                    @else
                    <img src="{{ !empty($favicon) ? asset('storage/settings/theme/'.$favicon):asset('assets/img/logo2.png') }}" class="img-fluid" width="16" height="16" alt="favicon">
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <label class="form-label">Currency Code</label>
                <input type="text" wire:model.defer="currency_code" class="form-control @error('currency_code') is-invalid @enderror" placeholder="USD">
                @error('currency_code')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label">Currency Symbol</label>
                <input type="text" wire:model.defer="currency_symbol" class="form-control @error('currency_symbol') is-invalid @enderror" placeholder="$">
                @error('currency_symbol')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Save</button>
        </div>
    </form>
</div>
