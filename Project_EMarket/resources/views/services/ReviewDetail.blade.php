@extends('home')
@section('content')
<div class="container pr-5 pl-5">
  <h4 class="pl-5">Review Details</h4>
  <div class="col-lg-12">
    <div class="card bg-white mb-3" style="max-width: 70rem;">
      <div class="card-header bg-white" style="color:black;">
        <span style="float:left;">{{ $reviewInfo->first()->name }}</span>
      <span style="float:right;">
         @foreach ($reviewInfo as $key=>$values)
        <?php
        $rating =  $values->rev_rating ;
        ?>
        @for($i=0;$i<$rating;$i++)
            <i class="text-warning fa fa-star"></i>   
          @endfor
          @endforeach</span>
      </div>
      <div class="card-body">
        <div class="row">
          <?php
          $status= array("0","1");
          ?> 
        <div class="col-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Review Id</th>
                <th>Product Model</th>
                <th>Product Image</th>
                <th>Review Title</th>
                <th>Review Content</th>
                <th>Status</th>                
              </tr>
            </thead> 
            <tbody>
              <tr>
                <th scope="row">{{ $reviewInfo->first()['id']}}</th>
                <td>
                  {{ $reviewInfo->first()['model'] }}<br><br>
                </td>
                <td>
                  <img src="{{asset('images/'.$reviewInfo->first()['image'])}}" class="card-img-detail" alt="" style="width:50px; height:27px;"><br><br>
                </td>
                <td>
                  {{ $reviewInfo->first()['rev_title'] }}<br><br>
                </td>
                <td>
                  {{ $reviewInfo->first()['rev_msg'] }}<br><br>
                </td>
                @if ($reviewInfo->first()->status == 0) 
                <td style="color:red;">Pending</td>
                @elseif ($reviewInfo->first()->status == 1) 
                <td style="color:darkgreen;">Confirmed</td>
                @elseif ($reviewInfo->first()->status == 2) 
                <td style="color:blue;">Delivered</td>
                @endif
              </tr>
            </tbody>
          </table>
          <div class="row" style="padding-left:530px;">
              <div style="margin-right:10px;">
                @if($reviewInfo->first()->status==0)
                {!!Form::open(['route'=>['updateRStatus',$reviewInfo->first()->id,$status[1]],'method'=>'post'])!!}
                {!! Form::submit('Confirm', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                @elseif($reviewInfo->first()->status==1)
                {!! Form::submit('Posted', ['class' => 'btn btn-success']) !!}
                @endif
              </div>
              <div>
              @csrf
              {!!Form::open(['route'=>['reviewDel',$reviewInfo->first()->id],'method'=>'get'])!!}  
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