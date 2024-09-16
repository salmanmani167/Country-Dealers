<div>
    <x-modals.modal id="personal_info_modal" type="modal-lg">
        <x-slot:title>
            Personal Information
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="ssn" label="SSN ID" required=""></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="passport" label="Passport NO" required=""></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="expiry_date" type="date" label="Passport Expiry Date" required=""></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="tel" label="Tel" required=""></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="nationality" label="Nationality" required=""></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="religion" label="Religion"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select name="marital_stat" label="Marital Status">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="spouse_job" label="Spouse Employement"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="children" label="No Of Children"></x-form.wire.input>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </x-modals.modal>
</div>
