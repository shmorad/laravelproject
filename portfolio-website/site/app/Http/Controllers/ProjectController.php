<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectModel;
class ProjectController extends Controller
{
    public function projectIndex(){
        $projectData = json_decode(projectModel::orderBy('id','desc')->get());
        return view('project')->with('projectData', $projectData);
    }
}
