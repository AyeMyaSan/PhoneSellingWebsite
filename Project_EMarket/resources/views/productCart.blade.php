@extends('layouts.app')
@section('content')
<div class="container">
    @php
    $count = null;
       if(session('cart')){
         $count = 0;
         foreach(session('cart') as $item)
          {
            $count += $item['quantity'];
          }

       } 
    @endphp
  @if($count < 1) <div class="text-center pt-4" style="padding-top:150px;"><i class="fas fa-exclamation-triangle text-center fa-3x"></i>
  
  <h3 class="text-center pt-2 warning" style="padding:160px;">No Cart Items have been found!</h3></div>
  @else
   {!!Form::open(['route'=>'showUserForm','method'=>'post', 'class' => 'd-inline'])!!}  
  
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
              <th style="width:40%">Product</th>
              <th style="width:10%">UnitPrice</th>
              <th style="width:10%">Color</th>
              <th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%">Action</th>
						</tr>
					</thead>
					<tbody>
              <?php $total = 0 ?>
              @if(session('cart'))
            
           @foreach(session('cart') as $key => $details)
      
           <?php $total +=(int) $details['price'] * $details['quantity'] ?>
						<tr class="product">
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><img src="{{asset('images/'.$details['image'])}}" width="100" height="100"
                    class="img-responsive" /></div>
									<div class="col-sm-9">
										<h4 class="nomargin">{{ $details['model'] }}</h4>
									</div>
								</div>
							</td>
              <td data-th="Price" class="product-price">
                {{ $details['price'] }}Ks
              </td>
              <?php

             
              ?>
              <td data-th="color">{{$details['color']}}</td>
							<td data-th="Quantity" class="product-quantity">
                  {!! Form::hidden("product[{$key}][id]",$details['id'],['class' => 'form-control quantity','min'=>'1'])!!}
                  {!! Form::hidden("product[{$key}][color]",$details['color'],['class' => 'form-control quantity','min'=>'1'])!!}
                  {!! Form::number("product[{$key}][quantity]",$details['quantity'],['class' => 'form-control quantity','min'=>'1'])!!}
                  {!! Form::hidden("product[{$key}][price]",$details['price'],['class' => 'form-control quantity','min'=>'1'])!!}
              </td>
              <td data-th="Subtotal" class="product-line-price text-center">{{(int) $details['price'] * $details['quantity'] }}Ks</td>
              <td class="actions" data-th="">
                <button class="btn btn-danger btn-sm remove-from-cart" name="btn_edit_post" value="{{$key}}" ><i class="far fa-trash-alt"></i></button>
              
            </td>
            </tr>
            @endforeach
            @endif
          </tbody>
          
					<tfoot>
            <tr>
              <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
              <td colspan="3" class="hidden-xs">Total</td>
              <td class="totals-value hidden-xs text-center" id="cart-subtotal"><strong>{{ $total }}Ks</strong></td>
              
            </tr>
						
          </tfoot>
          
        </table>
        <div style="margin-left:40%;">
          {!! Form::submit('CheckOut', ['class' => 'btn btn-lg btn-primary', 'name' => "btn_edit_post" ]) !!}
          {!!Form::close()!!}
        </div>
        @endif
</div>
<script src="{{asset('js/Qty.js')}}"></script>
@endsection