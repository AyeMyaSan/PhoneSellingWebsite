@extends('layouts.app')
@section('content')
<div class="container" >
    {!!Form::open(['route'=>'continue','method'=>'get', 'class' => 'd-inline'])!!}
  <div class="jumbotron text-xs-center" >
    <h1 class="display-3">Thank You!</h1>
    <p class="lead" style="margin-left:30px;"><strong>We Will Contact You Within 24 Hours.</strong> </p>
  </div> 
     
  <div style="width:600px;margin-left:10px;"> 
    <p  style="margin-top:18px;color:black;font-size:18px;font-weight:bold;">{!! Form::label('user_name',auth()->user()->name) !!}</p>       
    <span style="color:gray;"> Email:</span><span style="color:black;">    {!! Form::label('user_name',auth()->user()->email)!!}</span><br>       
    
      <table class="table table-bordered" style="font-size:16px;font-family:open sans;font-weight:300;width:900px;">
        <thead style="background-color:#efefef;">
          <tr>
            <th>Product </th>
            <th>Price</th>
          </tr>
        </thead>     
        <tbody>
            <?php 
            $subtotal = 0;
            $total = 0;
            $quantity=0;
            ?>
          @foreach(session('cart') as $id => $details)
          <?php 
          $subtotal =(int) $details['price'] * $details['quantity'];
          $total += $subtotal;
          $quantity +=(int)$details['quantity']
          ?>
          <tr>
            <td><span><img src="{{asset('images/'.$details['image'])}}" width="50" height="50"/>{{ $details['model'] }}({{ $details['color'] }})</span></td>
            <td><span></span><br><span>{{ $details['price'] }}&nbsp;&nbsp;<strong>x</strong>&nbsp;&nbsp;{{$details['quantity']}}&nbsp;&nbsp;<strong>=</strong>{{ $details['price'] *$details['quantity']}}</span></td>
          </tr>
          @endforeach
          <tr style="font-size:20px;font-family:open sans;font-weight:600;">
            <td class="text-right">            
              <strong>Total Quantity:</strong>
            </td>
            <td>
              <strong>{{$quantity }}</strong>        
            </td>
          </tr> 
          <tr>
            <td class="text-right"><h2 style="font-size:30px;font-family:open sans;color: #9f181c;"><strong>Total Price : </strong></h2></td>
            <td class="text-left text-danger"><h2 style="font-size:30px;font-family:open sans;color: #9f181c;"><strong>{{$total}}MMK</strong></h2></td>
          </tr>     
        </tbody> 
      </table>  
    </div>
    {!! Form::submit('Continue to homepage', ['class' => 'btn btn-primary btn-sm']) !!}
    {!!Form::close()!!}
</div>
@endsection

