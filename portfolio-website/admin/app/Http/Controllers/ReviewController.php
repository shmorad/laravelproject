<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;
class ReviewController extends Controller
{
    public function reviewIndex(){
        return view('review');
    }
    public function getReviewData(){
        $result =json_decode(ReviewModel::orderBy('id','desc')->get());
        return $result;
    }
    public function getReviewDetails(Request $request){
        $id = $request->input('id');
        $result =json_decode(ReviewModel::where('id','=',$id)->get());
        return $result;
   }
   public function reviewDelete(Request $request){
    $id = $request->input('id');
    $result = ReviewModel::where('id','=',$id)->delete();
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
   //Review update
   public function reviewUpdate(Request $request){
    $id = $request->input('id');
    $review_name = $request->input('name');
    $review_desc = $request->input('des');
    $review_img = $request->input('img');
    $result = ReviewModel::where('id','=',$id)->update([
        'name'=>$review_name,
        'des'=>$review_desc,
        'img'=>$review_img
]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
  //Add new project
  public function reviewAdd(Request $request){
    $review_name = $request->input('name');
    $review_desc = $request->input('des');
    $review_img = $request->input('img');
    $result = ReviewModel::insert([
        'name'=>$review_name,
        'des'=>$review_desc,
        'img'=>$review_img
    ]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
}
