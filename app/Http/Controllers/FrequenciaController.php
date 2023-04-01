<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrequenciaController extends Controller
{
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Frequencia.cadastrar");
    }
}
