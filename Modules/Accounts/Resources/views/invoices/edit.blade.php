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
        <div class="col-md-12">
            <form action="{{route('invoices.update',$invoice->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="client" label="Client">
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option {{($invoice->client_id == $client->id) ?'selected':'' }} value="{{$client->id}}">{{$client->user->firstname.' '.$client->user->lastname}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="project" label="Project">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option {{($invoice->project_id == $project->id) ?'selected':'' }} value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.input type="email" name="email" label="Email" :value="$invoice->email"></x-form.input>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.select class="select" name="tax" label="Tax">
                                <option value="">Select Tax</option>
                                @foreach ($taxes as $tax)
                                <option {{($invoice->tax_id == $tax->id) ?'selected':'' }} value="{{$tax->id}}">{{$tax->name}}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.textarea  rows="3" name="client_address" label="Client Address" :placeholder="$invoice->client_address"></x-form.textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.textarea  rows="3" name="billing_address" label="Billing Address" :placeholder="$invoice->billing_address"></x-form.textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.datepicker class="datetimepicker" name="invoice_date" label="Invoice Date" :value="$invoice->invoice_date"></x-form.datepicker>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <x-form.datepicker class="datetimepicker" name="due_date" label="Due Date" :value="$invoice->due_date"></x-form.datepicker>
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
                                    @if (!empty($invoice->items))

                                        @foreach ($invoice->items as $item)
                                        <tr data-repeater-item>
                                            <td>
                                            </td>
                                            <td>
                                                <input class="form-control" name="name" value="{{$item['name']}}" type="text" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control" name="description" value="{{$item['description']}}" type="text" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control"  name="unit_cost" value="{{$item['unit_cost']}}" style="width:100px" type="text">
                                            </td>
                                            <td>
                                                <input class="form-control" name="quantity" value="{{$item['quantity']}}" style="width:80px" type="text">
                                            </td>
                                            <td>
                                                <input class="form-control" name="amount" value="{{$item['amount']}}" readonly style="width:120px" type="text">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger font-18 ml-2" title="Delete" data-repeater-delete>
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr data-repeater-item>
                                        <td>
                                            <input type="text" name="id" class="form-control" style="min-width:50px" readonly value="1">
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-white">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">Total</td>
                                        <td style="text-align: right; width: 230px">{{count($invoice->items)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right">Tax</td>
                                        <td style="text-align: right;width: 230px">
                                            <input class="form-control text-right" value="{{(($invoice->tax->percentage/100) * $invoice->total)}}" readonly type="text">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" style="text-align: right; font-weight: bold">
                                            Grand Total
                                        </td>
                                        <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px;color:black">
                                            {{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.($invoice->total)}}
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
                            <x-form.input name="discount" label="Discount" :value="$invoice->discount"></x-form.input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-form.select class="select" name="status" label="Status">
                                <option {{$invoice->status == 'paid' ? 'selected':''}} value="paid">Paid</option>
                                <option {{$invoice->status == 'pending' ? 'selected':''}} value="pending">Pending</option>
                            </x-form.select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-form.textarea name="note" label="Other Information" :placeholder="$invoice->note"></x-form.textarea>
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
		var status = $('#status').val("{{$invoice->status}}").trigger('change');

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
