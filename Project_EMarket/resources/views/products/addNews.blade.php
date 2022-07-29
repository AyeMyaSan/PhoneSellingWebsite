@extends('home')
@section('content')
<div class="content">
  <div class="container">
    <span>
      <h2 style="font-weight: bold;color:black;">Add NEWS</h2>
    </span>
    <form action="{{ route('newsAdd') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="row" style="border-bottom:1px solid #dfe3e8;">
        <div class="col-lg-7 col-md-8 col-sm-7 col-xs-12">
          <div class="box" style="color:black;">
            <div class="md-form form-sm">
              {!! Form::text('news_title','',['class' => 'form-control']) !!}
              {!! Form::label('news_title')!!}
              <span class="text-danger">{{$errors->first('news_title')}}</span>
            </div>

            <div class="md-form form-sm">
              {!! Form::textarea('news_detail','',['class' => 'md-textarea form-control','rows' => 5, 'id'=>'edit']) !!}
              <span class="text-danger">{{$errors->first('news_detail')}}</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
          <div class="card bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header bg-white" style="color:black;">Product Type</div>
            <div class="card-body">
                <div class="md-form">
                    {!! Form::select('news_category', ['s' => 'Smart Phone', 't' => 'Tablet', 'l' => 'Laptop/PC'],'s', ['class'=>"mdb-select"]) !!}
                    {!! Form::label('news_category', 'Category')!!}
                  </div>
            </div>
          </div>

          <div class="card bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header bg-white" style="color:black;">Visibility</div>
            <div class="card-body">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultChecked" name="visibility" value="true" checked>
                <label class="custom-control-label" for="defaultChecked" style="font-size:14px;color:black;">Visible In Shop</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultUnchecked" name="visibility" value="false">
                <label class="custom-control-label" for="defaultUnchecked" style="font-size:14px;color:black;">Hidden From Shop</label>
              </div>     
            </div>
          </div>
          <div class="card bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header bg-white" style="color:black;">Features Image</div>
            <div class="card-body">
                <div>
                    <img id="img" src=" " style="width:100px;height:200px;width:200px;margin-top:30px;margin-left:10%;margin-bottom:10px;display:none;" />
                    <i id="iconimg" class="	far fa-images fa-6x" style="color:grey;margin-top:50px;margin-left:30%;"></i>
                    <div class="md-form file-field">
                      <a class="btn-floating purple-gradient mt-0 float-left">
                        <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                        <input type="file" id="image" name="news_image" onchange='readURL(this);'>
                      </a>
                      <div class="file-path-wrapper">
                        {!! Form::text('news_image','Upload image',['class' => 'file-path validate']) !!}
                      </div>
                    </div>
                  </div>
            </div>
          </div>


        </div>
      </div>
      <div class="form-group" style="margin-top:10px;float:left;">
        {!! Form::submit('Save', ['class' => 'btn btn-lg btn-primary','id'=>'save']) !!}
        {!! Form::close()!!}
      </div>

  </div>
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>


<script>
  // Material Select Initialization
  
$(document).ready(function() {

  $('.mdb-select').formSelect();
  // jQuery('textarea').richText();
  var editor = $("#edit").Editor();
  
 
  $('#save').click(function() 
  {
   //get text in div and assign to textarea
  //  var str = $( '#editor2 .Editor-editor' ).text();
    var str = $("#edit").Editor("getText");
    var txt = $("#edit").Editor("getText2");
   $('#edit').val(str);
   $('#txt').val(txt);
  });


});
</script>