<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
class VisitorController extends Controller
{
    public function visitorIndex(){
        
        $visitorData =json_decode(visitorModel::all());
        return view('visitor')->with('visitor', $visitorData);
    }
}
