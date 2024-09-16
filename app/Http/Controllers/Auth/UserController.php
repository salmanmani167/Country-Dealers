<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profile(){
        $title = 'profile';
        if(auth()->user()->is_employee === 1){
            $employee = auth()->user()->employee;
            $user = auth()->user();
            return view('admin.employees.profile',compact(
                'title','user','employee'
            ));
        }
        return view('user.profile',compact(
            'title'
        ));
    }

    public function changePassword(Request $request){
        $title = 'change password';
        return view('user.update-password',compact(
            'title',
        ));
    }

    public function updatePassword(Request $request, User $user){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|max:255'
        ]);
        if(!empty($request->current_password) && (Hash::check($request->current_password, $user->password))){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            $notification = notify('User password has been updated');
            return back()->with($notification);
        }
        $notification = notify('The provided password does not match your current password.','danger');
        return back()->with($notification)->withErrors(['password' => 'The provided password does not match your current password.']);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => 'string|nullable',
            'gender' => 'string|nullable',
            'birthdate' => 'nullable|date',
            'address' => 'string|nullable|max:255',
            'country' => 'nullable|string',
            'state' => 'string|nullable',
            'zip_code' => 'string|nullable'
        ]);
        $imageName = null;
        if($request->hasFile('avatar')){
            $imageName = 'prof_'.time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        auth()->user()->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'avatar' => $imageName
        ]);
        $notification = notify('profile has been updated');
        return back()->with($notification);
    }
}
