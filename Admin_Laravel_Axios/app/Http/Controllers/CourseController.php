<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return view('course');
    }

    public function CourseDetails()
    {
        $getCourse = Course::orderBy('id','DESC')->get();
        return $getCourse;
    }
    public function CourseDelete(Request $req){
        $id = $req->input('id');
        $data = Course::find($id);
        $data->delete();
        if ($data==true) {
            return 1;
        }else{
            return 0;
        }
    }
    //Course Edit
    public function CourseEdit(Request $req){
        $id = $req->input('id');
        $data = Course::where('id',$id)->get();
        return $data;
    }
    //Course Update
    public function CourseUpdate(Request $req){
        $id     = $req->input('id');
        $insert = Course::find($id);
        $insert->courseName = $req->input('name');
        $insert->courseDesc = $req->input('desc');
        $insert->courseFee = $req->input('fee');
        $insert->courseTotalEnroll = $req->input('enrol');
        $insert->courseTotalClass = $req->input('clas');
        $insert->courseLink = $req->input('crslink');
        $insert->courseImage = $req->input('image');
        $insert->update();
        return $insert;

    }
    //Course Inssert
    public function CourseInsert(Request $req){
        $insert = new Course;
        $insert->courseName = $req->input('name');
        $insert->courseDesc = $req->input('desc');
        $insert->courseFee = $req->input('fee');
        $insert->courseTotalEnroll = $req->input('enrol');
        $insert->courseTotalClass = $req->input('clas');
        $insert->courseLink = $req->input('crslink');
        $insert->courseImage = $req->input('image');
        $insert->save();
        if ($insert==true) {
            return 1;
        }else{
            return 0;
        }

    }
}
