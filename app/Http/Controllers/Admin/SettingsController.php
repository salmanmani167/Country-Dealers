<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings\ThemeSettings;
use Yajra\DataTables\DataTables;
use App\Settings\CompanySettings;
use App\Settings\InvoiceSettings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Settings\AttendanceSettings;
use Illuminate\Support\Facades\Artisan;
use YlsIdeas\FeatureFlags\Facades\Features;

class SettingsController extends Controller
{
    public function theme(ThemeSettings $settings){

        $title = 'theme settings';
        return view('admin.settings.theme',compact(
            'title','settings'
        ));
    }
    public function invoice(InvoiceSettings $settings){

        $title = 'invoice settings';
        return view('admin.settings.invoice',compact(
            'title','settings'
        ));
    }


    public function company(CompanySettings $settings){

        $title = 'company settings';
        return view('admin.settings.company',compact(
            'title','settings'
        ));
    }



    public function attendance(AttendanceSettings $settings){

        $title = 'attendance settings';
        return view('admin.settings.attendance',compact(
            'title','settings'
        ));
    }

    public function features(Request $request){
        $title = 'app features';
        if($request->ajax()){
            $features = DB::table('features')->get();
            return DataTables::of($features)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    $checked = Features::accessible($row->feature) ? 'checked': '';
                    return '<div class="status-toggle">
                                <input type="checkbox" data-status="'.$row->active_at.'" '.$checked.' data-feature="'.$row->id.'" id="'.$row->id.'_toggle"  class="check feature_toggle">
                                <label for="'.$row->id.'_toggle" class="checktoggle">checkbox</label>
                            </div>';
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
                ->rawColumns(['action','status'])
                ->make();
        }
        return view('admin.settings.features',compact(
            'title'
        ));
    }


    public function updateFeatureStatus(Request $request){
        if($request->ajax()){
            $feature = DB::table('features')->where('id', $request->feature)->first();
            if(!empty($request->status) && !empty($request->feature)){
                Features::turnOff('database', $feature->feature);
                Artisan::call('cache:clear');
                Artisan::call('clear');
                return response()->json(['type' => 1,'message' => "Feature has been turned off"]);
            }else{
                Features::turnOn('database', $feature->feature);
                Artisan::call('cache:clear');
                Artisan::call('clear');
                return response()->json(['type' => 1,'message' => "Feature has been turned on"]);
            }
        }
    }
}
