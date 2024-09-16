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
                ajax: "{{route('expenses')}}",
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

        })

    </script>
@endsection
