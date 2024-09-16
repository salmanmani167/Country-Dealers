@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header :title="$title">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Expense</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <form action="" method="get">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" id="buyer" name="buyer">
                        <option value="">Select buyer</option>
                        @foreach(($users) as $user)
                            <option {{(request()->buyer == $user->id) ? 'selected': ''}} value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                        @endforeach
                    </select>
                    <label class="focus-label">Purchased By</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" id="from_date" name="from" value="{{request()->from}}">
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" id="to_date" name="to" value="{{request()->to}}">
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button id="search_" type="button" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
    </form>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped custom-table w-100 mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Purchase From</th>
                        <th>Purchase Date</th>
                        <th>Purchased By</th>
                        <th>Amount</th>
                        <th>Paid By</th>
                        <th class="text-center">Status</th>
                        <th class="text-right">Action</th>
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
<livewire:accounts::expense-component />
@endpush

@section('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('reports.expense')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'purchased_from', name: 'purchased_from'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'buyer', name: 'buyer'},
                    {data: 'amount', name: 'amount'},
                    {data: 'paid_by', name: 'paid_by'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })

            $('form').on('click','#search_', function(e){
                e.preventDefault();
                var buyer = $('#buyer').val();
                var from = $('#from_date').val();
                var to = $('#to_date').val();
                $.get("{{route('reports.expense')}}",{
                    buyer: buyer,
                    from: from,
                    to: to,
                }, function(e){
                    var expenses = e.data;
                    $('.datatable').DataTable({
                        data: expenses,
                        destroy: true,
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'name', name: 'name'},
                            {data: 'purchased_from', name: 'purchased_from'},
                            {data: 'purchase_date', name: 'purchase_date'},
                            {data: 'buyer', name: 'buyer'},
                            {data: 'amount', name: 'amount'},
                            {data: 'paid_by', name: 'paid_by'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ],
                        initComplete: function(){
                            $('tr>td:last-child').addClass('text-right')
                        }
                    });
                });
            });
        });

    </script>
@endsection
