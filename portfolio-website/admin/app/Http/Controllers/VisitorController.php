<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
class VisitorController extends Controller
{
    public function VisitorIndex(){
     $visitorData = json_decode(VisitorModel::orderBy('id','desc')->get());
        return view('visitor')->with('visitor', $visitorData);
    }
}
