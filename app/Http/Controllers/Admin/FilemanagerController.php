<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilemanagerController extends Controller
{

    public function index(){
        $title = 'filemanager';
        return view('filemanager',compact(
            'title'
        ));
    }
}
