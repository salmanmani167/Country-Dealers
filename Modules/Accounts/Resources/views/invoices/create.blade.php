@extends('layouts.master')

@push('page-styles')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header :title="$title">
        <div class="col-auto float-right ml-auto">
            <a href="{{route('invoices.index')}}" class="btn add-btn"><i class="fa fa-reply"></i> Go Back</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('invoices.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="client" label="Client">
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->user->firstname.' '.$client->user->lastname}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="project" label="Project">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.input type="email" name="email" label="Email"></x-form.input>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="tax" label="Tax">
                                <option value="">Select Tax</option>
                                @foreach ($taxes as $tax)
                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.textarea  rows="3" name="client_address" label="Client Address"></x-form.textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.textarea  rows="3" name="billing_address" label="Billing Address"></x-form.textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.datepicker class="datetimepicker" name="invoice_date" label="Invoice Date"></x-form.datepicker>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.datepicker class="datetimepicker" name="due_date" label="Due Date"></x-form.datepicker>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-white repeater">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="col-sm-2">Item</th>
                                        <th class="col-md-6">Description</th>
                                        <th style="width:100px;">Unit Cost</th>
                                        <th style="width:80px;">Qty</th>
                                        <th>Amount</th>
                                        <th><button type="button" class="btn btn-sm btn-success font-18 mr-1" title="Add" data-repeater-create>
                                            <i class="fa fa-plus"></i>
                                        </button> </th>
                                    </tr>
                                </thead>
                                <tbody data-repeater-list="items">
                                    <tr data-repeater-item>
                                        <td>

                                        </td>
                                        <td>
                                            <input class="form-control" name="name" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                            <input class="form-control" name="description" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                            <input class="form-control"  name="unit_cost"  style="width:100px" type="text">
                                        </td>
                                        <td>
                                            <input class="form-control" name="quantity" style="width:80px" type="text">
                                        </td>
                                        <td>
                                            <input class="form-control" name="amount" readonly style="width:120px" type="text">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger font-18 ml-2" title="Delete" data-repeater-delete>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-form.input name="discount" label="Discount" value="0"></x-form.input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-form.select class="select" name="status" label="Status">
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-form.textarea name="note" label="Other Information"></x-form.textarea>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('page-scripts')
<script src="{{asset('assets/plugins/jquery-repeater/jquery.repeater.min.js')}}"></script>
<script>
    $(document).ready(function(){
        'use strict';
        $('table.repeater').repeater({
            show: function () {
				$(this).slideDown();
                updateTrId();
            },

            hide: function (deleteElement) {
				$(this).slideUp(deleteElement);
                updateTrId();
            },

        });

        updateTrId();
    });


    function setAmount(){
        $('table.repeater > tbody > tr').change(function(){
            var quantity = $(this).find('input[name*="quantity"]').val()
            var cost = $(this).find('input[name*="unit_cost"]').val()
            var total_amount = parseFloat(cost) * parseFloat(quantity);
            $(this).find('input[name*="amount"]').val(parseFloat(total_amount))

        })
    }
    function updateTrId(){
        var $count = 1;
        $('table.repeater > tbody > tr').each(function(i){
            var firstTd = $(this).find('td:first');
            firstTd.empty()
            firstTd.append($count);
            $count++;
        });
        setAmount();
    }
</script>
@endpush
