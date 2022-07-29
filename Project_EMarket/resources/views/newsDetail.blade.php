@extends('layouts.app')
@section('content')
<div class="container">
<section aria-label="Main content" role="main" class="product-detail">
    <div class="card mb-3">
        <img src="{{asset('images/'.$newsInfo->news_image)}}" class="card-img-top" height="500" />
 
        <div class="card-body">
          <h5 class="card-title">{{$newsInfo->news_title}}</h5>
          <p class="card-text">{{$newsInfo->news_detail}}</p>
               </div>
      </div>
  
@endsection