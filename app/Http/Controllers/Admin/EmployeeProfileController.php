<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{

    public function familyInfo(Request $request, Employee $employee){
        $employee->update([
            'family_information' => $request->family,
        ]);
        $notification = notify('Family information has been updated');
        return back()->with($notification);
    }

    public function bankInfo(Request $request, Employee $employee){
        $bank_details = [
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'bank_branch' => $request->bank_branch,
            'sortcode' => $request->branch_sortcode,
            'ifsc_code' => $request->ifsc_code,
            'pan_number' => $request->pan_number,
        ];
        $employee->update([
            'bank_information' => $bank_details,
        ]);
        $notification = notify('Bank information has been updated');
        return back()->with($notification);
    }

    public function educationInfo(Request $request,Employee $employee){
        $employee->update([
            'education' => $request->education
        ]);
        $notification = notify('Education information has been updated');
        return back()->with($notification);
    }

    public function experienceInfo(Request $request, Employee $employee){
        $employee->update([
            'experience' => $request->experience
        ]);
        $notification = notify('Experience information has been updated');
        return back()->with($notification);
    }
}
