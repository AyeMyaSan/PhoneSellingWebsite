
@extends('home')
@section('content')
<div class="container">
  <div class="col-md-12 ">
    <div class="col-md-8 col-sm-6">
      <div class="card" style="margin-bottom:5px;">
        <div class="card-header">
          <h1 style="font-size:18px;font-weight:bold;">Edit UserInfo:</h1>
        </div>
        <div class="card-body">
          {!!Form::open(['route'=>'userUpdate','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
              {!!Form::hidden('hiddenuserid', !empty($userInfo->id) ? $userInfo->id : '') !!}
          <div class="col-md-12">
            <div class="form-group">
              {!!Form::label('role','User Role:')!!}
              {!!Form::select('role',['1' => 'Admin', '2' => 'Customer'], null, ["class" => "form-control" ])!!}
            </div>
            <div class="form-group">
              {!! Form::label('user_name','Name:')!!}
              {!! Form::text('name',!empty($userInfo->name) ? $userInfo->name :'',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email:')!!}
              {!! Form::text('email',!empty($userInfo->email) ? $userInfo->email :'',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('email')}}</span>
            </div>
            <div class="form-group">
              {!! Form::label('password', 'New Password:')!!}
              {!! Form::password('password',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('password')}}</span>
            </div>
            <div class="form-group">
              {!! Form::label('confirm_password', 'Confirm Password:')!!}
              {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
              <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
            </div>
          </div>
          <div class="crad-footer">
            <div style="float:left;margin-left:20%;">
              {!!Form::submit('Update', ['class' => 'btn btn-success']) !!}
              {!!Form::close()!!}
              
            </div>
            <div  style="margin-left:65%">
              {!!Form::open(['route'=>['customerDelete',$userInfo->id],'method'=>'get'])!!}
              {!!Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!!Form::close()!!}
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection