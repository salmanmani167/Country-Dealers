@extends('layouts.master')

@push('page-styles')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add_shift" class="btn add-btn"><i class="fa fa-plus"></i> Add Shift</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shift Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Created At</th>
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
<x-modals.modal id="add_shift" type="modal-lg">
    <x-slot:title>
        Add Shift
    </x-slot>
    <form action="{{route('shifts.index')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.input name="name" label="Shift Name"></x-form.input>
                </div>
            </div>
            <div class="col-md-4">
                <x-form.timepicker name="start" label="Start Time"></x-form.timepicker>
            </div>
            <div class="col-md-4">
                <x-form.timepicker name="end" label="End Time"></x-form.timepicker>
            </div>
            <div class="col-sm-12">
                <x-form.checkbox name="recurring" label="Recurring Shift"></x-form.checkbox>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.select name="weeks" label="Repeat Every">
                        <option value="1">1 </option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </x-form.select>
                    <label class="col-form-label">Week(s)</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3 wday-box">
                    <x-form.select class="multiple" multiple name="days[]" label="Repeat Every">
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                        <option value="7">Sunday</option>
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.datepicker class="datetimepicker" name="ends" label="Ends On"></x-form.datepicker>
                </div>
            </div>
            <div class="col-sm-12">
                <x-form.checkbox name="indefinite" label="Indefinite"></x-form.checkbox>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.input name="tag" label="Add Tag"></x-form.input>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.textarea name="note" label="Add Note"></x-form.textarea>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </div>

    </form>
</x-modals.modal>
<x-modals.modal id="edit_shift" type="modal-lg">
    <x-slot:title>
        Update Shift
    </x-slot>
    <form action="{{route('shifts.index')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" id="edit_id">
        <div class="row">
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.input name="name" id="edit_name" label="Shift Name"></x-form.input>
                </div>
            </div>
            <div class="col-md-4">
                <x-form.timepicker name="start" label="Start Time"></x-form.timepicker>
            </div>
            <div class="col-md-4">
                <x-form.timepicker name="end" label="End Time"></x-form.timepicker>
            </div>
            <div class="col-sm-12">
                <x-form.checkbox id="edit_recurring" name="recurring" label="Recurring Shift"></x-form.checkbox>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.select name="weeks" id="edit_weeks" label="Repeat Every">
                        <option value="1">1 </option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </x-form.select>
                    <label class="col-form-label">Week(s)</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3 wday-box">
                    <x-form.select class="multiple" id="edit_days" multiple name="days[]" label="Repeat Every">
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                        <option value="7">Sunday</option>
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.datepicker class="datetimepicker" name="ends" label="Ends On"></x-form.datepicker>
                </div>
            </div>
            <div class="col-sm-12">
                <x-form.checkbox id="edit_indefinite" name="indefinite" label="Indefinite"></x-form.checkbox>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.input name="tag" label="Add Tag"></x-form.input>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.textarea name="note" label="Add Note"></x-form.textarea>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </div>

    </form>
</x-modals.modal>
<x-modals.modal id="delete_shift">
    <div class="form-header">
        <h3>Delete Shift</h3>
        <p>Are you sure want to delete?</p>
    </div>
    <form method="post" action="{{route('shifts.index')}}">
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
                ajax: "{{route('shifts.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
            $('table').on('click', '.edit', function(){
                var shift = $(this).data('shift').model;
                $('#edit_shift').modal('show');
                var id  = shift.id;
                var name = shift.name;
                var start = shift.start_time;
                var end = shift.end_time;
                var recurring = shift.recurring;
                var days = shift.days;
                var weeks = shift.repeat_weeks;
                var indefinite = shift.indefinite;
                var tag = shift.tag;
                var note = shift.note;
                var ends = shift.ends_on;
                $('#edit_shift #edit_id').val(id);
                $('#edit_shift #id_name').val(name);
                $('#edit_shift #id_start').val(start);
                $('#edit_shift #id_end').val(min_end);
                if(recurring == 1){
                    $('#edit_shift #edit_recurring').attr('checked', true);
                }
                if(indefinite == 1){
                    $('#edit_shift #edit_indefinite').attr('checked', true);
                }
                $('#edit_shift #id_tag').val(tag);
                $('#edit_shift #id_note').val(note);
                $('#edit_shift #id_ends').val(ends);
                $('#edit_shift #edit_weeks').val(weeks).trigger('change');
                $('#edit_shift #edit_days').val(days).trigger('change');
            });
            $('table').on('click', '.trash_', function(){
                $('#delete_shift').modal('show');
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
