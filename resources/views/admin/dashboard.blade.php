@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome {{auth()->user()->username}}!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
     <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$total_projects}}</h3>
                        <span>Projects</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$total_clients}}</h3>
                        <span>Individuals</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-home"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$total_houses}}</h3>
                        <span>Houses</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$total_employees}}</h3>
                        <span>Employees</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Expenses</h3>
                            <div id="monthly_expense_barchart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Sales And Expense Overview</h3>
                            <div id="monthly_sale_and_expense_linecharts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Sales Overview</h3>
                    <div id="monthly_sale_barcharts"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Sales LineChart Overview</h3>
                    <div id="full_line-charts"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-group m-b-30">


                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Products</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$products}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Previous Month <span class="text-muted">{{$last_month_products}}</span></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Sales</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$sales}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Previous Month <span class="text-muted">{{$last_month_sales}}</span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Expenses</span>
                            </div>

                        </div>
                        <h3 class="mb-3">{{app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.number_format((float)$expenses, 2, '.', '')}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Previous Month <span class="text-muted">{{app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.number_format((float)$last_month_expenses, 2, '.', '')}}</span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Profit</span>
                            </div>

                        </div>
                        <h3 class="mb-3">{{app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.number_format((float)$profit, 2, '.', '')}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Previous Month <span class="text-muted">{{app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.number_format((float)$last_month_profit, 2, '.', '')}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if (Route::has('clients.index'))
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Clients</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($clients) && ($clients->count() > 0))
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client->clt_id}}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a target="_blank" href="{{route('clients.profile',$client->user_id)}}" class="avatar"><img alt="avatar" src="{{!empty($client->user->avatar) ? asset('storage/users/'.$client->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                                                <a target="_blank" href="{{route('clients.profile',$client->user_id)}}">{{$client->user->firstname.' '.$client->user->lastname}} <span>CEO</span></a>
                                            </h2>
                                        </td>
                                        <td>{{$client->user->username}}</td>
                                        <td>{{$client->user->email}}</td>
                                        <td>
                                           {{$client->user->active}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('clients.list')}}">View all clients</a>
                </div>
            </div>
        </div>
        @endif
        @if (Route::has('projects.index'))
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Projects</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Project Name </th>
                                    <th>Progress</th>
                                    <th>Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($latest_projects) && ($latest_projects->count() > 0))
                                    @foreach ($latest_projects as $project)
                                    <tr>
                                        <td>
                                            <h2><a target="_blank" href="{{route('projects.show', $project->id)}}">{{$project->name}}</a></h2>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="{{$project->progress}}%" style="width: {{$project->progress}}%"></div>
                                            </div>
                                        </td>
                                        <td>{{$project->priority}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('projects.list')}}">View all projects</a>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if (Route::has('invoices.index'))
    <div class="row">
        <div class="col-md-12 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Invoices</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Client</th>
                                    <th>Due Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($latest_invoices))
                                    @foreach ($latest_invoices as $invoice)
                                    <tr>
                                        <td><a target="_blank" href="{{route('invoices.show',$invoice->id)}}">{{$invoice->inv_id}}</a></td>
                                        <td>
                                            @if (!empty($invoice->client_id) && !empty($invoice->client->user))
                                            <h2><a target="_blank" href="{{route('clients.profile', $invoice->client_id)}}">{{$invoice->client->user->firstname.' '.$invoice->client->user->lastname}}</a></h2>
                                            @endif
                                        </td>
                                        <td>{{format_date($invoice->due_date,'d M, Y')}}</td>
                                        <td>{{app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$invoice->total}}</td>
                                        <td>
                                            {{$invoice->status}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('invoices.index')}}">View all invoices</a>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@push('page-scripts')
    <!-- Chart JS -->
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            var currency_symbol = "{{app(\App\Settings\ThemeSettings::class)->currency_symbol}}";
            Morris.Bar({
                element: 'monthly_expense_barchart',
                data: [
                    { y: 'Jan', a: "{{$monthly_expense[1]->sum('amount')}}", b: "{{$monthly_expense[1]->count()}}" },
                    { y: 'Feb', a: "{{$monthly_expense[2]->sum('amount')}}", b: "{{$monthly_expense[2]->count()}}" },
                    { y: 'Mar', a: "{{$monthly_expense[3]->sum('amount')}}", b: "{{$monthly_expense[3]->count()}}" },
                    { y: 'Apr', a: "{{$monthly_expense[4]->sum('amount')}}", b: "{{$monthly_expense[4]->count()}}"},
                    { y: 'May', a: "{{$monthly_expense[5]->sum('amount')}}", b: "{{$monthly_expense[5]->count()}}" },
                    { y: 'Jun', a: "{{$monthly_expense[6]->sum('amount')}}", b: "{{$monthly_expense[6]->count()}}"},
                    { y: 'Jul', a: "{{$monthly_expense[7]->sum('amount')}}", b: "{{$monthly_expense[7]->count()}}" },
                    { y: 'Aug', a: "{{$monthly_expense[8]->sum('amount')}}", b: "{{$monthly_expense[8]->count()}}"},
                    { y: 'Sept', a: "{{$monthly_expense[9]->sum('amount')}}", b: "{{$monthly_expense[9]->count()}}"},
                    { y: 'Oct', a: "{{$monthly_expense[10]->sum('amount')}}", b: "{{$monthly_expense[10]->count()}}"},
                    { y: 'Nov', a: "{{$monthly_expense[11]->sum('amount')}}", b: "{{$monthly_expense[11]->count()}}"},
                    { y: 'Dec', a: "{{$monthly_expense[12]->sum('amount')}}", b: "{{$monthly_expense[12]->count()}}"},
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: [`Total Expense (${currency_symbol})`, 'Total Expenses'],
                lineColors: ['#ff9b44','#fc6075'],
                lineWidth: '3px',
                barColors: ['#ff9b44','#fc6075'],
                resize: true,
                redraw: true
            });

            Morris.Bar({
                element: 'monthly_sale_barcharts',
                data: [
                    { y: 'Jan', a: "{{$monthly_sale[1]->sum('price')}}", b: "{{$monthly_sale[1]->count()}}" },
                    { y: 'Feb', a: "{{$monthly_sale[2]->sum('price')}}", b: "{{$monthly_sale[2]->count()}}" },
                    { y: 'Mar', a: "{{$monthly_sale[3]->sum('price')}}", b: "{{$monthly_sale[3]->count()}}" },
                    { y: 'Apr', a: "{{$monthly_sale[4]->sum('price')}}", b: "{{$monthly_sale[4]->count()}}"},
                    { y: 'May', a: "{{$monthly_sale[5]->sum('price')}}", b: "{{$monthly_sale[5]->count()}}" },
                    { y: 'Jun', a: "{{$monthly_sale[6]->sum('price')}}", b: "{{$monthly_sale[6]->count()}}"},
                    { y: 'Jul', a: "{{$monthly_sale[7]->sum('price')}}", b: "{{$monthly_sale[7]->count()}}" },
                    { y: 'Aug', a: "{{$monthly_sale[8]->sum('price')}}", b: "{{$monthly_sale[8]->count()}}"},
                    { y: 'Sept', a: "{{$monthly_sale[9]->sum('price')}}", b: "{{$monthly_sale[9]->count()}}"},
                    { y: 'Oct', a: "{{$monthly_sale[10]->sum('price')}}", b: "{{$monthly_sale[10]->count()}}"},
                    { y: 'Nov', a: "{{$monthly_sale[11]->sum('price')}}", b: "{{$monthly_sale[11]->count()}}"},
                    { y: 'Dec', a: "{{$monthly_sale[12]->sum('price')}}", b: "{{$monthly_sale[12]->count()}}"},
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: [`Total Sales (${currency_symbol})`, 'Number Of Sales'],
                lineColors: ['#ff9b44','#fc6075'],
                lineWidth: '3px',
                barColors: ['#ff9b44','#fc6075'],
                resize: true,
                redraw: true
            });

            Morris.Line({
                element: 'monthly_sale_and_expense_linecharts',
                data: [
                    { y: 'Jan', a: "{{$monthly_sale[1]->sum('price')}}", b: "{{$monthly_expense[1]->sum('amount')}}" },
                    { y: 'Feb', a: "{{$monthly_sale[2]->sum('price')}}", b: "{{$monthly_expense[2]->sum('amount')}}" },
                    { y: 'Mar', a: "{{$monthly_sale[3]->sum('price')}}", b: "{{$monthly_expense[3]->sum('amount')}}" },
                    { y: 'Apr', a: "{{$monthly_sale[4]->sum('price')}}", b: "{{$monthly_expense[4]->sum('amount')}}"},
                    { y: 'May', a: "{{$monthly_sale[5]->sum('price')}}", b: "{{$monthly_expense[5]->sum('amount')}}" },
                    { y: 'Jun', a: "{{$monthly_sale[6]->sum('price')}}", b: "{{$monthly_expense[6]->sum('amount')}}"},
                    { y: 'Jul', a: "{{$monthly_sale[7]->sum('price')}}", b: "{{$monthly_expense[7]->sum('amount')}}" },
                    { y: 'Aug', a: "{{$monthly_sale[8]->sum('price')}}", b: "{{$monthly_expense[8]->sum('amount')}}"},
                    { y: 'Sept', a: "{{$monthly_sale[9]->sum('price')}}", b: "{{$monthly_expense[9]->sum('amount')}}"},
                    { y: 'Oct', a: "{{$monthly_sale[10]->sum('price')}}", b: "{{$monthly_expense[10]->sum('amount')}}"},
                    { y: 'Nov', a: "{{$monthly_sale[11]->sum('price')}}", b: "{{$monthly_expense[11]->sum('amount')}}"},
                    { y: 'Dec', a: "{{$monthly_sale[12]->sum('price')}}", b: "{{$monthly_expense[12]->sum('amount')}}"},
                ],
                xkey: 'y',
                ykeys: ['a','b'],
                labels: [`Total Sales (${currency_symbol})`, `Total Expenses (${currency_symbol})`],
                lineColors: ['#ff9b44','#fc6075'],
                lineWidth: '3px',
                resize: true,
                parseTime: false,
                redraw: true
            });


            new Morris.Line({
                element: 'full_line-charts',
                data: [
                    { month: 'Jan', a: "{{$monthly_sale[1]->sum('price')}}" },
                    { month: 'Feb', a: "{{$monthly_sale[2]->sum('price')}}" },
                    { month: 'Mar', a: "{{$monthly_sale[3]->sum('price')}}" },
                    { month: 'Apr', a: "{{$monthly_sale[4]->sum('price')}}" },
                    { month: 'May', a: "{{$monthly_sale[5]->sum('price')}}" },
                    { month: 'Jun', a: "{{$monthly_sale[6]->sum('price')}}" },
                    { month: 'Jul', a: "{{$monthly_sale[7]->sum('price')}}" },
                    { month: 'Aug', a: "{{$monthly_sale[8]->sum('price')}}" },
                    { month: 'Sep', a: "{{$monthly_sale[9]->sum('price')}}" },
                    { month: 'Oct', a: "{{$monthly_sale[10]->sum('price')}}" },
                    { month: 'Nov', a: "{{$monthly_sale[11]->sum('price')}}" },
                    { month: 'Dec', a: "{{$monthly_sale[12]->sum('price')}}" }
                ],
                xkey: 'month',
                ykeys: ['a'],
                labels: [`Sales (${currency_symbol})`],
                lineColors: ['#ff9b44'],
                parseTime: false
            });

        })
    </script>
@endpush
