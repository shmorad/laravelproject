<?php
namespace App\Http\Controllers;
use App\Models\CourseModel;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function CoursesIndex(){
        return view('courses');
    }
    public function getCoursesData(){
        $result =json_decode(CourseModel::orderBy('id','desc')->get());
        return $result;
    }
    public function getCoursesDetails(Request $request){
        $id = $request->input('id');
        $result =json_decode(CourseModel::where('id','=',$id)->get());
        return $result;
   }
   public function CoursesDelete(Request $request){
    $id = $request->input('id');
    $result = CourseModel::where('id','=',$id)->delete();
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
   //Courses update
   public function courseUpdate(Request $request){
    $id = $request->input('id');
    $course_name = $request->input('course_name');
    $course_desc = $request->input('course_desc');
    $course_fee = $request->input('course_fee');
    $course_totalEncroll = $request->input('course_totalEncroll');
    $course_totalClass = $request->input('course_totalClass');
    $course_link = $request->input('course_link');
    $course_img = $request->input('course_img');
    $result = CourseModel::where('id','=',$id)->update([
        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalEncroll'=>$course_totalEncroll,
        'course_totalClass'=>$course_totalClass,
        'course_link'=>$course_link,
        'course_img'=>$course_img
]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
  //Add new Service
  public function courseAdd(Request $request){
    $course_name = $request->input('course_name');
    $course_desc = $request->input('course_desc');
    $course_fee = $request->input('course_fee');
    $course_totalEncroll = $request->input('course_totalEncroll');
    $course_totalClass = $request->input('course_totalClass');
    $course_link = $request->input('course_link');
    $course_img = $request->input('course_img');
    $result = CourseModel::insert([
        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalEncroll'=>$course_totalEncroll,
        'course_totalClass'=>$course_totalClass,
        'course_link'=>$course_link,
        'course_img'=>$course_img
    ]);
    if($result==true){
      return 1;
    }else{
      return 0;
    }
 }
}
