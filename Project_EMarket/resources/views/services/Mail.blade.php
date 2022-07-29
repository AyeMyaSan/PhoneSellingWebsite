
<h1><strong>Dear {{$orderDetail->first()->user_name}}</strong></h1>
<h4>Thank You For Your Order</h4>
<table class="table table-border" style="font-size:14px;font-family:open sans;font-weight:bold;width:500px;">
    <thead style="background-color:#efefef;">
      <tr>
        <th>Product Detail</th>
      </tr>
    </thead>     
    <tbody>
      @foreach($orderDetail as $key=>$value)
      <?php
          $images = $value->image;
          $image = explode(',',$images);
          $first_img = $image[0]; 
          ?>
      <tr>
        <td><span><img src="{{asset('images/'.$first_img)}}" width="50" height="50"/>{{$value->model}}</span></td>
      </tr>
      <tr>
          <td><span>Color :</span></td>
          <td><span></span><span>{{$value->color}}</span></td>
        </tr>
      <tr>
        <td><span>Unit Price :</span></td>
        <td><span></span><span>{{$value->price}}</span></td>
      </tr>
      <tr>
          <td><span>RAM :</span></td>
          <td><span></span><span>{{$value->ram}}</span></td>
        </tr>
      <tr>
          <td><span>Memory</span></td>
          <td><span></span><span>{{$value->memory}}</span></td>
      </tr>
      @endforeach
      <tr>
        <td class="text-right">            
          <strong>Order Date:</strong><br><br>
          <strong>Quantity:</strong>
        </td>
        <td>
          <strong> {{$orderDetail->first()->created_at}}</strong> <br><br>
          <strong>{{$orderDetail->first()->total_quantity}}</strong>        
        </td>
      </tr> 
      <tr>
        <td class="text-right"><h2><strong>Total: </strong></h2></td>
        <td class="text-left text-primary"><strong>{{$orderDetail->first()->total_price}}</strong></h2></td>
      </tr>     
    </tbody> 
  </table>