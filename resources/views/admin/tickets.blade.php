@extends('layouts.master')

@push('page-styles')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add_ticket" class="btn add-btn"><i class="fa fa-plus"></i> Add Ticket</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticket Id</th>
                        <th>Ticket Subject</th>
                        <th>Client</th>
                        <th>Assigned Staff</th>
                        <th>Created Date</th>
                        <th>Priority</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@push('modals')
<x-modals.modal id="add_ticket" type="modal-lg">
    <x-slot:title>
        Add Ticket
    </x-slot>
    <form action="{{route('tickets')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="subject" label="Ticket Subject"></x-form.input>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="tk_id" label="Ticket ID" placeholder="leave empty to autogenerate"></x-form.input>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select name="assigned_to" label="Assign Staff">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select name="client" label="Client">
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->user->firstname.' '.$client->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select name="priority" label="Priority">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="cc" label="CC"></x-form.input>
                </div>
            </div>
            <div class="col-12">
                <div class="input-block mb-3 wday-box">
                    <x-form.select class="followers" multiple name="followers[]" label="Followers">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.textarea name="description" label="Description"></x-form.textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.file name="uploaded_files[]" label="Files"></x-form.file>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </div>

    </form>
</x-modals.modal>
<x-modals.modal id="edit_ticket" type="modal-lg">
    <x-slot:title>
        Update Ticket
    </x-slot>
    <form action="{{route('tickets')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" id="edit_id">
        <div class="row">
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="subject" label="Ticket Subject"></x-form.input>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="tk_id" label="Ticket ID" placeholder="leave empty to autogenerate"></x-form.input>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select id="edit_assigned" name="assigned_to" label="Assign Staff">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select id="edit_client" name="client" label="Client">
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->user->firstname.' '.$client->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.select id="edit_priority" name="priority" label="Priority">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.input name="cc" label="CC"></x-form.input>
                </div>
            </div>
            <div class="col-12">
                <div class="input-block mb-3 wday-box">
                    <x-form.select id="edit_followers" class="followers" multiple name="followers[]" label="Followers">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.textarea name="description" label="Description"></x-form.textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.file name="uploaded_files[]" label="Files"></x-form.file>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </div>
    </form>
</x-modals.modal>
<x-modals.modal id="delete_ticket">
    <div class="form-header">
        <h3>Delete Ticket</h3>
        <p>Are you sure want to delete?</p>
    </div>
    <form method="post" action="{{route('tickets')}}">
        @csrf
        @method("DELETE")
        <input type="hidden" name="id" id="delete_id">
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
</x-modals.modal>
@endpush

@push('page-scripts')
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('tickets')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'tk_id', name: 'tk_id'},
                    {data: 'subject', name: 'subject'},
                    {data: 'client', name: 'client'},
                    {data: 'assigned_staff', name: 'assigned_staff'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'priority', name: 'priority'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
            $('table').on('click', '.edit', function(){
                var ticket = $(this).data('ticket').model;
                $('#edit_ticket').modal('show');
                var id  = ticket.id;
                var subject = ticket.subject;
                var tk_id = ticket.tk_id;
                var assigned_to = ticket.assigned_to;
                var client = ticket.client_id;
                var followers = ticket.followers;
                var priority = ticket.priority;
                var cc = ticket.cc;
                var description = ticket.description;
                $('#edit_ticket #edit_id').val(id);
                $('#edit_ticket #id_tk_id').val(tk_id);
                $('#edit_ticket #id_subject').val(subject);
                $('#edit_ticket #edit_assigned').val(assigned_to.id).trigger('change');
                $('#edit_ticket #edit_client').val(client).trigger('change');
                $('#edit_ticket #edit_followers').val(followers).trigger('change');
                $('#edit_ticket #edit_priority').val(priority).trigger('change');
                $('#edit_ticket #id_description').val(description);
                $('#edit_ticket #id_cc').val(cc);
            });
            $('table').on('click', '.trash_', function(){
                $('#delete_ticket').modal('show');
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
            if($('.timepicker').length > 0) {
                $('.timepicker').datetimepicker({
                    format: "hh:mm:ss",
                    icons: {
                        up: "fa fa-angle-up",
                        down: "fa fa-angle-down",
                        next: 'fa fa-angle-right',
                        previous: 'fa fa-angle-left'
                    }
                });
            }
            $('.multiple').select2({
                width: "100%"
            });
        })

    </script>
@endpush
