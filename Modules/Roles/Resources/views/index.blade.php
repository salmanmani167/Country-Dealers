@extends('layouts.master')

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Roles & Permissions</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
            <div class="roles-menu">
                <ul>
                    @foreach ($roles as $role)
                    <li class="{{($role->id == $selected_role->id) ? 'active': ''}}">
                        <a href="{{route('roles.index', $role->id)}}">{{$role->name}}
                            <span class="role-action">
                                <span class="action-circle large edit_role" data-id="{{$role->id}}" data-name="{{$role->name}}">
                                    <i class="material-icons">edit</i>
                                </span>
                                <span class="action-circle large delete-btn" data-id="{{$role->id}}">
                                    <i class="material-icons">delete</i>
                                </span>
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
            <div class="table-responsive">
                <form action="{{route('permissions.update', $selected_role->id)}}" method="post">
                    @csrf
                    <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Module Permission</th>
                                <th class="text-center">Create</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Read</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $module => $permission)
                                @php
                                    sort($permission);
                                @endphp
                            <tr>
                                <td>{{ucwords($module)}}</td>
                                @foreach ($permission as $key => $item)
                                <td class="text-center">
                                    <input type="checkbox" name="permissions[]" value="{{$item}}"
                                    @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                        {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                    @endif>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (!empty($selected_role) && ($selected_role->permissions->count() > 0))
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Update</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('modals')
    <!-- Add Role Modal -->
    <div id="add_role" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('roles.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Role Modal -->

    <!-- Edit Role Modal -->
    <div id="edit_role" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('roles.update')}}">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="edit_name">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Role Modal -->

    <!-- Delete Role Modal -->
    <div class="modal custom-modal fade" id="delete_role" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Role</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <form action="{{route('roles.destroy')}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" id="delete_id" name="id">
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
    <!-- /Delete Role Modal -->
@endpush


@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('body').on('click','.edit_role', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#edit_role').modal('show');
                $('#edit_id').val(id);
                $('#edit_name').val(name);
            })
            $('body').on('click','.delete-btn', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $('#delete_role').modal('show');
                $('#delete_id').val(id);
            })
        })
    </script>
@endpush
