@extends('home')
@section('content')    
<div class="content">
  <div class="container">
    <?php
    $status= array("0","1","2");
    ?>
    {{-- {{dd($orderInfo)}} --}}
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
        <div class="box">
          <div class="plan-selection" >
            <div class="plan-data">
              <h3 class="box-order">Ordered ID : {{$orderInfo->first()->id}}</h3>
              <h3 class="box-order">Order date : {{$orderInfo->first()->created_at}}</h3>
              <h3 class="box-order">Status :
                @if($orderInfo->first()->status ==0)
                Pending
                @elseif($orderInfo->first()->status ==1)
                Confirm
                @else
                Deliver
                @endif
              </h3>
            </div>
          </div>
          <h3 class="box-title">Ordered Items</h3>
          @foreach($orderInfo as $key=>$value)
          {{-- {{dd($orderInfo)}} --}}
          <?php
          $images = $value->image;
          $image = explode(',',$images);
          $first_img = $image[0]; 
          // dd($image);
          ?>
          <div class="plan-selection">
            <div class="plan-data">
              <label for="question1">
                {{$value->model}}
              </label><br>
              <p class="plan-text">
                RAM :{{$value->ram}}
                | Memory : {{$value->memory}}
                | Color :{{$value->color}}
              </p>
              <img src=" {{ asset('images/'.$first_img)}}"  alt="" style="width:60px;height:70px;"><br><br>
              <span class="plan-price"> Unit Price : {{$value->price}}</span>         
              <span class="plan-qty"> Quantity : {{$value->quantity}}</span>
            </div>
          </div>
          @endforeach  
        </div>
        <div style="margin-left:40%;margin-button:10px;">
          {!!Form::open(['route'=>'order','method'=>'get'])!!}  
          {!! Form::submit('View All Orders', ['class' => 'btn btn-success']) !!}
          {!! Form::close() !!}
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
        <div class="widget">
          <h4 class="widget-title">Customer Details</h4>
          <div class="summary-block">
            <div class="summary-content">
              <div class="summary-head"> <h5 class="summary-title">Name</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->user_name}}</p>
              </div>
              <div class="summary-head" > <h5 class="summary-title">Email</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->email}}</p>
              </div>
            </div>
          </div>
          <div class="summary-block">
            <div class="summary-content">
              <div class="summary-head"> <h5 class="summary-title">Phone No.</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->phoneNo}}</p>
              </div>
              <div class="summary-head"> <h5 class="summary-title">Address</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->address}}</p>
              </div>
            </div>
          </div>
          <div class="summary-block">
            <div class="summary-content">
              <div class="summary-head"><h5 class="summary-title">Total Qty.</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->total_quantity}}</p>
              </div>
              <div class="summary-head"><h5 class="summary-title">Total Price</h5></div>
              <div class="summary-price">
                <p class="summary-text">{{$orderInfo->first()->total_price}}</p>
              </div>
            </div>
          </div>
          <div class="summary-block">
            <div class="summary-content">
              <div class="summary-head">  
                @if($value->status==0)
                {!!Form::open(['route'=>'updateStatus','method'=>'post'])!!}
                {!!Form::hidden('hiddenorderid',$value->id)!!}
                {!!Form::hidden('email',auth()->user()->email) !!}
                {!!Form::hidden('status','1') !!}
                {!! Form::submit('Confirm', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                @elseif($value->status==1)
                {!!Form::open(['route'=>'updateStatus','method'=>'post'])!!}
                {!!Form::hidden('hiddenorderid',$value->id)!!}
                {!!Form::hidden('status','2') !!}
                {!! Form::submit('Deliver', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                @elseif($value->status==2)
                {!! Form::submit('Deliver', ['class' => 'btn btn-success']) !!}
                @endif
              </div>
              <div class="summary-price">
                {!!Form::open(['route'=>['orderDelete',$orderInfo->first()->id],'method'=>'get'])!!}  
                {!! Form::submit('Remove', ['class' => 'btn btn-danger','onclick' => "return confirm('Are you sure to delete this post?')"]) !!}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
