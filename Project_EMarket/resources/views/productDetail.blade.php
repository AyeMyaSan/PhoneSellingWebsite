@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
@csrf
{{-- {{dd($productInfo)}} --}}
<section aria-label="Main content" role="main" class="product-detail" style="padding:0;">
  <div class="shadow">
    <div class="_cont detail-top">
      <div class="cols">
        <div class="left-col">
          <div class="big">
            <div id="big-image">
              <div id="img">
                <?php 
                $flag = false;
                if(!empty($productInfo->image)){
                  $flag = true;
                }
                ?>
                @if($flag != false)
                <div class="mdb-lightbox">
                  <?php $img = explode(', ',$productInfo->image); ?>
                  <figure class="col-12" class="pre-image" id="pre-image"
                  style="padding-left:0; padding-right:0; padding-bottom: 10px;">
                  <img src="{{asset('images/'.$img[0])}}" class="card-img-detail change-image pre-img zoo-item"
                  alt="" id="pre-img" style="width:100%;height:55%;">
                </figure>
              </div>
              @endif
            </div>
            {{-- Review --}}
            <div class="container" style="margin-top:10px;">
              @if(count($reviewInfo) < 1) @else <h2 class="text-secondary text-center"
              style="font-size:25px;margin-bottom:10px;">Review</h2>
              <div class="card" style="background-color:#fafafa;">
                <div class="card-body">
                  <div class="row">
                    @foreach ($reviewInfo as $key=>$values)
                    
                    <?php
                    $rating =  $values->rev_rating ;
                    ?>
                    <div class="col-md-12" style="border-bottom:1px solid #eeeeee;margin-bottom:10px;">
                      <span>
                        <h5>{{ $values->name }}</h5>
                      </span>
                      <span style="color:darkgrey;">{{$values->rev_title }}
                        @for($i=0;$i<$rating;$i++) <span class="float-right"><i
                          class="text-warning fa fa-star"></i></span>
                        </span>
                        @endfor
                        <div class="clearfix"></div>
                        <span>{{ $values->rev_msg }}</span>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif
                @if (Auth::guest())
                @else
                <div>
                  @if(!empty(session('success_msg')))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success_msg')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                </div>
                <div class="form-group" id="myDIV">
                  <h4 class="text-secondary text-center" style="font-size:25px;margin-bottom:10px;margin-top:10px;">
                    Leave Review</h4>
                    {!!Form::open(['route'=>'addReview','method'=>'post', 'class' => 'd-inline'])!!}
                    {!!Form::hidden('id',$productInfo->id)!!}
                    {!!Form::hidden('category',$productInfo->category)!!}
                    <div class="form-group">
                      {!!Form::label('rev_title','Review Title:')!!}
                      {!! Form::text('rev_title','',['class' => 'form-control' ,'placeholder'=>'Enter your review title'
                      ]) !!}
                      <span class="text-danger">{{$errors->first('rev_title')}}</span>
                    </div>
                    <div class="form-group">
                      {!!Form::label('rev_rating','Product Rating:')!!}
                      {!!Form::select('rev_rating',['1' => '1', '2' => '2', '3'
                      => '3', '4' => '4','5' => '5',], null, ["class" => "form-control" ])!!}
                      <span class="text-danger">{{$errors->first('rev_rating')}}</span>
                    </div>
                    <div style="margin-bottom:10px;">
                      {!! Form::textarea('rev_msg','',['class' => 'form-control' ,'rows' => 4,'placeholder'=>'Enter your review!' ]) !!}
                      <span class="text-danger">{{$errors->first('rev_msg')}}</span>
                    </div>
                    <div style="margin-left:40%;">
                      {!! Form::submit('Post', ['class' => 'btn btn-primary','onclick' => "return ('Are you sure to
                      delete this post?')"]) !!}
                      {!!Form::close()!!}
                    </div>
                  </div>
                  @endif
                </div>
                {{-- End of Review --}}
              </div>
              <div class="detail-socials">
                <div class="social-sharing">
                  <a target="_blank"><i class="fab fa-facebook-f fa-lg fa-2x  blue-text" title="Share"></i></a>
                  <a target="_blank"><i class="fab fa-twitter fa-lg fa-2x blue-text" title="Tweet"></i></a>
                  <a target="_blank"><i class="fab fa-pinterest fa-lg fa-2x red-text" title="Pin it"></i></a>
                </div>
              </div>
            </div>
          </div>
          {{-- end left column --}}
          {!!Form::open(['route'=>'addToCart','method'=>'post'])!!}
          @csrf
          {!!Form::hidden('id',$productInfo->id)!!}
          {!!Form::hidden('hiddenimg','',['class'=>'hiddenimg'])!!}
          
          <div class="right-col">
            <h1 itemprop="name">{{$productInfo->model}}</h1>
            <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
              <meta itemprop="priceCurrency" content="MMK">
              <div class="price-shipping">
                <div class="price" id="price-preview" quickbeam="price" quickbeam-price="800">
                  {{$productInfo->price}}MMK
                </div>
                <a>Free shipping</a>
              </div>
              <?php
              $color = $productInfo->color;
              $colors = explode(',',$color);
              ?>
              <div class="swatch clearfix" data-option-index="1">
                <div class="header">Color</div>
                @foreach($colors as $key=>$value)
                <div data-value="{{$value}}" class="swatch-element color  available">
                  <div class="tooltip">{{$value}}</div>
                  <input quickbeam="color" id="{{$value}}" type="radio" name="option" value="{{$value}}"/>
                  <label for="{{$value}}" style="border-color: {{$value}};">
                    <img class="crossed-out"
                    src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    <span style="background-color: {{$value}};"></span>
                  </label>
                </div>
                @endforeach
                <span class="text-danger">{{$errors->first('option')}}</span>
              </div>

              
              
              <div class="clearfix"></div>
              <div class="tabs">
                <div style="float:left;">
                  {!! Form::submit('Add To Cart', ['class' => 'btn btn-lg','id' => "update", 'name' => "btn_add_post"
                  ,'style'
                  =>
                  'padding: 14px 26px 14px 53px; width: 200px; -moz-border-radius: 25px;margin-top:2px;
                  -webkit-border-radius: 25px;border-radius: 25px;color:#fff; background: #00AB0E']) !!}
                  {!!Form::close()!!}
                </div>
                <div>
                  @if (Auth::guest())
                  <i class="fas fa-heart heart"></i>
                  @else
                  <i class="fas fa-heart heart   
                  @php
                  foreach($productwish as $wish => $wishes){
                    if($productInfo->id == $wishes->p_id)
                    echo 'red';
                    
                    
                  }
                  @endphp" id="heart_{{$productInfo->id}}" data-id="{{$productInfo->id}}"></i>
                  @endif
                </div>
              </div>
              
              <div class="tabs">
                <div class="left-col">
                  <p> Brand: {{$productInfo->brand}}</p>
                  <p> Resolution:{{$productInfo->resolution}}</p>
                  <p> Screen Size: {{$productInfo->screensize}}</p>
                  <p> CPU:{{$productInfo->cpu}}</p>
                  <p> GPU: {{$productInfo->gpu}}</p>
                  <p> OS:{{$productInfo->os}}</p>
                  
                </div>
                <div class="left-col">
                  <p>RAM:{{$productInfo->ram}}</p>
                  <p> Memory: {{$productInfo->memory}}</p>
                  <p> Camera: {{$productInfo->camera}}</p>
                  <p> Battery: {{$productInfo->battery}}</p>
                  <p> Other: {!!Form::label('feactures',$productInfo->other_feactures,['class' => 'other_feactures']);!!} </p>
                </div>
               
                <?php

                $html = Html2Text\Html2Text::convert($productInfo->other_feactures);

require('html2text.php');

$text = convert_html_to_text($html);

// Simply call the get_text() method for the class to convert
// the HTML to the plain text. Store it into the variable.
$text = $text->get_text();

// Or, alternatively, you can print it out directly:
echo $text;

?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  @endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  @section('script')
// <script>
//   $(document).ready(function(){
//     var details = $("input[name='feactures']").val();
//     $html = new \Html2Text\Html2Text(details);
//     echo $html->getText();
//     var format = $html->getText();

//     $('.other_feactures').attr("value",format);
//   });
// </script>
  <script>
    $(document).ready(function(){
      $("input[name='option']").change(function(){
        var colorSelected = $("input[name='option']:checked").val();
        var id = $("input[name='id']").val();
        var category = $("input[name='category']").val();

        $.ajax({
          url: "/product_detail/change/image",
          type: 'GET',
          data: {
            _token: "{{ csrf_token() }}",
            id: id,
            category: category,
            colorSelected: colorSelected
          },
          dataType: 'json',
          
          success: function(data) {  
            console.log(data);
            var len = data.length;
            getColor(data,len); 
            
          }
        });
        function getColor(clr,len){
          var h = len/2;
          $.each(clr,function(index, value) {    
            if(value == colorSelected){
              var image = clr[index%h];
              var localhost = "http://localhost:8001/images/";
              var src = localhost + image;
              $(".pre-img").attr("src", src);
              $('.hiddenimg').attr("value",image);
            } 
          }); 
          
        }
        
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      
      $(".heart").click(function(){
        var ele = $(this);
        id = ele.attr('data-id');
        
        if (ele.hasClass('red')) {
          $.ajax({
            type: "POST",
            url: "{{ route('removewishlist') }}",
            data: {_token: "{{ csrf_token() }}",
            id: ele.attr("data-id")},
            success: function (res) {
              console.log(res);
              ele.removeClass('red');
            }
          });
        } else {
          $.ajax({
            type: "POST",
            url: "{{ route('store') }}",
            data: {
              _token: "{{ csrf_token() }}", 
              id: ele.attr("data-id")
            },
            success: function (res) {
              console.log(res);
              
              ele.addClass('red');
            }
          });
        }
      });
    });
  </script>
  <script src="{{asset('js/priceRange.js')}}"></script>
  