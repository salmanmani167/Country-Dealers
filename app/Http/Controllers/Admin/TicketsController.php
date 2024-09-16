<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Employee;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TicketsController extends Controller
{

    public function index(Request $request){
        $title = 'tickets';
        if($request->ajax()){
            $tickets = Ticket::get();
            return DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('assigned_staff', function($row){
                    if(!empty($row->assignedTo->user)){
                        return $row->assignedTo->user->firstname.' '.$row->assignedTo->user->lastname;
                    }
                })
                ->addColumn('client', function($row){
                    if(!empty($row->client->user)){
                        return $row->client->user->firstname.' '.$row->client->user->lastname;
                    }
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit" data-ticket="'.json_parse(['model' => $row]).'" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-id="'.$row->id.'" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        $employees = Employee::get();
        $clients = Client::get();
        return view('admin.tickets',compact(
            'title','clients','employees'
        ));
    }
    public function store(Request $request){
        $request->validate([
            'subject' => 'required',
            'assigned_to' => 'required',
            'priority' => 'required',
            'followers' => 'required',
            'description' => 'required',
        ]);
        $tk_id = IdGenerator::generate(['table' => 'tickets', 'field' => 'tk_id', 'length' => 10, 'prefix' => '#TKT-']);
        Ticket::create([
            'tk_id' => $tk_id,
            'subject' => $request->subject,
            'assigned_to' => $request->assigned_to,
            'client_id' => $request->client,
            'priority' => $request->priority,
            'cc' => $request->cc,
            'followers' => $request->followers,
            'description' => $request->description,
            'files' => $request->uploaded_files,
            'added_by' => auth()->user()->id,
        ]);
        $notification = notify("Ticket has been added");
        return back()->with($notification);
    }
    public function update(Request $request){
        $ticket = Ticket::findOrFail($request->id);
        $ticket->update([
            'tk_id' => $request->tk_id,
            'subject' => $request->subject,
            'assigned_to' => $request->assigned_to,
            'client_id' => $request->client,
            'priority' => $request->priority,
            'cc' => $request->cc,
            'followers' => $request->followers,
            'description' => $request->description,
            'files' => $ticket->files ?? $request->uploaded_files,
            'added_by' => auth()->user()->id,
        ]);
        $notification = notify("Ticket has been updated");
        return back()->with($notification);
    }
    public function destroy(Request $request){
        Ticket::findOrFail($request->id)->delete();
        $notification = notify("Ticket has been deleted");
        return back()->with($notification);
    }
}
