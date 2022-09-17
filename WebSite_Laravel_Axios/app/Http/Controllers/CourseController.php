<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
    	$course = Course::orderBy('id','DESC')->get();
    	return view('course',compact('course'));
    }
}
