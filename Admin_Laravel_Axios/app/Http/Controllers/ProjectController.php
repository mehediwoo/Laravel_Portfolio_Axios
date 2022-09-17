<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //Project Index
    public function index()
    {
        return view('project');
    }
    //Getting Project Data
    public function GetProject()
    {
        $project = Project::orderBy('id','DESC')->get();
        return $project;
    }
    public function DeleteProject(Request $req)
    {
        $id = $req->input('id');
        $project = Project::find($id);
        $project->delete();
        if ($project==true) {
            return 1;
        }else{
            return 0;
        }
    }
    public function getProjectDetails(Request $req)
    {
        $id = $req->input('id');
        $data = Project::where('id',$id)->get();
        return $data;
    }
    public function ProjectUpdate(Request $req)
    {
        $id = $req->input('id');
        $data = Project::find($id);
        $data->ProjectName=$req->input('name');
        $data->ProjectImage=$req->input('img');
        $data->ProjectLink=$req->input('link');
        $data->ProjectDesc=$req->input('desc');
        $data->update();
        return $data;
    }
    public function InsertProject(Request $req)
    {
        $data = new Project;
        $data->ProjectName=$req->input('name');
        $data->ProjectImage=$req->input('img');
        $data->ProjectLink=$req->input('link');
        $data->ProjectDesc=$req->input('desc');
        $data->save();
        if ($data==true) {
            return 1;
        }else{
            return 0;
        }
    }
}
