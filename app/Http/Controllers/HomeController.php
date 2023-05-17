<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Edital;

class HomeController extends Controller {

    public function index() {
<<<<<<< HEAD
        $programas = Programa::all();
        return view('home', compact('programas'));
=======
        $editais = Edital::all();
        return view('home', compact('editais'));
>>>>>>> refs/remotes/origin/main
    }
}