<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    //

    public function index(Request $request)
    {
        
        $supervisors = Supervisor::all();
        return view("Supervisor.index", compact("supervisors"));
    
    }

}
