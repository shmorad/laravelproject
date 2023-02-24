@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="container-fluid parallax mb-5">
    <div class="row m-0 d-flex justify-content-center">
        <div class="col-md-4 text-center topDiv">
            <h1 class="font-weight-normal text-secondary">Software Engineer</h1>
            <h3 class="font-weight-normal text-secondary">Mobile & Web</h3>
            <button class="btn btn-primary">Learn More</button>
        </div>
    </div>
</div>


<div class="container text-center mb-5 mt-5">
    <h2 class="text-secondary mb-5">My Service</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <button class="btn btn-primary">Learn More</button>
                </div>
              </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <button class="btn btn-primary">Learn More</button>
                </div>
              </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Service Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <button class="btn btn-primary">Learn More</button>
                </div>
              </div>
        </div>

    </div>
</div>

<div class="container text-center mb-5 mt-5">
    <h2 class="text-secondary mb-5">Recent Project</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Project Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                </div>
              </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Project Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                </div>
              </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="{{asset('images/laravel.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Project Name</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                </div>
              </div>
        </div>

    </div>
</div>


<div class="container mt-5 mb-5">
    <h2 class="text-secondary mb-5 text-center">Contact With Me.</h2>
    <div class="row">

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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.571495069901!2d90.38537441536323!3d23.79826869286202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c73b33b14efb%3A0xb959463e3f1feb1a!2sMirpur%2014%20Bus%20Stand!5e0!3m2!1sen!2sbd!4v1677251440976!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

@endsection