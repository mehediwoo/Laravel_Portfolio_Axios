<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurmsController extends Controller
{
    public function index()
    {
    	return view('turms');
    }
}
