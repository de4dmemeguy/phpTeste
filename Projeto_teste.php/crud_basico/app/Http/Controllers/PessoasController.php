<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoasController extends Controller
{
    public function create()
    {
        return view('pessoas.create');
    }
}
