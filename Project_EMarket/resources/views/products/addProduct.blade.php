@extends('home')
@section('content')
<div class="content">
  <div class="container">
    <span>
      <h2 style="font-weight: bold;color:black;">Add Product</h2>
    </span>
    {!!Form::open(['route'=>'addProduct','method'=>'post', 'enctype'=>'multipart/form-data'])!!}

    <div class="row" style="border-bottom:1px solid #dfe3e8;">
      <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
        <div class="box" style="color:black;">
          <div class="md-form form-sm">
            {!! Form::text('model','',['class' => 'form-control']) !!}
            {!! Form::label('model')!!}
            <span class="text-danger">{{$errors->first('model')}}</span>
          </div>

          <div class="md-form form-sm">
            {!! Form::textarea('feactures','',['class' => 'md-textarea form-control','rows' => 5, 'id'=>'edit']) !!}
            <span class="text-danger">{{$errors->first('feactures')}}</span>
          </div>
        </div>

        <div class="box">
          <span>
            <h6 style="font-weight: bold;color:black;">Specificaton of Product<i class="fal fa-salad"></i></h6>
          </span>

          <div class="row">
            <div class="col-sm-6">
              <div class="md-form form-sm"> {!! Form::text('screensize','',['class' => 'form-control']) !!}
                {!! Form::label('screensize')!!}
                <span class="text-danger">{{$errors->first('screensize')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('cpu','',['class' => 'form-control']) !!}
                {!! Form::label('cpu')!!}
                <span class="text-danger">{{$errors->first('cpu')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('os','',['class' => 'form-control']) !!}
                {!! Form::label('os')!!}
                <span class="text-danger">{{$errors->first('os')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('memory','',['class' => 'form-control']) !!}
                {!! Form::label('memory')!!}
                <span class="text-danger">{{$errors->first('memory')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('camera','',['class' => 'form-control']) !!}
                {!! Form::label('camera')!!}
                <span class="text-danger">{{$errors->first('camera')}}</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="md-form form-sm"> {!! Form::text('resolution','',['class' => 'form-control']) !!}
                {!! Form::label('resolution')!!}
                <span class="text-danger">{{$errors->first('resolution')}}</span>
              </div>


              <div class="md-form form-sm"> {!! Form::text('gpu','',['class' => 'form-control']) !!}
                {!! Form::label('gpu')!!}
                <span class="text-danger">{{$errors->first('gpu')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('ram','',['class' => 'form-control']) !!}
                {!! Form::label('ram')!!}
                <span class="text-danger">{{$errors->first('ram')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('battery','',['class' => 'form-control']) !!}
                {!! Form::label('battery')!!}
                <span class="text-danger">{{$errors->first('battery')}}</span>
              </div>
              <div class="md-form form-sm"> {!! Form::text('price','',['class' => 'form-control']) !!}
                {!! Form::label('price')!!}
                <span class="text-danger">{{$errors->first('price')}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
        <div class="card bg-white mb-3" style="max-width: 22rem;">
          <div class="card-header bg-white" style="color:black;">Product Type</div>
          <div class="card-body">


            <div class="md-form">
              {!! Form::select('category', ['s' => 'Smart Phone', 't' => 'Tablet', 'l' => 'Laptop/PC'],'s', ['class'
              =>
              "mdb-select"]) !!}
              {!! Form::label('category', 'Category')!!}
            </div>

            <div class="md-form form-sm">
              {!! Form::text('brand','',['class' => 'form-control']) !!}
              {!! Form::label('brand')!!}
              <span class="text-danger">{{$errors->first('brand')}}</span>
            </div>
          </div>
        </div>

        <div class="card bg-white mb-3" style="max-width: 22rem;">
          <div class="card-header bg-white" style="color:black;">Colors</div>
          <div class="card-body">
            {!! Form::text('color','',['class' => 'form-control']) !!}
            <span class="text-danger">{{$errors->first('color')}}</span>
          </div>
        </div>

        <div class="card bg-white mb-3" style="max-width: 22rem;">
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

        <div class="box bg-white mb-3" style="color:black; max-width: 22rem;">
            <div>
              <span>
                <h6 style="font-weight: bold;color:black;float:left;">Image <i class="fal fa-salad"></i></h6>
              </span>
  
              <h6 style="color:gray;float:right;">Your Product's Image</h6>
  
            </div>
            <div>
                <div class="gallery"></div>
                {{-- <img src="" id="display" style="width:100px;height:200px;width:200px;margin-top:30px;margin-left:10%;margin-bottom:10px;display:none;" /> --}}
              <i id="iconimg" class="	far fa-images fa-6x" style="color:grey;margin-top:50px;margin-left:30%;"></i>
              <div class="md-form file-field">
                <a class="btn-floating purple-gradient mt-0 float-left">
                  <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                  <input type="file" id="image[]" name="image[]" multiple >
                </a>
                <div class="file-path-wrapper">
                  {!! Form::text('image','Upload one or more image',['class' => 'file-path validate','id'=>'img']) !!}
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>
    <div class="form-group" style="margin-top:10px;float:left;">

      {!! Form::submit('Save', ['class' => 'btn btn-sm aqua-gradient','id'=>'save']) !!}
      {!!Form::close()!!}
    </div>

  </div>
</div>
 
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>

<script>
$(document).ready(function() {
  $('.mdb-select').formSelect();
  $('input[name="color"]').amsifySuggestags();
  var editor = $("#edit").Editor();

  $('#save').click(function() 
  {
    var str = $("#edit").Editor("getText");
   $('#edit').val(str);
  });

});
</script>
<script>
    $(document).ready(function() {
      $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            $('#iconimg').toggle();
            
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).attr('style', "margin-bottom:5px;border-width:2px;border-style:solid;border-color:pink;");
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('input[type="file"]').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
    });

</script>
{{-- <script>
  $(document).ready(function() {
    $('input[type="file"]').on('change',function(){
      $("[id=img]").html(this.files[0].name);


      var img = $('input[name="image"]').val();
      var images = img.split(', ');
      console.log(images);
      $.each(images, function(index, value){
        console.log(value);
        var link = "http://localhost:8001/images/";
        var src = link+value;
        alert(src);
        console.log(src);
        $("#display").attr("src", src);
      });
     });
});
  </script> --}}
