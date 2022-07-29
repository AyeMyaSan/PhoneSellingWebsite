@extends('cusIndex')
@section('cc')
  <div style="width:600px;margin-left:10px;"> 
    <h2 style="margin-top:18px;color:black;">{!! Form::label('user_name',auth()->user()->name) !!}</h2>       
    <span style="color:gray;"> Email:</span><span style="color:black;">    {!! Form::label('user_name',auth()->user()->email)!!}</span><br>       
    <span style="color:gray;">Phone NO.:</span><span style="color:black;"> {{$orderInfo->first()->phoneNo}}</span><br>
    <span style="color:gray;">Address:</span><span style="color:black;">  {{$orderInfo->first()->address}}</span></p>
      <table class="table table-bordered" style="font-size:16px;font-family:open sans;font-weight:300;width:900px;">
        <thead style="background-color:#efefef;">
          <tr>
            <th>Product </th>
            <th>Price</th>
          </tr>
        </thead>     
        <tbody>
          @foreach($orderInfo as $key=>$value)
          <tr>
            <td><span><img src="{{asset('images/'.$value->image)}}" width="50" height="50"/>{{$value->model}}({{$value->color}})</span></td>
            <td><span></span><span>{{$value->price}}</span></td>
          </tr>
          @endforeach
          <tr style="font-size:20px;font-family:open sans;font-weight:600;">
            <td class="text-right">            
              <strong>Order Date:</strong><br><br>
              <strong>Quantity:</strong>
            </td>
            <td>
              <strong> {{$orderInfo->first()->created_at}}</strong> <br><br>
              <strong>{{$orderInfo->first()->total_quantity}}</strong>        
            </td>
          </tr> 
          <tr>
            <td class="text-right"><h2 style="font-size:30px;font-family:open sans;color: #9f181c;"><strong>Total: </strong></h2></td>
            <td class="text-left text-danger"><h2 style="font-size:30px;font-family:open sans;color: #9f181c;"><strong>{{$orderInfo->first()->total_price}}</strong></h2></td>
          </tr>     
        </tbody> 
      </table>  
    </div>
  @endsection