<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index(){
        $title = 'backups';
        return view('admin.backups',compact(
            'title'
        ));
    }
}
