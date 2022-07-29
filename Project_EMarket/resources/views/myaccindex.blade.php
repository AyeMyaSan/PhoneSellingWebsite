@extends('cusIndex')
@section('cc')

<div id="app" style="width:900px;margin-top:37px;">
   
  <div class="newsform" style="width:100%;">
    <div class="container" >
      <span>
        <h2 style="font-weight: bold;">Edit Profile</h2>
      </span>
      
      @csrf
      {!!Form::open(['route'=>'profileUpdate', 'method'=>'post'])!!}
      <div class="row" >       
      <div class="col-md-8">
        <div class="form-group">
          {!!Form::label('name','Name')!!}
          {!! Form::text('name', !empty($user_info->name)? $user_info->name :'', ['class' => 'form-control']) !!}
          <span class="error-color">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group">
          {!! Form::label('user_email', 'Email:')!!}
          {!! Form::text('email',auth()->user()->email,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!!Form::label('password','New Password')!!}
          {!! Form::password('password', ['class' => 'form-control']) !!}
          <span class="error-color">{{$errors->first('password')}}</span>
              </div>
        <div class="form-group">
          {!!Form::label('password_confirmation','Confirm Password')!!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            
          {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
          {!!Form::close()!!}
        </div>
       
      </div>
    
    </div>
 
  </div>
</div>

</div>

@endsection


