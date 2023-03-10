<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
class ContactController extends Controller
{
    public function contactIndex(){
        return view('contact');
    }
    public function getContactData(){
        $result =json_decode(ContactModel::orderBy('id','desc')->get());
        return $result;
    }
//     public function getProjectDetails(Request $request){
//         $id = $request->input('id');
//         $result =json_decode(ContactModel::where('id','=',$id)->get());
//         return $result;
//    }
   public function contactDelete(Request $request){
    $id = $request->input('id');
    $result = ContactModel::where('id','=',$id)->delete();
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
}
