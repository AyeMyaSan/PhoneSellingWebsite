
@extends('home')
@section('content')
<div class="container">
  <div class="col-md-12 ">
    <div class="col-md-8 col-sm-6">
      <div class="card" style="margin-bottom:5px;">
        <div class="card-header">
          <h1 style="font-size:18px;font-weight:bold;">Adding User</h1>
        </div>
        <div class="card-body">
            {!!Form::open(['route'=>'addNewUser','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
          <div class="col-md-12">
            <div class="form-group">
              {!!Form::label('role','User Role:')!!}
              {!!Form::select('role',['1' => 'Admin', '2' => 'Customer'], null, ["class" => "form-control" ])!!}
            </div>
            <div class="form-group">
              {!! Form::label('user_name','Name:')!!}
              {!! Form::text('name','',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email:')!!}
              {!! Form::text('email','',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('email')}}</span>
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
          <div class="crad-footer">
            <div style="float:left;margin-left:47%;">
              {!!Form::submit('Add', ['class' => 'btn btn-success']) !!}
            </div>
            
          </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection