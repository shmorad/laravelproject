@extends('layouts.app')
@section('title','Course')
@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- অনলাইন কোর্স সমূহ -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">

    	@foreach($courseData as $course)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$course->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$course->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$course->course_desc}} </h6>
                    <h6 class="service-card-subTitle p-0 ">{{$course->course_fee ||$course->course_totalClass}}</h6>
                    <h6 class="service-card-subTitle p-0 ">{{$course->course_totalEncroll}}</h6>
                    <a target="_blank" href="{{$course->course_link}}" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                </div>
            </div>
        </div>
		@endforeach


        
    </div>
</div>
@endsection