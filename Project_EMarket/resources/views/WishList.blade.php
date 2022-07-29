@extends('layouts.app')
@section('content')
@if(count($wishlistInfo) < 1) <div class="text-center pt-4" style="padding-top:150px;"><i class="fas fa-exclamation-triangle text-center fa-3x"></i>
  
  <h3 class="text-center pt-2 warning" style="padding:160px;">No Wishlist have been found!</h3></div>  @endif
<div class="container justify-content-center">
  <div class="col-md-12">
    <div class="row" style="display:flex; align:center;">

      @foreach($wishlistInfo as $key=>$value)
      <?php
            $images = $value->image;
            $image = explode(',',$images);
            $first_img = $image[0]; 
            // dd($first_img);
            ?>
      <div class="col-md-4 col-sm-6">
        <div class="card" style="margin-bottom:5px;">
          <span class="product-new-label"
          style="color:#fff;background-color:#ef5777;font-size:12px;text-transform:uppercase;padding:2px 7px;display:block;position:absolute;top:10px;left:0">Sale</span>
          <a href="{{route('showProductDetail',$value->id)}}"><img src="{{asset('images/'.$first_img)}}" class="card-img-top" alt="{{$value->Image}}"
            style="height:280px;" /></a>
            <div class="card-body">
              <h4 class="card-title mbr-fonts-style display-5">
                <a href="{{route('showProductDetail',$value->id)}}">
                  <p class="card-text" style="color:black;">{{$value->model}}&nbsp;({{$value->ram}}/{{$value->memory}})</p>
                </a>
                
              </h4>
              <p class="card-text" style="color:black;">{{$value->brand}}<br>{{$value->color}}</p>
              <p class="card-text" style="color:#F5762A"> {{$value->price}} </p>
              <div style="float:left;">
              {!!Form::open(['route'=>['showProductDetail',$value->id],'method'=>'get'])!!}
              {!! Form::submit('View Detail', ['class' => 'btn btn-lg btn-primary']) !!}
              {!!Form::close()!!}
              </div>
              <div style="margin-left:70%;padding-top:10px;">
                <div class="wrapper">
                  
                  {!!Form::open(['route'=>['delwishlist',$value->id],'method'=>'get'])!!}
                  {{ Form::button('<i class="far fa-trash-alt" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) }}
                  {!!Form::close()!!} 
                  
                </div>
              </div>       
              
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endsection
  