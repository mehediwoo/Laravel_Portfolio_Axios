<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        return view('photo');
    }
    //Getting All Photo to gallery
    public function GetPhoto()
    {
        $GetPhoto = Photo::orderBy('id','DESC')->take(4)->get();
        return $GetPhoto;
    }
    //Getting All Photo to gallery with load more systeam
    public function GetPhotoLoadMore(Request $request)
    {
        $firstId = $request->id;
        $LastId  = $firstId+4;
        $LoadMore= Photo::where('id','>=',$firstId)->where('id','<',$LastId)->get();
        if($LoadMore==true){
            return 1;
        }else{
            return 0;
        }
    }
    //Upload all Gallery Photo
    public function PhotoUpload(Request $req)
    {
       $photoData =  $req->file('photo')->store('public');
       $photoName= (explode('/',$photoData))[1];
       $path      = $_SERVER['HTTP_HOST'];
       $insert = new Photo;
       $insert->location ="http://".$path."/storage/".$photoName;
       $insert->save();
       return $insert;

    }
}
