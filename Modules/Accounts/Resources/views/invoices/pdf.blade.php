@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <div class="row" id="invoice_section">
        <div class="col-md-12">
            <x-accounts::invoice :invoice="$invoice"/>
        </div>
    </div>

</div>
@endsection

