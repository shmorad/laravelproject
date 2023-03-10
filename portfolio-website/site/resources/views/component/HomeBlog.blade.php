<div class="container section-marginTop text-center">
    <h1 class="section-title">সাম্প্রতিক ব্লগ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
         @foreach($blogData as $blog)
        <div class="col-md-4  p-2 ">
            <div class="card">
                <img class="w-100"style="height: 400px" src="{{$blog->blog_img}}" alt="Card image cap">
                <div class="w-100 p-4">
                    <h5 class="blog-card-title text-justify  mt-2">{{$blog->blog_name}}</h5>
                    <h6 class="blog-card-subtitle text-justify p-0 ">{{$blog->blog_desc}}</h6>
                    <h6 class="blog-card-date text-justify "> <i class="far fa-clock"></i>০৮/০৩/২০২৩</h6>
                    <a href="{{$blog->blog_link}}" target="_blank" class="normal-btn-outline float-left mt-2 mb-4 btn">আরো পড়ুন</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>