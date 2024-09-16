<div>
    <x-modals.modal id="emergency_contact_info_modal" type="modal-lg">
        <x-slot:title>
            Personal Information
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Primary Contact</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="p_name" label="Name" required=""></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="p_relation" label="Relationship" required=""></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="p_phone" label="Phone" required=""></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="p_phone2" label="Phone 2"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Secondary Contact</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="s_name" label="Name"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="s_relation" label="Relationship"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="s_phone" label="Phone"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-form.wire.input name="s_phone2" label="Phone 2"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </x-modals.modal>
</div>
