<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
class BlogController extends Controller
{
    public function blogIndex(){
        return view('blog');
    }
    public function getBlogData(){
        $result =json_decode(BlogModel::orderBy('id','desc')->get());
        return $result;
    }
    public function getBlogDetails(Request $request){
        $id = $request->input('id');
        $result =json_decode(BlogModel::where('id','=',$id)->get());
        return $result;
   }
   public function blogDelete(Request $request){
    $id = $request->input('id');
    $result = BlogModel::where('id','=',$id)->delete();
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
   //Courses update
   public function blogUpdate(Request $request){
    $id = $request->input('id');
    $blog_name = $request->input('blog_name');
    $blog_desc = $request->input('blog_desc');
    $blog_link = $request->input('blog_link');
    $blog_img = $request->input('blog_img');
    $result = BlogModel::where('id','=',$id)->update([
        'blog_name'=>$blog_name,
        'blog_desc'=>$blog_desc,
        'blog_link'=>$blog_link,
        'blog_img'=>$blog_img,
]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
  //Add new project
  public function blogAdd(Request $request){
    $blog_name = $request->input('blog_name');
    $blog_desc = $request->input('blog_desc');
    $blog_link = $request->input('blog_link');
    $blog_img = $request->input('blog_img');
    $result = BlogModel::insert([
        'blog_name'=>$blog_name,
        'blog_desc'=>$blog_desc,
        'blog_link'=>$blog_link,
        'blog_img'=>$blog_img,
    ]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
}
