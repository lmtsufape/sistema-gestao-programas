<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Edital;

class HomeController extends Controller {

    public function index() {
        $programas = Programa::all();
        return view('home', compact('programas'));
    }
}