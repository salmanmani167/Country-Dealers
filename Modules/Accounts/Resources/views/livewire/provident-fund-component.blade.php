<div>
    <x-modals.modal type="{{empty($data['delete']) ? 'modal-lg': ''}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Provident Fund
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_emp" name="employee" label="Employee">
                            @foreach(($employees) as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_type" name="type" label="Provident Fund Type">
                            <option value="Fixed">Fixed Amount</option>
                            <option value="Percentage">Percentage of Basic Salary</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="show-fixed-amount">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="emp_amount" label="Employee Share (Amount)"></x-form.wire.input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="org_amount" label="Organization Share (Amount)"></x-form.wire.input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="show-basic-salary">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="emp_percent" label="Employee Share (%)"></x-form.wire.input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="org_percent" label="Organization Share (%)"></x-form.wire.input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description" rows="4"></x-form.wire.textarea>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Provident Fund</h3>
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
            Add Provident Fund
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="employee" label="Employee">
                            @foreach(($employees) as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="type" label="Provident Fund Type">
                            <option value="Fixed">Fixed Amount</option>
                            <option value="Percentage">Percentage of Basic Salary</option>
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="show-fixed-amount">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="emp_amount" label="Employee Share (Amount)"></x-form.wire.input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="org_amount" label="Organization Share (Amount)"></x-form.wire.input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="show-basic-salary">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="emp_percent" label="Employee Share (%)"></x-form.wire.input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-form.wire.input name="org_percent" label="Organization Share (%)"></x-form.wire.input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description" rows="4"></x-form.wire.textarea>
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
