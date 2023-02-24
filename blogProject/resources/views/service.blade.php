@extends('layouts.app')
@section('title','Service')

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 bg-dark p-4 text-center">
        <h3 class="text-white">My Service</h3>
    </div>
</div>
</div> 


<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>


        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                </div>
              </div>
        </div>


        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mb-5">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Your Number</label>
                    <input type="number" name="number" class="form-control">
                </div>
                <button type="submit" class="btn btn-block btn-primary">Send Now</button>
            </form>
        </div>



        <div class="col-md-6">
            <h3 class="text-secondary">ADDRESS</h3>
            <p>Village -  Nowhata,PostOffice- Rampur Nowhata, Thana- Hajigonj, District- Chandpur.</p>
            <p>Email:- md.sahadathossain.ld@gmail.com</p>
            <p>GitHub:- https://github.com/shmorad</p>
            <p>Mobile Number:- 01640638628</p>
        </div>
    </div>
</div>



@endsection