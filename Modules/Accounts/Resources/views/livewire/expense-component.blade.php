<div>
    <x-modals.modal type="{{empty($data['delete']) ? 'modal-lg': ''}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Expense
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="name" label="Item Name"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="seller" label="Purchase From"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input id="edit_date" name="date" type="date" label="Purchase Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_user" name="user" label="Purchase By">
                            @foreach(($users) as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="amount" label="Amount"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_pmethod" name="payment_method" label="Paid By">
                            <option>Cash</option>
                            <option>Cheque</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_status" name="status" label="Status">
                            <option>Pending</option>
                            <option>Approved</option>
                        </x-form.wire.select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.file name="file" label="Attachment"></x-form.wire.file>
                    </div>
                </div>

            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Expense</h3>
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
            Add Expense
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="name" label="Item Name"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="seller" label="Purchase From"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="date" type="date" label="Purchase Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="user" label="Purchase By">
                            @foreach(($users) as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.input name="amount" label="Amount"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="payment_method" label="Paid By">
                            <option>Cash</option>
                            <option>Cheque</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="status" label="Status">
                            <option>Pending</option>
                            <option>Approved</option>
                        </x-form.wire.select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.file name="file" label="Attachment"></x-form.wire.file>
                    </div>
                </div>

            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>

    @push('page-scripts')
        <script>
            $('.select').select2({
                width: "100%"
            });
        </script>
    @endpush
</div>
