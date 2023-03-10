<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
class CourseController extends Controller
{
    public function courseIndex(){
        $courseData = json_decode(CourseModel::orderBy('id','desc')->get());
        return view('course')->with('courseData', $courseData);
    }
}
