<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectModel;
class projectController extends Controller
{
    public function projectIndex(){
        return view('project');
    }
    public function getProjectData(){
        $result =json_decode(projectModel::orderBy('id','desc')->get());
        return $result;
    }
    public function getProjectDetails(Request $request){
        $id = $request->input('id');
        $result =json_decode(projectModel::where('id','=',$id)->get());
        return $result;
   }
   public function projectDelete(Request $request){
    $id = $request->input('id');
    $result = projectModel::where('id','=',$id)->delete();
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
   //Courses update
   public function projectUpdate(Request $request){
    $id = $request->input('id');
    $project_name = $request->input('project_name');
    $project_desc = $request->input('project_desc');
    $project_link = $request->input('project_link');
    $project_img = $request->input('project_img');
    $result = projectModel::where('id','=',$id)->update([
        'project_name'=>$project_name,
        'project_desc'=>$project_desc,
        'project_link'=>$project_link,
        'project_img'=>$project_img,
]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
  //Add new project
  public function projectAdd(Request $request){
    $project_name = $request->input('project_name');
    $project_desc = $request->input('project_desc');
    $project_link = $request->input('project_link');
    $project_img = $request->input('project_img');
    $result = projectModel::insert([
        'project_name'=>$project_name,
        'project_desc'=>$project_desc,
        'project_link'=>$project_link,
        'project_img'=>$project_img,
    ]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
}
