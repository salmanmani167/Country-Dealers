<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'departments';
        if($request->ajax()){
            $departments = Department::get();
            return DataTables::of($departments)
                ->addIndexColumn()
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
        return view('admin.departments',compact(
            'title'
        ));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return Department::findOrFail($request->id)->delete();
    }
}
