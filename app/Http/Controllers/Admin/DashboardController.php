<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\House;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Accounts\Entities\Sale;
use App\Http\Controllers\Controller;
use Modules\Accounts\Entities\Expense;
use Modules\Accounts\Entities\Invoice;
use Modules\Accounts\Entities\Product;
use Modules\Projects\Entities\Project;
use Modules\Accounts\Entities\SaleProduct;

class DashboardController extends Controller
{

    public function index(){
        $title = 'dashboard';
        if(auth()->user()->is_employee === 1){
            return view('employee.dashboard',compact(
                'title'
            ));
        }
        if(auth()->user()->is_client === 1){
            return view('client.dashboard',compact(
                'title'
            ));
        }
        $clients = Client::whereHas('user')->latest()->take(5)->get();
        $latest_projects = Project::latest()->take(5)->get();
        $latest_invoices = Invoice::latest()->take(5)->get();
        $total_projects = Project::count();
        $total_clients = Client::count();
        $total_employees = Employee::count();
        $total_houses = House::count();
        $expenses = Expense::sum('amount');
        $products = Product::count();
        $last_month_products = Product::whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->count();
        $sales = Sale::count();
        $last_month_sales = Sale::whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->count();
        $total_cost_price = 0;
        $total_sale_price = 0;
        $sale = Sale::get();
        $sale->each(function ($s) use (&$total_cost_price) {
            $total_cost_price += $s->saleProduct->product->cost_price;
        });
        $sale->each(function ($s) use (&$total_sale_price) {
            $total_sale_price += $s->saleProduct->price;
        });
        $profit = $total_cost_price - $total_sale_price;

        $last_month_sale = Sale::whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->get();
        $last_month_total_cost_price= 0;
        $last_month_total_sale_price = 0;
        $last_month_sale->each(function ($s) use (&$last_month_total_sale_price) {
            $last_month_total_sale_price += $s->saleProduct->product->cost_price;
        });
        $last_month_sale->each(function ($s) use (&$last_month_total_sale_price) {
            $last_month_total_sale_price += $s->saleProduct->price;
        });
        $last_month_profit = $total_cost_price - $last_month_total_sale_price;
        $last_month_expenses = Expense::whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->sum('amount');
        $latest_clients = User::with(['client'])->where('is_employee',0)->where('is_client',1)->latest()->take(5)->get();
        $latest_projects = Project::latest()->take(5)->get();
        $latest_invoices = Invoice::latest()->take(5)->get();

        $monthly_sale = [];
        $monthly_sale[1] = SaleProduct::whereHas('sale')->whereMonth('created_at',1)->get();
        $monthly_sale[2] = SaleProduct::whereHas('sale')->whereMonth('created_at',2)->get();
        $monthly_sale[3] = SaleProduct::whereHas('sale')->whereMonth('created_at',3)->get();
        $monthly_sale[4] = SaleProduct::whereHas('sale')->whereMonth('created_at',4)->get();
        $monthly_sale[5] = SaleProduct::whereHas('sale')->whereMonth('created_at',5)->get();
        $monthly_sale[6] = SaleProduct::whereHas('sale')->whereMonth('created_at',6)->get();
        $monthly_sale[7] = SaleProduct::whereHas('sale')->whereMonth('created_at',7)->get();
        $monthly_sale[8] = SaleProduct::whereHas('sale')->whereMonth('created_at',8)->get();
        $monthly_sale[9] = SaleProduct::whereHas('sale')->whereMonth('created_at',9)->get();
        $monthly_sale[10] = SaleProduct::whereHas('sale')->whereMonth('created_at',10)->get();
        $monthly_sale[11] = SaleProduct::whereHas('sale')->whereMonth('created_at',11)->get();
        $monthly_sale[12] = SaleProduct::whereHas('sale')->whereMonth('created_at',12)->get();


        $monthly_expense = [];
        $monthly_expense[1] = Expense::whereMonth('created_at',1)->get();
        $monthly_expense[2] = Expense::whereMonth('created_at',2)->get();
        $monthly_expense[3] = Expense::whereMonth('created_at',3)->get();
        $monthly_expense[4] = Expense::whereMonth('created_at',4)->get();
        $monthly_expense[5] = Expense::whereMonth('created_at',5)->get();
        $monthly_expense[6] = Expense::whereMonth('created_at',6)->get();
        $monthly_expense[7] = Expense::whereMonth('created_at',7)->get();
        $monthly_expense[8] = Expense::whereMonth('created_at',8)->get();
        $monthly_expense[9] = Expense::whereMonth('created_at',9)->get();
        $monthly_expense[10] = Expense::whereMonth('created_at',10)->get();
        $monthly_expense[11] = Expense::whereMonth('created_at',11)->get();
        $monthly_expense[12] = Expense::whereMonth('created_at',12)->get();
        return view('admin.dashboard',compact(
            'title','total_projects','total_clients',
            'total_employees','total_houses','clients',
            'latest_projects','latest_invoices','products','expenses',
            'last_month_products','last_month_expenses','last_month_sales',
            'sales','profit','last_month_profit','monthly_sale','monthly_expense'
        ));
    }
}
