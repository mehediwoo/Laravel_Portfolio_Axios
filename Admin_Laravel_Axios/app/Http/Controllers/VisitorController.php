<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
use Illuminate\Database\Eloquent\Collection;

class VisitorController extends Controller
{
    public function visitor(){
        $visitor = visitorModel::orderBy('id' ,'DESC')->take(1000)->get();
        return view('visitor',compact('visitor'));
    }
}
