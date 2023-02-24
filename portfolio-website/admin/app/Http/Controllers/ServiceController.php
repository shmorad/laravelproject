<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use DB;
class ServiceController extends Controller
{
    public function serviceIndex(){
        return view('service');
        // return "Ok";
    }


    public function getServicesData(){
        $result=Service::all();
        // return $result;
        return response()->json([
            'data' => $result,
            'status' => 'ok',
        ]);
    }

   
}
