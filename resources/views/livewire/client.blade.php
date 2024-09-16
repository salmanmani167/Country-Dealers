<div>
    <x-modals.modal type="{{!empty($data['delete']) ? '': 'modal-lg'}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Individual
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="firstname" label="FirstName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="lastname" label="LastName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="username" label="UserName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="clt_id" label="Client ID"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="email" name="email" label="Email"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="phone" label="Phone"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.file name="avatar" label="Avatar"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="password" name="password" label="Password"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="password" name="password_confirmation" label="Confirm Password"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="company" label="Service Cordinator"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select id="edit_employee" name="employee" label="Staff">
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->user->firstname.' '. $employee->user->lastname}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-3">
                    <x-form.wire.checkbox name="active" label="Active"></x-form.wire.checkbox>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Individual <b>{{$username}}</b></h3>
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
            Add Individual
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="firstname" label="FirstName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="lastname" label="LastName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="username" label="UserName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="clt_id" label="Client ID"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="email" name="email" label="Email"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="phone" label="Phone"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.file name="avatar" label="Avatar"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="password" name="password" label="Password"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input type="password" name="password_confirmation" label="Confirm Password"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-form.wire.input name="company" label="Service Cordinator"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.select name="employee" label="Staff">
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->user->firstname.' '. $employee->user->lastname}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <x-form.wire.checkbox name="active" label="Active"></x-form.wire.checkbox>
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
