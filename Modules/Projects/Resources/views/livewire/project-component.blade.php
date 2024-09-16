<div>
    <!-- Create Project Modal -->
    <div id="create_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select class="select form-control select2" name="client">
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->user->firstname.' '.$client->user->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="starts_on">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" name="ends_on" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input placeholder="Rate in currency: 50" name="rate" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select class="select" name="rate_type">
                                        <option>Hourly</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select" name="priority">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Project Leader</label>
                                    <select class="select form-control select2" name="leader">
                                        <option>Select Project Leader</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="4" class="form-control summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" name="project_files[]" multiple type="file">
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Create Project Modal -->

    <!-- Edit Project Modal -->
    <div id="edit_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('projects.index')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="edit_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input class="form-control" type="text" id="edit_name" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select id="edit_client" class="form-control select2" name="client">
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->user->firstname.' '.$client->user->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon">
                                        <input id="edit_startdate" class="form-control datetimepicker" type="text" name="starts_on">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="cal-icon">
                                        <input id="edit_enddate" class="form-control datetimepicker" name="ends_on" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input id="edit_rate" placeholder="Rate in currency: 50" name="rate" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select class="select" id="edit_ratetype" name="rate_type">
                                        <option>Hourly</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select" id="edit_priority" name="priority">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Project Leader</label>
                                    <select class="select form-control" id="edit_leader" name="leader">
                                        <option>Select Project Leader</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Add Team</label>
                                    <select class="select select2" id="edit_team" multiple name="team[]">
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="edit_description" rows="4" class="form-control summernote" placeholder="Enter your message here"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" name="project_files[]" multiple type="file">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="edit_progress">Progress</label>
                                <input type="range" class="form-control-range form-range" name="progress" id="edit_progress">
                                <div class="mt-2"><b id="progress_result"></b></div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Project Modal -->

    <!-- Delete Project Modal -->
    <div class="modal custom-modal fade" id="delete_project" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Project</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <form action="{{route('projects.destroy')}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="id" id="delete_id">
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn w-100">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Project Modal -->
</div>

@push('page-scripts')
<script>
$(document).ready(function(){
    $('#teams').each(function(){
        $(this).select2({
            width: '100%'
        })
    });
    $('body').on('click','.editbtn',(function(){
        var project = $(this).data('project');
        var id = project.id;
        var name = project.name;
        var client = project.client_id;
        var startdate = project.starts_on;
        var enddate = project.ends_on;
        var rate = project.rate;
        var rate_type = project.rate_type;
        var priority = project.priority;
        var leader = project.leader_id;
        var team  = (project.team).map(item => item.employee_id);
        var description = project.description;
        var progress = project.progress;
        $('#edit_project').modal('show');
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_client').val(client).trigger('change');
        $('#edit_startdate').val(startdate);
        $('#edit_enddate').val(enddate);
        $('#edit_rate').val(rate);
        $('#edit_ratetype').val(rate_type).trigger('change');
        $('#edit_priority').val(priority).trigger('change');
        $('#edit_leader').val(leader).trigger('change');
        $('#edit_team').val(team).trigger('change');
        $('#edit_description').summernote('code', description);
        $('#edit_progress').val(progress);
        $('#progress_result').html("Progress Value: " + progress);
        $('#edit_progress').change(function(){
            $('#progress_result').html("Progress Value: " + $(this).val());
        });
    }));
    $('body').on('click','.deletebtn',(function(){
        var id = $(this).data('id');
        $('#delete_project').modal('show');
        $('#delete_id').val(id);
    }));
});
</script>
@endpush
