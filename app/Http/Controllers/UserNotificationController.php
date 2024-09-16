<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserNotificationController extends Controller
{

    public function index(Request $request){

        $title = 'activities';
        $notifications = auth()->user()->notifications;
        return view('admin.activities', compact(
            'title','notifications'
        ));
    }

    public function clearAll(){
        auth()->user()->unreadNotifications->markAsRead();
        $notification = notify('All notifications has been marked as read');
        return back()->with($notification);
    }


    public function user(Request $request){
        $title = 'announcements';
        $notifications = auth()->user()->unreadNotifications;
        return view('admin.user-notifications', compact(
            'title','notifications'
        ));
    }


}
