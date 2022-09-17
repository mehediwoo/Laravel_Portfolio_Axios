@extends('layout.app')
@section('title','Dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $visitor }}</h3>
                    <h6>Total Visitor</h6>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $service }}</h3>
                    <h6>Total Services</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{ $project }}</h3>
                    <h6 class="count-card-text">Total Project</h6>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{ $course }}</h3>
                    <h6 class="count-card-text">Total Course</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{ $contact }}</h3>
                    <h6 class="count-card-text">Total Contact</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{ $review }}</h3>
                    <h6 class="count-card-text">Total Review</h6>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
