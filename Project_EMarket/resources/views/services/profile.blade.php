@extends('home')
@section('content')
<div class="container">
  <div class="col-md-12 ">
    <h1 style="font-weight:bold;font-size:24px;">User Profile</h1>
    <div class="row" style="margin:0%">
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <img  class="img-profile rounded-circle" src="{{asset('images/profile1.jpg')}}" style="width:150px;margin-left:25%;margin-top:10%" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="margin-left:30%">{{auth()->user()->name}}</h5>
            <p class="card-text"  style="margin-left:35%">linked</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">William Shakespeare was an English poet, playwright and actor</li>                  
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">My Order</a>
            <a href="#" class="card-link">My Wishlist</a>
          </div>
        </div>              
      </div>
      <div class="col-md-8 col-sm-6">
        {!!Form::open(['route'=>['saveChange'],'method'=>'post'])!!}
        {!!Form::hidden('hiddenuserid',auth()->user()->id) !!}
        <div class="card" style="margin-bottom:5px;">
          <div class="card-header">
            <h1 style="font-size:18px;font-weight:bold;">Account Details</h1>
          </div>
          <div class="card-body">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::label('user_name','Name:')!!}
                {!! Form::text('name',auth()->user()->name,['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('user_email', 'Email:')!!}
                {!! Form::text('email',auth()->user()->email,['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', 'New Password:')!!}
                {!! Form::password('password',['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('password')}}</span>
              </div>
              <div class="form-group">
                {!! Form::label('confirm_password', 'Confirm New Password:')!!}
                {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
              </div>
            </div>
            <div class="crad-footer" style="margin-left:35%">
              {!!Form::submit('Save Change', ['class' => 'btn btn-primary']) !!}
            </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@endsection