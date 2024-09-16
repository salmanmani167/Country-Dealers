<div>
    <x-modals.modal id="goal_type_modal">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Goal Tracking
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="type" label="Goal Type">
                            @foreach ($goal_types as $goal_type)
                                <option value="{{$goal_type->id}}">{{$goal_type->type}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="subject" label="Subject"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="target" label="Target Archievement"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="starts" type="date" label="Start Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="ends" type="date" label="End Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label>Progress</label>
                        <input type="range" wire:model="progress" min="0" max="100" class="form-control-range custom-range">
                        <div class="mt-2">Progress Value: <b>{{$progress}}</b></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="status" label="Status">
                            <option value="Active">Active</option>
                            <option value="InActive">InActive</option>
                        </x-form.wire.select>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Goal Tracking</h3>
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
            Add Goal Tracking
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="type" label="Goal Type">
                            @foreach ($goal_types as $goal_type)
                                <option value="{{$goal_type->id}}">{{$goal_type->type}}</option>
                            @endforeach
                        </x-form.wire.select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="subject" label="Subject"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="target" label="Target Archievement"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="starts" type="date" label="Start Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.wire.input name="ends" type="date" label="End Date"></x-form.wire.input>
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label>Progress</label>
                        <input type="range" wire:model="progress" min="0" max="100" class="form-control-range custom-range">
                        <div class="mt-2">Progress Value: <b>{{$progress}}</b></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.textarea name="description" label="Description"></x-form.wire.textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-form.wire.select name="status" label="Status">
                            <option value="Active">Active</option>
                            <option value="InActive">InActive</option>
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
