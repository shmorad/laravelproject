<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
class BlogController extends Controller
{
    public function blogIndex(){
        $blogData = json_decode(BlogModel::orderBy('id','desc')->get());
        return view('blog')->with('blogData', $blogData);
    }
}
