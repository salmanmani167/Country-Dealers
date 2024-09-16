<div>
    <x-modals.modal type="{{!empty($data['delete']) ? '': 'modal-lg'}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update User
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="firstname" label="FirstName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="middlename" label="MiddleName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="lastname" label="LastName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="father_name" label="FatherName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="mother_name" label="MotherName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="spouse_name" label="SpouseName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="employee_code" label="Employee Code"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="username" label="UserName"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input type="email" name="email" label="Email"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="date_of_joining" label="Joining date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select wire:model="gender" class="form-control" id="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>   

                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>   
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="blood_group" label="Blood Group"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="religion" label="Religion"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="marital_status" label="Marital Status"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input type="date" name="marital_anniversary" label="Marital Anniversary"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="has_medical_insurance">Medical Insurance?</label>
                        <select wire:model="has_medical_insurance" class="form-control" id="has_medical_insurance">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @error('has_medical_insurance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="nationality" label="Nationality"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="pf_uan" label="PF UAN"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <x-form.wire.input name="esi" label="ESI"></x-form.wire.input>
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
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="role" label="Role">
                            @foreach(($roles) as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <x-form.wire.checkbox name="active" label="Active"></x-form.wire.checkbox>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete User <b>{{$username}}</b></h3>
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
            Add User
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
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="role" label="Role">
                            @foreach(($roles) as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <x-form.wire.checkbox name="active" label="Active"></x-form.wire.checkbox>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
