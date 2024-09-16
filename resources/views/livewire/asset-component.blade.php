<div>
    <x-modals.modal type="{{empty($data['delete']) ? 'modal-md': ''}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Asset
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="name" label="Asset Name"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="ast_id" label="Asset Id"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="purchase_date" type="date" label="Purchase Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="purchase_from" label="Purchase From"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="manufacturer" label="Manufacturer"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="model" label="Model"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="serial_no" label="Serial Number"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="supplier" label="Supplier"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="condition" label="Condition"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="warranty" label="Warranty"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="value" label="Value"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_user" name="user" label="Asset User">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->firstname.' '.$user->lastname}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_status" name="status" label="Status">
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                            <option value="returned">Returned</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Asset</h3>
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
            Add Asset
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="name" label="Asset Name"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="ast_id" label="Asset Id"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="purchase_date" type="date" label="Purchase Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="purchase_from" label="Purchase From"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="manufacturer" label="Manufacturer"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="model" label="Model"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="serial_no" label="Serial Number"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="supplier" label="Supplier"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="condition" label="Condition"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="warranty" label="Warranty"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="value" label="Value"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select name="user" label="Asset User">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->firstname.' '.$user->lastname}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select name="status" label="Status">
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                            <option value="returned">Returned</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
