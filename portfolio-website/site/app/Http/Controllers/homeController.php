<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
use App\Models\Service;

class homeController extends Controller
{
    public function homeindex(){
        $userIp=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date("Y-m-d h:i:sa");
        visitorModel::insert(["ip_address"=>$userIp,"visitingTime"=>$timeDate]);


        $servicesData =json_decode(Service::all());

        return view('home')->with('services', $servicesData);
    }
}
