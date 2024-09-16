<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Leave
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.select name="type" label="Leave Type">
                    @foreach(($leave_types) as $leave_type)
                        <option value="{{ $leave_type->id }}">{{ $leave_type->type }}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.select name="employee" label="Employee">
                    @foreach(($employees) as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input name="starts" type="date" label="From"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="ends" type="date" label="To"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="days" readonly="" label="Number of Days"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="days_left" readonly="" label="Remaining Days"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="reason" label="Reason"></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <x-form.wire.select name="status" label="Status">
                    <option value="New">New</option>
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
                    <option value="Pending">Pending</option>
                </x-form.wire.select>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Leave <b>{{$type}}</b></h3>
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
            Add Leave
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.select name="type" label="Leave Type">
                    @foreach(($leave_types) as $leave_type)
                        <option value="{{ $leave_type->id }}">{{ $leave_type->type }}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.select name="employee" label="Employee">
                    @foreach(($employees) as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input name="starts" type="date" label="From"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="ends" type="date" label="To"></x-form.wire.input>
            </div>

            <div class="form-group">
                <x-form.wire.textarea name="reason" label="Reason"></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <x-form.wire.select name="status" label="Status">
                    <option value="New">New</option>
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
                    <option value="Pending">Pending</option>
                </x-form.wire.select>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
