@extends('layouts.app')
@section('content')
<div class="container">
  {!!Form::open(['route'=>'checkout', 'method'=>'post'])!!}
  <div class="col-md-12 ">
    <div class="row" style="margin:0%">
      <div class="col-md-7 col-sm-6">
        <div class="card" style="margin-bottom:5px;">
          <div class="card-header">
            <h1 style="font-size:18px;font-weight:bold;">Billing Address</h1>
          </div>
          <div class="card-body">

            <div class="col-md-12">
              <div class="form-group">

                {!! Form::label('user_name','Name:')!!}
                {!! Form::text('user_name',auth()->user()->name,['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('user_email', 'Email:')!!}
                {!! Form::text('user_email',auth()->user()->email,['class' => 'form-control','readonly'=>'true']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('phone_no', 'Phone No.:')!!}
                {!! Form::text('phone_no','',['class' => 'form-control' ,'placeholder'=>'your phone no.' ]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('user_address', 'Address:')!!}
                {!! Form::textarea('user_address','',['class' => 'form-control' ,'rows' => 4,'placeholder'=>'your address' ]) !!}
              </div>
            </div>
            <div class="crad-footer" style="margin-left:35%">
              {!!Form::submit('CheckOut', ['class' => 'btn btn-primary']) !!}
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-5 col-sm-6">
        <div class="card" style="margin-bottom:5px;">
          <div class="card-header">
            <h1 style="font-size:18px;font-weight:bold;">Your Items</h1>
          </div>
          <div class="card-body">
            <div class="col-md-12">

              <div class="table-responsive table--no-card m-b-40">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Product</td>
                      <td>Color</td>
                      <td>Quantity</td>
                      <td>Price</td>
                    </tr>
                    <?php 
                    $subtotal = 0;
                    $total = 0;
                    ?>
                    @foreach(session('cart') as $id => $details)

                    <?php 
                    $subtotal =(int) $details['price'] * $details['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                      <td>{{ $details['model'] }}<br>
                        <img src="{{asset('images/'.$details['image'])}}" alt="order image"
                          style="width:60px;height:70px;">
                      </td>
                      <td>{{$details['color']}}</td>
                      <td>{{ $details['quantity'] }}</td>
                      <td>{{ $subtotal }}MMK</td>
                    </tr>
                    {!! Form::hidden("product[{$id}][p_id]",$details['id'],['class' => 'form-control
                    quantity','min'=>'1'])!!}
                    {!! Form::hidden("product[{$id}][color]",$details['color'])!!}
                    {!! Form::hidden("product[{$id}][quantity]",$details['quantity'],['class' => 'form-control
                    quantity','min'=>'1'])!!}
                    {!! Form::hidden("product[{$id}][price]",$details['price'])!!}
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3">Total Price</td>
                      <td>{{$total}}MMK</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{!!Form::close()!!}
</div>
@endsection