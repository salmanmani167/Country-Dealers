<?php

namespace Modules\Apps\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AppsController extends Controller
{

    public function calendar(Request $request){
        $title = 'Calendar';
        return view('apps::calendar',compact(
            'title'
        ));
    }

    
}
