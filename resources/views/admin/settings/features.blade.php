@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Feature</th>
                        <th>Status</th>
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


@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('settings.features')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'feature', name: 'feature'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })

            $('table').on('click','.feature_toggle', function(){
                var status = $(this).data('status');
                var feature = $(this).data('feature');
                $.ajax({
                    url: "{{route('settings.features-update')}}",
                    type: "POST",
                    data: {
                        feature: feature,
                        status: status
                    },
                    success: function(e){
                        if(e.type == '1'){
                            toastr.success(e.message)
                        }
                        if(e.type == '0'){
                            toastr.error(e.message)
                        }
                    },
                    complete: function(response){
                        window.location.reload();
                    }
                })
            })
        })

    </script>
@endpush
