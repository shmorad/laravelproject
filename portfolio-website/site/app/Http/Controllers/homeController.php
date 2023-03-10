<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\serviceModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\ContactModel;
use App\Models\BlogModel;
use App\Models\ReviewModel;
class HomeController extends Controller
{
    public function HomeIndex(){
        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);
        $serviceData = json_decode(serviceModel::all());
        $courseData = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
        $projectData = json_decode(projectModel::orderBy('id','desc')->limit(10)->get());
        $blogData = json_decode(BlogModel::orderBy('id','desc')->limit(3)->get());
        $reviewData = json_decode(ReviewModel::all());
        return view('home')
        ->with('serviceData', $serviceData)
        ->with('courseData', $courseData)
        ->with('projectData', $projectData)
        ->with('blogData', $blogData)
        ->with('reviewData', $reviewData);
    }
    public function contactSend(Request $request){
           $contact_name = $request->input('contact_name');
           $contact_mobile = $request->input('contact_mobile');
           $contact_email = $request->input('contact_email');
           $contact_msg = $request->input('contact_msg');
           $result =ContactModel::insert([
                'contact_name'=>$contact_name,
                'contact_mobile'=>$contact_mobile,
                'contact_email'=>$contact_email,
                'contact_msg'=>$contact_msg,
           ]);
           if($result == true){
            return 1;
           }else{
            return 0;
           }

    }
}
