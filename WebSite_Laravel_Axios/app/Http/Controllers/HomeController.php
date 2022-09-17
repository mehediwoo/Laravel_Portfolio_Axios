<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\Course;
use App\Models\Project;
use App\Models\Contact;
use App\Models\review;

class HomeController extends Controller
{
    public function index(){

        $ipAdd = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$ipAdd,'visite_time'=>$timeDate]);

        $service  = ServicesModel::take(4)->get();

        $course   = Course::orderBy('id','DESC')->take(6)->get();
        $project  = Project::orderBy('id','DESC')->take(10)->get();
        $review   = review::orderBy('id','DESC')->take(10)->get();

        return view('home',compact(['service','course','project','review']));
    }
    public function SendContactForm(Request $req)
    {
    	$insert = new Contact;
    	$insert->ContactName   = $req->input('name');
    	$insert->ContactPhone  = $req->input('phone');
    	$insert->ContactMail   = $req->input('mail');
    	$insert->ContactMessage= $req->input('desc');
    	$insert->save();
    	if ($insert==true) {
    		return 1;
    	}else{
    		return 0;
    	}
    }

}
