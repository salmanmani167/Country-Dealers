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
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('invoices.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'inv_id', name: 'inv_id'},
                    {data: 'client', name: 'client'},
                    {data: 'invoice_date', name: 'invoice_date'},
                    {data: 'due_date', name: 'due_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
        })

    </script>
@endpush
