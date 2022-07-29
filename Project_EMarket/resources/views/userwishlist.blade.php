@extends('cusIndex')
@section('cc')
<div class="container" style="width:900px;">
  <div class="col-md-12">
      <span>
          <h2 style="font-weight: bold;margin-bottom:20px;">My Wishlists</h2>
        </span>
    <div class="row" style="display:flex; align:center;">
      @if(count($wishlistInfo) < 1) <div class="text-center pt-4"><i class="fas fa-exclamation-triangle text-center"></i>
      </div>
      <h3 class="text-center pt-2 warning">No Wishlist have been found!</h3>
      <div class="text-center pt-4"><a href={{route('showSmartPhone')}} class="btn btn-primary">Add to Wishlist</a></div>
      @endif
      @foreach($wishlistInfo as $key=>$value)
      <?php
      $images = $value->image;
      $image = explode(',',$images);
      $first_img = $image[0]; 
      // dd($first_img);
      ?>
      <div class="col-md-6 col-sm-6">
        <div class="card" style="margin-bottom:5px;">
          <span class="product-new-label"
          style="color:#fff;background-color:#ef5777;font-size:12px;text-transform:uppercase;padding:2px 7px;display:block;position:absolute;top:10px;left:0">Sale</span>
          <a href="{{route('showProductDetail',$value->id)}}"><img src="{{asset('images/'.$first_img)}}" class="card-img-top" alt="{{$value->Image}}"
            /></a>
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
                  {!! Form::submit('View Detail', ['class' => 'btn btn-sm btn-primary']) !!}
                  {!!Form::close()!!}
                  </div>
                  <div style="margin-left:70%;">
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
@endsection
