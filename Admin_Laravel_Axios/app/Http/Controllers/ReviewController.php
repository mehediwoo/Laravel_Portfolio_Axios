<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review;

class ReviewController extends Controller
{
    public function index()
    {
        return view('review');
    }
    //Get Review Data
    public function GetData()
    {
        $data = review::orderBy('id','DESC')->get();
        return $data;
    }
    //Delete Review Data
    public function DeleteData(Request $req)
    {
        $id = $req->input('id');
        $data = review::find($id)->delete();
        return $data;
    }
}
