<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Overtime
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.select name="employee" label="Employee">
                    @foreach ($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input name="otd" type="date" label="Overtime Date"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="oth" label="Overtime Hours"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="ot_type" label="Overtime Type"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <x-form.wire.checkbox name="approved" label="Approved"></x-form.wire.checkbox>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Overtime</h3>
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
            Add Overtime
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.select name="employee" label="Employee">
                    @foreach ($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input name="otd" type="date" label="Overtime Date"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="oth" label="Overtime Hours"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="ot_type" label="Overtime Type"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
            </div>
            <div class="form-group">
                <x-form.wire.checkbox name="approved" label="Approved"></x-form.wire.checkbox>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
