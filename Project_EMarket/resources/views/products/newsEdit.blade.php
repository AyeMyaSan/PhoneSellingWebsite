@extends('home')
@section('content')
<div id="app">
  <div class="newsform">
    <div class="container">
      <span>
        <h2 style="font-weight: bold;">Edit Blog</h2>
      </span>
      <form action="{{ route('newsUpdate') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row" style="border-bottom:1px solid #dfe3e8;">
        <div class="col-lg-7 col-md-8 col-sm-7 col-xs-12">
          <div class="box" style="color:black;">
            <div class="md-form form-sm">       
              {!! Form::text('news_title', !empty($newsInfo->news_title) ? $newsInfo->news_title : '', ['class' => 'form-control', 'placeholder'=>'news title',]) !!}
              <span class="text-danger">{{$errors->first('new_title')}}</span>
              
            </div>
            
            <div class="md-form form-sm">              
              {!! Form::textarea('news_detail','', ['class' => 'form-control','rows' => 4,'id'=>'edit']) !!}
              {!!Form::hidden('old', !empty($newsInfo->news_detail)? $newsInfo->news_detail :'') !!}
              <span class="text-danger">{{$errors->first('news_detail')}}</span>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
          <div class="card bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header bg-white" style="color:black;">Product Type</div>
            <div class="card-body">
              <div class="md-form" style="margin:0;">
                  {!! Form::select('news_category', ['s' => 'Smart Phone', 't' => 'Tablet', 'l' => 'Laptop/PC'],'s', ['class'=>"mdb-select"]) !!}
                  <span class="text-danger">{{$errors->first('news_category')}}</span>
              </div>

            </div>
          </div>

          <div class="card bg-white mb-3" style="max-width: 18rem;">
              <div class="card-header bg-white" style="color:black;">Visibility</div>
              <div class="card-body">
                  @if($newsInfo->visibility=="true")
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="defaultChecked" name="visibility" value="true" checked>
                  <label class="custom-control-label" for="defaultChecked" style="font-size:14px;color:black;">Visible</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="visibility" value="false">
                    <label class="custom-control-label" for="defaultUnchecked" style="font-size:14px;color:black;">Hidden</label>
                  </div>  
                @else
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultChecked" name="visibility" value="true" >
                    <label class="custom-control-label" for="defaultChecked" style="font-size:14px;color:black;">Visible In Shop</label>
                  </div>
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="defaultUnchecked" name="visibility" value="false" checked>
                  <label class="custom-control-label" for="defaultUnchecked" style="font-size:14px;color:black;">Hidden From Shop</label>
                </div>  
  @endif
              </div>
            </div>


       
          <div class="card bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header bg-white" style="color:black;">Features Image</div>
            <div class="card-body">
                <div>
                  <img id="img" src="{{asset('images/'.$newsInfo->news_image)}}"  style="width:100px; height:100px;"/>
                    <div class="md-form file-field">
                      <a class="btn-floating purple-gradient mt-0 float-left">
                        <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                        <input type="file" id="image" name="news_image" onchange='readURL(this);' multiple>
                       
                      </a>
                      
                    </div>
                  
                  </div>
            </div>
          </div>
        
        </div>
      </div>
      <div class="form-group" style="margin-top:10px;float:left;">
        {!!Form::hidden('hiddenpostid', !empty($newsInfo->id) ? $newsInfo->id : '') !!} 
        {!! Form::submit('Update', ['class' => 'btn btn-lg btn-primary','id'=>'update']) !!}
      </div>
      
    </div>
    {!!Form::close()!!}
  </div>
  
  @endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>
{{-- <script src="{{asset('js/mdbForm.js')}}"></script> --}}

<script>
  // Material Select Initialization
          $(document).ready(function() {
            $('.mdb-select').formSelect();
            // $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
            var editor = $("#edit").Editor();
            var txt = $("input[name='old']").val();
            console.log(txt);
            
            $("#edit").Editor("setText", txt);

            $('#update').click(function() 
              {
                var str = $("#edit").Editor("getText");
                $('#edit').val(str);
              });

      });
    
</script>
