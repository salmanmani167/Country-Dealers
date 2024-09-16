@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header :title="$title">
        <div class="col-auto float-right ml-auto">
            <a href="{{route('invoices.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Invoice</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <form action="" method="get">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" id="client" name="client">
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->company}}</option>
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
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
						<th>Invoice Number</th>
						<th>Client</th>
						<th>Invoice Date</th>
						<th>Due Date</th>
						<th>Amount</th>
						<th>Status</th>
						<th class="text-end">Action</th>
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
<livewire:accounts::invoice-component />
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            var $columns = [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'inv_id', name: 'inv_id'},
                {data: 'client', name: 'client'},
                {data: 'invoice_date', name: 'invoice_date'},
                {data: 'due_date', name: 'due_date'},
                {data: 'amount', name: 'amount'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ];
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('reports.invoice')}}",
                columns: $columns,
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            });

            $('form').on('click','#search_', function(e){
                e.preventDefault();
                var client = $('#client').val();
                var from = $('#from_date').val();
                var to = $('#to_date').val();
                $.get("{{route('reports.invoice')}}",{
                    client: client,
                    from: from,
                    to: to,
                }, function(e){
                    var invoices = e.data;
                    $('.datatable').DataTable({
                        data: invoices,
                        destroy: true,
                        columns: $columns,
                        initComplete: function(){
                            $('tr>td:last-child').addClass('text-right')
                        }
                    });
                });
            });
        })

    </script>
@endpush
