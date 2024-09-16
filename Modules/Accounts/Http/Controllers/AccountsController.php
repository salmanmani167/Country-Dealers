<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Tax;
use Illuminate\Contracts\Support\Renderable;
use Modules\Accounts\Entities\Expense;
use Modules\Accounts\Entities\ProvidentFund;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('accounts::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Renderable
     */
    public function taxes(Request $request)
    {
        $title = 'taxes';
        if($request->ajax()){
            $taxes = Tax::get();
            return DataTables::of($taxes)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return ucwords($row->status);
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item edit_department" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('accounts::taxes', compact(
            'title'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function providentFunds(Request $request)
    {
        $title = 'provident funds';
        if($request->ajax()){
            $funds = ProvidentFund::get();
            return DataTables::of($funds)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return ucwords($row->status);
                })
                ->addColumn('emp', function($row){
                    $avatar = !empty($row->employee->user->avatar) ? asset("storage/users/".$row->employee->user->avatar): asset("assets/img/profiles/avatar.jpg");
                        $td = '<h2 class="table-avatar">
                        <a target="_blank" href="'.route('employees.profile', $row->employee->id).'" class="avatar">
                            <img alt="avatar" src="'.$avatar.'">
                        </a>
                        <a target="_blank" href="'.route('employees.profile', $row->employee->id).'">'.($row->employee->user->firstname.' '.$row->employee->user->lastname).'</a>
                    </h2>';
                    return $td;
                })
                ->addColumn('emp_share', function($row){
                    return $row->employee_share_amount.'%';
                })
                ->addColumn('org_share', function($row){
                    return $row->org_share_amount.'%';
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item edit_department" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action','emp'])
                ->make();
        }
        return view('accounts::provident-funds',compact(
            'title'
        ));
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @return Renderable
     */
    public function expenses(Request $request)
    {
        $title = 'expenses';
        if($request->ajax()){
            $expenses = Expense::get();
            return DataTables::of($expenses)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return ucwords($row->status);
                })
                ->addColumn('buyer', function($row){
                    $user = $row->user;
                    return view('components.user.avatar',compact('user'));
                })
                ->addColumn('paid_by', function($row){
                    return $row->payment_method;
                })
                ->addColumn('amount', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->amount;
                })
                ->addColumn('purchase_date', function($row){
                    return format_date($row->purchased_date,'D M,Y');
                })
                ->addColumn('purchased_from', function($row){
                    return $row->purchased_from;
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item edit_department" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action','buyer'])
                ->make();
        }
        return view('accounts::expenses',compact(
            'title'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('accounts::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
