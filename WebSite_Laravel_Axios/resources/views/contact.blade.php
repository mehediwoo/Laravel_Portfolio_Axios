@extends('layout.app')
@section('title','Contact')
@section('content')


<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="images/code.svg">
            <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6" style="margin-top: 40px">
			<iframe style="width: 100%;height: 460px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1291.157434712905!2d90.41084513955667!3d23.749350957800477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b996041fc4e5%3A0x22a1e08264aa6d10!2z4Kaf4Ka_4Ka44Ka_4KaP4KauIOCmtuCmv-CmtuCngeCmqOCngOCnnA!5e0!3m2!1sen!2sbd!4v1663174995878!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<div class="col-md-6 contact-form">
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <br>
                <p><i class="fas  ml-2 fa-map-marker-alt"></i> ডাক্টার গলি, মগবাযার, ঢাকা <i class="fas  ml-2 fa-phone"></i> ০১৫১৮-৯১২৪১৭ <i class="fas fa-envelope"></i> mehedilrs@gmail.com</p>
                <div class="form-group ">
                    <input type="text" id="name" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input type="text" id="phone" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input type="text" id="mail" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <textarea name="" id="desc" cols="5" rows="5" class="form-control  w-100" placeholder="মেসেজ "></textarea>
                </div>
                <button type="submit" id="sendBtn" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>
	</div>
</div>

@endsection