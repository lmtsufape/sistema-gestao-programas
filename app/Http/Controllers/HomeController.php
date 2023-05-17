<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edital;

class HomeController extends Controller {

    public function index() {
        $editais = Edital::all();
        return view('home', compact('editais'));
    }
}