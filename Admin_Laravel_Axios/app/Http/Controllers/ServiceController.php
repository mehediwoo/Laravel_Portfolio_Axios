<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services');
    }
    public function getServiceData()
    {
        $data = ServicesModel::all();
        return $data;
    }
    // Service Details for Edit
    public function getServiceDetails(Request $req)
    {
        $id = $req->input('id');
        $data = ServicesModel::where('id',$id)->get();
        return $data;
    }
    // Service Updates
    public function ServiceUpdate(Request $req)
    {
        $id = $req->input('id');

        $data = ServicesModel::find($id);
        $data->services_name=$req->input('title');
        $data->services_desc=$req->input('desc');
        $data->services_image=$req->input('img');
        $data->update();
        if ($data==true) {
            return 1;
        }else{
            return 0;
        }
    }
    //Service Delete Method
    public function ServiceDelete(Request $req)
    {
        $id = $req->input('id');
        $result= ServicesModel::find($id);
        $result->delete();
        if ($result == true) {
            return 1;
        }else{
            return 0;
        }
    }
    //Services Add
    // Service Updates
    public function ServiceAdd(Request $req)
    {

        $data = new ServicesModel;
        $data->services_name=$req->input('title');
        $data->services_desc=$req->input('desc');
        $data->services_image=$req->input('img');
        $data->save();
        if ($data==true) {
            return 1;
        }else{
            return 0;
        }
    }
}
