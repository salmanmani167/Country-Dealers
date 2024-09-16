@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Asset</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 w-100 datatable">
                    <thead>
                        <tr>
                            <th>Asset Name</th>
                            <th>Asset Id</th>
                            <th>Purchase Date</th>
                            <th>Warrenty</th>
                            <th>Supplier</th>
                            <th>Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('modals')
@livewire('asset-component')
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('assets')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'ast_id', name: 'ast_id'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'warranty', name: 'warranty'},
                    {data: 'purchase_from', name: 'purchase_from'},
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
