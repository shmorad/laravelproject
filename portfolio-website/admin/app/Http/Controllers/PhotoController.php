<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\photoModel;
use Illuminate\Support\Facades\Storage;
class PhotoController extends Controller
{
    function PhotoIndex(){

        return view('photo');
    }
  
    
    function PhotoDelete(Request $request){
       
        $OldPhotoURL=$request->input('OldPhotoURL');
        $OldPhotoID=$request->input('id');
        $OldPhotoURLArray= explode("/", $OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);
        $DeletePhotoFile= Storage::delete('public/'.$OldPhotoName);
  
        $DeleteRow= photoModel::where('id','=',$OldPhotoID)->delete();
        return  $DeleteRow;
     
    }
  
      function PhotoJSON(Request $request){
          return photoModel::take(8)->get();
      }
  
  
      function PhotoJSONByID(Request $request){
          $FirstID=$request->id;
          $LastID=$FirstID+4;
          return photoModel::where('id','>=',$FirstID)->where('id','<',$LastID)->get();
      }
  
      function PhotoUpload(Request $request){
        $photoPath=$request->file('Photo')->store('public');
  
          $photoName=(explode('/',$photoPath))[1];
  
          $host=$_SERVER['HTTP_HOST'];
          $location="http://".$host."/storage/".$photoName;
  
        $result= photoModel::insert(['location'=>$location]);
        return $result;
      }
}
