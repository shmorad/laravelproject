@extends('layouts.app')
@section('title','Contact')
@section('content')
   <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন  -</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.571495069901!2d90.38537441536323!3d23.79826869286202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c73b33b14efb%3A0xb959463e3f1feb1a!2sMirpur%2014%20Bus%20Stand!5e0!3m2!1sen!2sbd!4v1678353297669!5m2!1sen!2sbd" width="500" height="
                450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> মিরপুর ১৪, ঢাকা<i class="fas ml-2 fa-phone"></i>   ০১৬৪০৬৩৮৬২৮ <i class="fas ml-2 fa-envelope"></i>   md.sahadathossain.ld@gmail.com</p>
                <h3 class="service-card-title">মেসেজ পাঠান </h3>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <a id="contactSendBtnId"  class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </a>
            </div>
        </div>
    </div>
    @endsection