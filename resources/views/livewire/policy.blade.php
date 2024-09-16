<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Policy
        </x-slot>
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="form-group">
                <x-form.wire.input name="name" label="Policy Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="description" label="Description" required></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <label class="col-form-label @error('department') is-invalid @enderror">Department</label>
                <select class="select form-control" required wire:model.defer="department">
                   @foreach ($departments as $department)
                       <option value="{{$department->id}}">{{$department->name}}</option>
                   @endforeach
                </select>
                @error('department')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <x-form.wire.file name="file" label="Upload Policy"></x-form.wire.textarea>
            </div>

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Policy <b>{{$name}}</b></h3>
            <p>Are you sure want to delete?</p>
        </div>
        <form wire:submit.prevent="delete">
            <div class="modal-btn delete-action">
                <div class="row">
                    <div class="col-6">
                        <button type="submit"  class="btn btn-primary w-100 continue-btn">Delete</button>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
        @else
        <x-slot:title>
            Add Policy
        </x-slot>
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="form-group">
                <x-form.wire.input name="name" label="Policy Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="description" label="Description" required></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <label class="col-form-label @error('department') is-invalid @enderror">Department</label>
                <select class="select form-control" required wire:model.defer="department">
                   @foreach ($departments as $department)
                       <option value="{{$department->id}}">{{$department->name}}</option>
                   @endforeach
                </select>
                @error('department')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <x-form.wire.file name="file" label="Upload Policy" required></x-form.wire.textarea>
            </div>

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
