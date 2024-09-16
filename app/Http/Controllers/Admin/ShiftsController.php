<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShiftsController extends Controller
{

    public function index(Request $request){
        $title = 'shifts';
        if($request->ajax()){
            $shifts = Shift::get();
            return DataTables::of($shifts)
                ->addIndexColumn()
                ->addColumn('min_start', function($row){
                    return format_date($row->min_start_time, 'H:i:s a');
                })
                ->addColumn('start', function($row){
                    return format_date($row->start_time, 'H:i:s a');
                })
                ->addColumn('max_start', function($row){
                    return format_date($row->max_start_time, 'H:i:s a');
                })
                ->addColumn('max_end', function($row){
                    return format_date($row->max_end_time, 'H:i:s a');
                })
                ->addColumn('end', function($row){
                    return format_date($row->end_time, 'H:i:s a');
                })
                ->addColumn('min_end', function($row){
                    return format_date($row->min_end_time, 'H:i:s a');
                })
                ->addColumn('break', function($row){
                    return format_date($row->break, 'H:i:s a');
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit" data-shift="'.json_parse(['model' => $row]).'" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-id="'.$row->id.'" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.shifts',compact(
            'title'
        ));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
            'weeks' => 'nullable',
            'days' => 'required',
            'ends' => 'nullable',
        ]);
        Shift::create([
            'name' => $request->name,
            'start_time' => $request->start,
            'end_time' => $request->end,
            'recurring' => !empty($request->recurring),
            'repeat_weeks' => $request->weeks,
            'days' => $request->days,
            'ends_on' => $request->ends,
            'indefinite' => !empty($request->indefinite),
            'tag' => $request->tag,
            'note' => $request->note,
        ]);
        $notification = notify("shift has been created");
        return back()->with($notification);
    }
    public function update(Request $request){

        $shift = Shift::findOrFail($request->id);
        $shift->update([
            'name' => $request->name,
            'start_time' => $request->start,
            'end_time' => $request->end,
            'recurring' => !empty($request->recurring),
            'repeat_weeks' => $request->weeks,
            'days' => $request->days,
            'ends_on' => $request->ends,
            'indefinite' => !empty($request->indefinite),
            'tag' => $request->tag,
            'note' => $request->note,
        ]);
        $notification = notify("shift has been updated");
        return back()->with($notification);
    }
    public function destroy(Request $request){
        Shift::findOrFail($request->id)->delete();
        $notification = notify("shift has been deleted");
        return back()->with($notification);
    }
}
