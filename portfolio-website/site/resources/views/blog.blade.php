@extends('layouts.app')
@section('title','Blog')
@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <h1 class="page-top-title mt-3">- ব্লগ পড়ুন  -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
    	@foreach($blogData as $blog)
        <div class="col-md-4 p-1 ">
            <div class="card">
                    <img class="w-100" src="{{$blog->blog_img}}" alt="Card image cap">
                    <div class="w-100 p-4">
                        <h5 class="blog-card-title mt-2">{{$blog->blog_name}}</h5>
                        <h6 class="blog-card-subtitle p-0 ">{{$blog->blog_desc}}</h6>
                        <h6 class="blog-card-date "> <i class="far fa-clock"></i> ২৪/০৫/২০২০</h6>
                        <a target="_blank" href="{{$blog->blog_link}}" class="normal-btn-outline mt-2 mb-4 btn">আরো পড়ুন </a>
                    </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection