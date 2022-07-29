@extends('layouts.app')
@section('content')
<section class="mbr-section content4 cid-qvXDlTpHu4" id="content4-l" data-rv-view="670" style="background-color: #efefef;margin-bottom:20px;h;eight:86px">
  <div class="container">
    <div class="media-container-row">
     <h1 style="padding-top:10px;margin-bottom:10px;margin-left:50%;">
        News</h1>                    
       </div>
    </div>
  </section>
  <div class="row flex" style="display:flex; align:center;">
    <div style="margin-top:50px;margin-left:30%;">
      @if(count($newsInfo) < 1) <div class="text-center pt-4"><i class="fas fa-exclamation-triangle fa-3x"></i>
    </div>
    <h3 class="text-center pt-2 warning">No News have been found!</h3>
    @endif
  </div>
  <div class='container'>
    @foreach($newsInfo as $key=>$value)
  <div class="inner">
    <div class="header clearFix">
      <div class="logo"><a href="{{route('showNewsDetail',$value->id)}}"><img src="{{asset('images/'.$value->news_image)}}" class="card-img-top"/></a></div>
      <div class="tagline">
        <h1 style="font-size:28px;"><a href="{{route('showNewsDetail',$value->id)}}" style="text-decoration: none;">{{$value->news_title}}</a></h1>
        
        {!!Form::open(['route'=>['showNewsDetail',$value->id],'method'=>'get'])!!}
              
        {!! Form::submit('View Detail', ['class' => 'btn btn-outline-primary']) !!}
        {!!Form::close()!!}
      </div>
    </div>
  </div>
 @endforeach  
</div>
@endsection
