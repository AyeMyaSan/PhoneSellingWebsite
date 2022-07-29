@extends('layouts.app')
@section('content')
<section class="mbr-section content4 cid-qvXDlTpHu4" id="content4-l" data-rv-view="670"
style="background-color: #efefef;margin-bottom:10px;">
<div class="container">
  <div class="media-container-row">
    <h2 class="text-center mbr-fonts-style display-4">
      SmartPhones</h2>
    </div>
  </div>
</section>

<div class="row justify-content-center" style="padding:20px;">
  
  <div class="col-md-3">
    <form class="form-horizontal">
      <div class="form-group">
        {!! Form::label('brand-select', 'Choose a Brand') !!}
        {!! Form::select('brand-select',$brandInfo,'all', ['class'=>'form-control', 'onChange'=>'filterText()']) !!}
      </div>
    </form>
    
    <form class="form-horizontal">
      <div class="form-group">
        {!! Form::label('ram-select', 'Choose a RAM') !!}
        {!! Form::select('ram-select', $ramInfo,'all', ['class'=>'form-control', 'onChange'=>'filterText()']) !!}
      </div>
    </form>
    
    <form class="form-horizontal">
      <div class="form-group">
        <div id="slider-range" class="price-filter-range" name="rangeInput"></div><br>
        <input type="number" min={{$priceInfo->first()}} max={{$priceInfo->last()-10000}} oninput="validity.valid||(value='0');" id="min_price"
        class="price-range-field" value="{{$priceInfo->first()}}" />
        <input type="number" min={{$priceInfo->first()}} max={{$priceInfo->last()}} oninput="validity.valid||(value='100000');" id="max_price"
        class="price-range-field" value="{{$priceInfo->last()}}" />
      </div>
    </form>
    <form class="form-horizontal">
      <div class="form-group" style="margin-left:15px;margin-right:15px;">
        <div class="row" style="padding-top: 6px; margin-bottom: 10px;">
          <a class="btn btn-block btn-sm btn-primary" href="{{route('showSmartPhone')}}">Show All Phones</a>
        </div>
      </div>
    </form>
  </div>
  
  <div class="col-md-9 col-xs-12 col-xs-12 ">
    <div class="row flex" style="display:flex; align:center;">
      @if(count($productInfo) < 1) <div class="text-center pt-4"><i class="fas fa-exclamation-triangle text-center"></i>
      </div>
      <h3 class="text-center pt-2 warning">No Posts have been found!</h3>
      @endif
      <div id='loader' style='display: none;'>
        <img src={{asset('images/loading.png')}} height='242px' style="display: block;
        margin-left: auto;margin-right: auto; width: 30%;">
      </div>
      
      <div class="row">
        @foreach($productInfo as $key=>$value)
        <?php
        $images = $value->image;
        $image = explode(',',$images);
        $first_img = $image[0]; 
        // dd($first_img);
        ?>
        <div class="col-md-4 col-sm-6 col-xs-12 content">
          <div class="card" style="margin-bottom:5px;">
            <span class="product-new-label"
            style="color:#fff;background-color:#ef5777;font-size:12px;text-transform:uppercase;padding:2px 7px;display:block;position:absolute;top:10px;left:0">Sale</span>
            <a href="{{route('showProductDetail',$value->id)}}"><img src="{{asset('images/'.$first_img)}}"
              class="card-img-top" alt="{{$first_img}}" style="height:280px;" /></a>
              <div class="card-body">
                <h4 class="card-title mbr-fonts-style display-5">
                  <a href="{{route('showProductDetail',$value->id)}}">
                    <p>{{$value->model}}&nbsp;
                      <span class="card-text" id="ram-select">({{$value->ram}}/{{$value->memory}})</span>
                    </p>
                  </a>
                </h4>
                <p class="card-text" id="brand-select">{{$value->brand}}<br>{{$value->color}}</p>
                <p class="card-text content-price" style="color:#F5762A"> {{$value->price}} &nbsp;MMK </p>
                <div style="float:left;">
                  {!!Form::open(['route'=>['showProductDetail',$value->id],'method'=>'get'])!!}
                  {{-- {!! Form::submit('View Detail', ['class' => 'btn btn-sm aqua-gradient']) !!} --}}
                  {!! Form::submit('View Detail', ['class' => 'btn btn-sm btn-primary']) !!}
                  {!!Form::close()!!}
                </div>
                <div style="margin-left:80%;">
                  <div class="wrapper">
                    @if (Auth::guest())
                    <i class="fas fa-heart fa-2x heart"></i>
                    @else
                    <i class="fas fa-heart fa-2x heart    
                    @php
                    foreach($productwish as $wish => $wishes){
                      if($value->id == $wishes->p_id)
                      echo 'red';
                    }
                    @endphp" id="heart_{{$value->id}}" data-id="{{$value->id}}"></i>
                    @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    @section('script')
    <script>
      function filterText() {    
        $('.content').hide().filter(function() {
          return contentFilter($(this));
        }).show();
      }
      
      function contentFilter(content) {
        let selectorFilter = function(select) {  
          regex = new RegExp(select.find(':selected').text());
          return regex.test(content.text());
        }

        brandSelect = $('#brand-select');
        ramSelect = $('#ram-select');          
        brandRegex = selectorFilter(brandSelect);
        ramRegex = selectorFilter(ramSelect);  
        if (brandSelect.val() == null || brandSelect.val() == '') {
          brandRegex = true;
        }
        if (ramSelect.val() == null || ramSelect.val() == '') {
          ramRegex = true;
        }    
        
        price = parseInt(content.find('.content-price').text());
        minPrice = parseInt($("#min_price").val());
        maxPrice = parseInt($("#max_price").val());
        priceRange = price >= minPrice && price <= maxPrice; 
        
        // if (price >= minPrice && price <= maxPrice) {
          //   priceRange = true;
          // } 
          
          return brandRegex && ramRegex && priceRange;
        }
        
        function clearFilter()
        {
          $('.filterText').val('');
          $('.content').show();
        }
        
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
      @endsection