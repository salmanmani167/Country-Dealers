<div>
    <x-modals.modal type="{{!empty($data['delete']) ? '': 'modal-lg'}}">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Project
        </x-slot>
        <form wire:submit.prevent="update">

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
            <div class="form-header">
                <h3>Delete Project <b>{{$name}}</b></h3>
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
            Add Project
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.input name="name" label="Project Name"></x-form.wire.input>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.select name="client" label="Clients">
                                @foreach(($clients) as $client)
                                    <option value="{{ $client->id }}">{{ $client->user->firstname.' '.$client->user->lastname }}</option>
                                @endforeach
                            </x-form.wire.select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.input name="starts_on" type="date" label="Start Date"></x-form.wire.input>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.input name="ends_on" type="date" label="End Date"></x-form.wire.input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <x-form.wire.input name="rate" label="Rate"></x-form.wire.input>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <x-form.wire.select name="rate_type" label="Rate Type">
                                <option value="Hourly">Hourly</option>
                                <option value="Fixed">Fixed</option>
                            </x-form.wire.select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <x-form.wire.select name="priority" label="Priority">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </x-form.wire.select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.select name="leader" label="Project Leader">
                                @foreach(($employees) as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                                @endforeach
                            </x-form.wire.select>
                        </div>
                    </div>
                    {{-- <div class="col-6">
                        <div class="form-group">
                            <x-form.wire.multiple-select name="team" id="teams" multiple label="Add Team">
                                @foreach(($employees) as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->firstname.' '.$employee->user->lastname }}</option>
                                @endforeach
                            </x-form.wire.multiple-select>
                        </div>
                    </div> --}}
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Add Team</label>
                            <select class="select form-control select2" multiple name="team[]">
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="col-form-group">
                        <x-form.wire.file name="files" label="Files"></x-form.wire.file>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-form.wire.select name="status" label="Status">
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Working">Working</option>
                        </x-form.wire.select>
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


