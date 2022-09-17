<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function getContact(){
       $data =  Contact::orderBy('id','desc')->get();
       return $data;
    }
    public function contactDelete(Request $req)
    {
        $id = $req->input('id');
        $data = Contact::where('id',$id)->delete();
        return $data;
        // if ($data==true) {
        //     return 1;
        // }else{
        //     return 0;
        // }
    }
}
