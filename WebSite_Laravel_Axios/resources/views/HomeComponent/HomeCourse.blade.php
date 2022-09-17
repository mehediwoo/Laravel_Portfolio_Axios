<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
        @foreach($course as $course)
        <div class="col-md-4 thumbnail-container">
                <img src="{{$course->courseImage}}" alt="Avatar" class="thumbnail-image ">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> {{$course->courseName}}</h1>
                    <h1 class="thumbnail-subtitle">{{$course->courseDesc}} </h1>
                    <h1 class="thumbnail-subtitle">{{$course->courseFee}}</h1>
                    <h1 class="thumbnail-subtitle"> {{$course->courseTotalEnroll}} </h1>
                    <h1 class="thumbnail-subtitle"> {{$course->courseTotalClass}} </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div>
        @endforeach
    </div>
</div>