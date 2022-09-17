<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Course;
use App\Models\review;
use App\Models\ServicesModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    Public function index(){

        $project =Project::count();
        $contact = Contact::count();
        $course  =Course::count();
        $review  =review::count();
        $service =ServicesModel::count();
        $visitor =VisitorModel::count();
        return view('dashboard', compact('project','contact','course','review','service','visitor'));
    }

}
