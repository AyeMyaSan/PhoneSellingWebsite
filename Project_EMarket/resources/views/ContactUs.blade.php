@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
  crossorigin="anonymous">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' 
  integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' 
  crossorigin='anonymous'>   
 </head>
<body>
  <div class="container">
    <section class="my-5">
      
      <h2 class="h1-responsive font-weight-bold text-center my-5">Contact us</h2>
      
      <div class="row">
        
        <div class="col-lg-5 mb-lg-0 mb-4">
          
          <div class="card">
            {!!Form::open(['route'=>'contact','method'=>'post'])!!}
            
            <div class="card-body">
              <div class="form-header blue accent-1">
                <h3 class="mt-2"><i class="fas fa-envelope"></i> Write to us:</h3>
              </div>
              <p class="dark-grey-text">We'll write rarely, but only the best content.</p>
              <div class="form-group">
                {!! Form::label('name', 'Name:')!!}
                {!! Form::text('name',auth()->user()->name,['class' => 'form-control' ,'placeholder'=>'Your Name:' ]) !!}
                <span class="text-danger">{{$errors->first('name')}}</span>
              </div>
              <div class="form-group">
                {!! Form::label('email', 'Email:')!!}
                {!! Form::text('email',auth()->user()->email,['class' => 'form-control' ,'placeholder'=>'Your Email' ]) !!}
                <span class="text-danger">{{$errors->first('email')}}</span>
              </div>
              
              <div class="form-group">
                {!! Form::label('subject', 'Subject:')!!}
                {!! Form::text('subject','',['class' => 'form-control' ,'placeholder'=>'Subject' ]) !!}
                <span class="text-danger">{{$errors->first('subject')}}</span>
              </div>
              <div class="form-group">
                {!! Form::label('message', 'Send Message:')!!}
                {!! Form::textarea('message','',['class' => 'form-control','rows' => 3 ,'placeholder'=>'' ]) !!}
                <span class="text-danger">{{$errors->first('message')}}</span>
              </div>
              <div>
                @if(!empty(session('success_msg')))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success_msg')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
              </div>
              <div class="text-center">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
              </div>
          </div>
         </div>
        <div class="col-lg-7">
          <div id="map-container-section" class="z-depth-1-half map-container-section mb-4">
            <iframe src="https://maps.google.com/maps?q=Seattle+consulting&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
          </div>
          <div class="row text-center">
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-map-marker-alt"></i>
              </a>
              <p>Myanmar, Yangon</p>
              <p class="mb-md-0">CGM Co.,Ltd</p>
            </div>
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-phone"></i>
              </a>
              <p>+95 9258456860</p>
              <p class="mb-md-0">Mon - Fri, 8:00-17:00</p>
            </div>
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-envelope"></i>
              </a>
              <p>info@gmail.com</p>
              <p class="mb-0">sale@gmail.com</p>
            </div>
          </div>
          
        </div>
        
      </div>
      
    </section>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </div>
</body>
</html>
@endsection
