@extends('layouts.app')
@section('content')
<div class="slide" >
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" >
      <div class="carousel-item active">
        <img src="{{asset('images\buildings-cellphone-cheerful-1586486.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{asset('images\diagram-direction-electronics-1305360.jpg')}}" class="d-block  w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{asset('images\all1.jpg')}}" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div style="margin-top:28px;margin-bottom:28px;margin-left:20%;"> <h1>Buy Products at Best Price and Fastest Delivery...</h1> 
</div>

<div class="content1">
  <section class="mbr-section content4 data-rv-view=6043" style="background-color:#efefef;">
    <div class="media-container-row" style="height:100px;">
      
      <div style="text-align:center;padding-top:25px;margin-top:10px" ><h1>Latest Smartphones</h1><br>
      </div>
    </div>
  </div>
</section>

<section class="services1 cid-rsuESE0Pe1" id="services1-3">
  
  <div class="container">
    <div class="row" style="margin-top:10px;">
      @foreach($smpInfo as $key=>$value)
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 transform-on-hover">
          <a href="{{route('showProductDetail',$value->id)}}">
            <?php
            $images = $value->image;
            $image = explode(',',$images);
            $first_img = $image[0]; 
            ?>
            
            <img src="{{asset('images/'.$first_img)}}" class="card-img-top" alt="{{$first_img}}"
            style="height:280px;" /></a>
            
            <div class="card-body">
              <a href="{{route('showProductDetail',$value->id)}}" style="color:black;text-decoration:none;">
                <h5>
                  {{$value->model}} <span> ({{$value->brand}}) </span> </h5>
                </a>
                <p class="text-muted card-text"><h4 style="color:#F5762A;font-size:14px;">{{$value->price}} <span style="color:black;font-weight:20px;">MMK</span> </h4>
                  
                </p>
                {!!Form::open(['route'=>['showProductDetail',$value->id],'method'=>'get'])!!}
                <span style="margin-left:35%;">
                  {!! Form::submit('View Detail', ['class' => 'btn btn-outline-dark','style'=>'border-radius:20px;padding:5px;']) !!}
                </span>
                {!!Form::close()!!}
                
              </div>
              
            </div>
          </div>
          @endforeach
        </div>
      </div>
      
    </section>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          {!!Form::open(['route'=>['showSmartPhone'],'method'=>'get'])!!}
          {{ Form::button('More Product', ['class' => 'btn btn-secondary','style'=>'padding:10px 15px 10px 15px ;margin-left:45%;border-radius:10px;','type' => 'submit']) }}
          {!!Form::close()!!}
          
        </div>
      </div>
    </div>
    
    <div class="tablet">
      <section class="mbr-section content4 data-rv-view=6043" style="background-color:#efefef;">
        <div class="media-container-row" style="height:100px;">
          
          <div class=" mbr-fonts-style display-4 " style="text-align:center;padding-top:25px;margin-top:10px" ><h1>Latest Tablets</h1><br>
          </div>
        </div>
      </div>
    </section>
    
    <section class="services1 cid-rsuESE0Pe1" id="services1-3">
      
      <div class="container">
        <div class="row" style="margin-top:10px;">
          @foreach($tabletInfo as $key=>$value)
          <div class="col-md-6 col-lg-4">
            <div class="card border-0 transform-on-hover">
              <a href="{{route('showProductDetail',$value->id)}}">
                <?php
                $images = $value->image;
                $image = explode(',',$images);
                $first_img = $image[0]; 
                ?>
                
                <img src="{{asset('images/'.$first_img)}}" class="card-img-top" alt="{{$first_img}}"
                style="height:280px;" /></a>
                
                <div class="card-body">
                  <a href="{{route('showProductDetail',$value->id)}}" style="color:black;text-decoration:none;">
                    <h3 class="card-title mbr-fonts-style display-5">
                      {{$value->brand}} <span style="font-size:16px;"> ({{$value->model}}) </span> </h3>
                    </a>
                    <p class="text-muted card-text"><h4 style="color:#F5762A;font-size:14px;">{{$value->price}} <span style="color:black;font-weight:20px;">MMK</span> </h4>
                      
                    </p>
                    {!!Form::open(['route'=>['showProductDetail',$value->id],'method'=>'get'])!!}
                    <span style="margin-left:35%;">
                      {!! Form::submit('View Detail', ['class' => 'btn btn-outline-dark','style'=>'border-radius:20px;padding:5px;']) !!}
                    </span>
                    {!!Form::close()!!}
                    
                  </div>
                  
                </div>
              </div>
              @endforeach
            </div>
          </div>
          
        </section>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {!!Form::open(['route'=>['showLaptop'],'method'=>'get'])!!}
              {{ Form::button('More Product', ['class' => 'btn btn-secondary','style'=>'padding:10px 15px 10px 15px ;margin-left:45%;border-radius:10px;','type' => 'submit']) }}
              {!!Form::close()!!}
              
            </div>
          </div>
        </div>
        
        <div class="labtop">
          <section class="mbr-section content4 data-rv-view=6043" style="background-color:#efefef;">
            <div class="media-container-row" style="height:100px;">
              
              <div class=" mbr-fonts-style display-4 " style="text-align:center;padding-top:25px;margin-top:10px" ><h1>Latest Labtop</h1><br>
              </div>
            </div>
          </div>
        </section>
        
        <section class="services1 cid-rsuESE0Pe1" id="services1-3">
          
          <div class="container">
            <div class="row" style="margin-top:10px;">
              @foreach($labtopInfo as $key=>$value)
              <?php
              $images = $value->image;
              $image = explode(',',$images);
              $first_img = $image[0]; 
              // dd($first_img);
              ?>
              <div class="col-md-6 col-lg-4">
                <div class="card border-0 transform-on-hover">
                  <a href="{{route('showProductDetail',$value->id)}}">
                    
                    
                    <img src="{{asset('images/'.$first_img)}}" class="card-img-top" alt=""
                    style="height:280px;" /></a>
                    
                    <div class="card-body">
                      <a href="{{route('showProductDetail',$value->id)}}" style="color:black;text-decoration:none;">
                        <h3 class="card-title mbr-fonts-style display-5">
                          {{$value->brand}} <span style="font-size:16px;"> ({{$value->model}}) </span> </h3>
                        </a>
                        <p class="text-muted card-text"><h4 style="color:#F5762A;font-size:14px;">{{$value->price}} <span style="color:black;font-weight:20px;">MMK</span> </h4>
                          
                        </p>
                        {!!Form::open(['route'=>['showProductDetail',$value->id],'method'=>'get'])!!}
                        <span style="margin-left:35%;">
                          {!! Form::submit('View Detail', ['class' => 'btn btn-outline-dark','style'=>'border-radius:20px;padding:5px;']) !!}
                        </span>
                        {!!Form::close()!!}
                        
                      </div>
                      
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              
            </section>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {!!Form::open(['route'=>['showTablet'],'method'=>'get'])!!}
                  {{ Form::button('More Product', ['class' => 'btn btn-secondary','style'=>'padding:10px 15px 10px 15px ;margin-left:45%;border-radius:10px;','type' => 'submit']) }}
                  {!!Form::close()!!}
                  
                </div>
              </div>
            </div>
            <div class="content1">
              <section class="mbr-section content4 data-rv-view=6043" style="background-color:#efefef;">
                <div class="media-container-row" style="height:100px;">
                  
                  <div class=" mbr-fonts-style display-4 " style="text-align:center;padding-top:25px;margin-top:10px" ><h1>Latest NEWS</h1><br>
                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row" style="margin-top:10px;">
                  @foreach($newsInfo as $key=>$value)
                  <div class="col-md-6 col-lg-4">
                    <div class="card border-0 transform-on-hover">
                      <a href="{{route('showNewsDetail',$value->id)}}">
                        
                        
                        <img src="{{asset('images/'.$value->news_image)}}" class="card-img-top" alt="{{$value->news_image}}"
                        style="height:280px;" /></a>
                        
                        <div class="card-body">
                          <a href="{{route('showNewsDetail',$value->id)}}" style="color:black;text-decoration:none;">
                            
                            <p class="text-muted card-text"><h4 style="color:#F5762A;font-size:14px;">{{$value->news_title}}</span> </h4>
                              
                            </p>
                            {!!Form::open(['route'=>['showNewsDetail',$value->id],'method'=>'get'])!!}
                            <span style="margin-left:35%;">
                              {!! Form::submit('View Detail', ['class' => 'btn btn-outline-dark','style'=>'border-radius:20px;padding:5px;']) !!}
                            </span>
                            {!!Form::close()!!}
                            
                          </div>
                          
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        
                      </div>
                    </div>
                  </div>
                  {{-- </div> --}}
                  @endsection