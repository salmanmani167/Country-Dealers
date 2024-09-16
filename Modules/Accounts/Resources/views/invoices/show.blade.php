@extends('layouts.master')

@push('page-styles')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header :title="$title">
        <div class="col-auto float-right ml-auto">
            <div class="btn-group btn-group-sm">
                <a href="{{route('invoices.index')}}" class="btn add-btn"><i class="fa fa-reply"></i> Go Back</a>
                {{-- <button id="export_pdf" class="btn btn-white">PDF</button> --}}
                <a href="{{route('invoice.pdf', $invoice)}}" class="btn btn-white">PDF</a>
                <button id="print" class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row" id="invoice_section">
        <div class="col-md-12">
            <x-accounts::invoice :invoice="$invoice"/>
        </div>
    </div>

</div>
@endsection

@push('page-scripts')
<script>
    $(document).ready(function(){
        updateTrId();
        $('#print').click(function(){

            var printContents = $("#invoice_section").html();
            var originalContents = $("body").html();

            $("body").empty().html(printContents);
            window.print();
            $("body").html(originalContents);
        })
    })
    function updateTrId(){
        var $count = 1;
        $('table.repeater > tbody > tr').each(function(i){
            var firstTd = $(this).find('td:first');
            firstTd.empty()
            firstTd.append($count);
            $count++;
        });
    }
</script>
@endpush
