<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListarModelosController extends Controller {
    public function index() {
        return view('listar-modelos');
    }
}
