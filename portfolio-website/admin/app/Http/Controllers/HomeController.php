<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\ReviewModel;
use App\Models\serviceModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    public function HomeIndex(){
        $TotalBlog = BlogModel::count();
        $TotalContact = ContactModel::count();
        $TotalCourse = CourseModel::count();
        $TotalProject = projectModel::count();
        $TotalReview = ReviewModel::count();
        $TotalService = serviceModel::count();
        $TotalVisitor = VisitorModel::count();
        return view('home')
        ->with('TotalBlog',$TotalBlog)
        ->with('TotalContact',$TotalContact)
        ->with('TotalCourse',$TotalCourse)
        ->with('TotalProject',$TotalProject)
        ->with('TotalReview',$TotalReview)
        ->with('TotalService',$TotalService)
        ->with('TotalVisitor',$TotalVisitor);
    }
}
