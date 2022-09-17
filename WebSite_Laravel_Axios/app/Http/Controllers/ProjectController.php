<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
    	$project = Project::orderBy('id','DESC')->get();
    	return view('project', compact('project'));
    }
}
