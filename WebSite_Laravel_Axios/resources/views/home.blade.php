@extends('layout.app')

@section('title','Home')

@section('content')

@include('HomeComponent.HomeBanner')
@include('HomeComponent.HomeServices')
@include('HomeComponent.HomeCourse')
@include('HomeComponent.HomeProject')
@include('HomeComponent.HomeContact')
@include('HomeComponent.HomeRecentBlog')
@include('HomeComponent.HomeClients')

@endsection