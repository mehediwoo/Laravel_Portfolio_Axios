@extends('layout.app')
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
    	@foreach($course as $iteam)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$iteam->courseImage}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$iteam->courseName}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$iteam->courseDesc}}</h6>
                    <h6 class="service-card-subTitle p-0 ">{{$iteam->courseTotalEnroll}} , {{$iteam->courseTotalClass}} </h6>
                    <button class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </button>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection