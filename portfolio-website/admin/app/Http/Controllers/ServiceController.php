<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\serviceModel;
class ServiceController extends Controller
{
   public function ServiceIndex(){
    return view('services');
   }

   public function getServiceData(){
        $result =json_decode(serviceModel::orderBy('id','desc')->get());
        return $result;
   }
   public function getServiceDetails(Request $request){
        $id = $request->input('id');
        $result =json_decode(serviceModel::where('id','=',$id)->get());
        return $result;
   }
   public function serviceDelete(Request $request){
      $id = $request->input('id');
      $result = serviceModel::where('id','=',$id)->delete();
      if($result==true){
        return 1;
      }else{
        return 0;
      }
   }
  //  srevice update
   public function serviceUpdate(Request $request){
      $id = $request->input('id');
      $name = $request->input('name');
      $des = $request->input('des');
      $img = $request->input('img');
      $result = serviceModel::where('id','=',$id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
      if($result==true){
        return 1;
      }else{
        return 0;
      }
   }
  //  Add new Service
   public function serviceAdd(Request $request){
      $name = $request->input('name');
      $des = $request->input('des');
      $img = $request->input('img');
      $result = serviceModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
      if($result==true){
        return 1;
      }else{
        return 0;
      }
   }
}
