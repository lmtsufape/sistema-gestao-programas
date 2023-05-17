<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        $programas = Programa::all();
        return view('home', compact('programas'));
    }
}