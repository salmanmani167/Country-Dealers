<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Agency
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.input name="name" label="Agency Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="contact" label="Contact Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="phone" label="Phone" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="address" label="Address" rows=""></x-form.wire.textarea>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Agency <b>{{$name}}</b></h3>
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
            Add Agency
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.input name="name" label="Agency Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="contact" label="Contact Name" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="phone" label="Phone" required></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="address" label="Address" rows=""></x-form.wire.textarea>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
