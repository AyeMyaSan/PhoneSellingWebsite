@extends('home')
@section('content')
<div class="content">
  <div class="container">
    <span>
      <h2 style="font-weight: bold;color:black;">Edit Product</h2>
    </span>
    {!!Form::open(['route'=>'productUpdate', 'method'=>'post', 'enctype' => 'multipart/form-data'])!!}
    @csrf

    <div class="row" style="border-bottom:1px solid #dfe3e8;">
      <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
        <div class="box" style="color:black;">
          <div class="md-form form-sm">
            {!! Form::text('model',!empty($productInfo->model) ? $productInfo->model : '',['class' => 'form-control'])
            !!} {!! Form::label('model')!!}
            <span class="text-danger">{{$errors->first('model')}}</span>
          </div>

          <div class="md-form form-sm">
            {!! Form::textarea('feactures','',['class' => 'md-textarea form-control','rows' => 5, 'id'=>'edit']) !!}
            {!! Form::hidden('old',!empty($productInfo->other_feactures) ?
            $productInfo->other_feactures:'',['class' => 'md-textarea form-control','rows' => 5]) !!}
            
            <span class="text-danger">{{$errors->first('feactures')}}</span>
          </div>
        </div>

        <div class="box">
          <span>
            <h6 style="font-weight: bold;color:black;">Specificaton of Product<i class="fal fa-salad"></i></h6>
          </span>

          <div class="row">
            <div class="col-sm-6">
              <div class="md-form form-sm">
                {!! Form::text('screensize',!empty($productInfo->screensize) ? $productInfo->screensize:'',['class'
                =>
                'form-control']) !!}
                {!! Form::label('screensize')!!}
                <span class="text-danger">{{$errors->first('screensize')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('cpu',!empty($productInfo->cpu) ? $productInfo->cpu:'',['class' => 'form-control' ])
                !!}
                {!! Form::label('cpu')!!}
                <span class="text-danger">{{$errors->first('cpu')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('os',!empty($productInfo->os) ? $productInfo->os:'',['class' => 'form-control']) !!}
                {!! Form::label('os')!!}
                <span class="text-danger">{{$errors->first('os')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('memory',!empty($productInfo->memory) ? $productInfo->memory:'',['class' =>
                'form-control']) !!}
                {!! Form::label('memory')!!}
                <span class="text-danger">{{$errors->first('memory')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('camera',!empty($productInfo->camera) ? $productInfo->camera:'',['class' =>
                'form-control']) !!}
                {!! Form::label('camera')!!}
                <span class="text-danger">{{$errors->first('camera')}}</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="md-form form-sm">
                {!! Form::text('resolution',!empty($productInfo->resolution) ? $productInfo->resolution:'',['class'
                =>
                'form-control']) !!}
                {!! Form::label('resolution')!!}
                <span class="text-danger">{{$errors->first('resolution')}}</span>
              </div>


              <div class="md-form form-sm">
                {!! Form::text('gpu',!empty($productInfo->gpu) ? $productInfo->gpu:'',['class' => 'form-control' ])
                !!}
                {!! Form::label('gpu')!!}
                <span class="text-danger">{{$errors->first('gpu')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('ram',!empty($productInfo->ram) ? $productInfo->ram:'',['class' => 'form-control'])
                !!}
                {!! Form::label('ram')!!}
                <span class="text-danger">{{$errors->first('ram')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('battery',!empty($productInfo->battery) ? $productInfo->battery:'',['class' =>
                'form-control']) !!}
                {!! Form::label('battery')!!}
                <span class="text-danger">{{$errors->first('battery')}}</span>
              </div>
              <div class="md-form form-sm">
                {!! Form::text('price',!empty($productInfo->price) ? $productInfo->price:'',['class' =>
                'form-control'])
                !!}
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
              {!! Form::text('brand',!empty($productInfo->brand) ? $productInfo->brand:'',['class' =>
              'form-control'])
              !!} {!! Form::label('brand')!!}
              <span class="text-danger">{{$errors->first('brand')}}</span>
            </div>
          </div>
        </div>

        <div class="card bg-white mb-3" style="max-width: 22rem;">
          <div class="card-header bg-white" style="color:black;">Colors</div>
          <div class="card-body">
            {!! Form::text('color',!empty($productInfo->color) ? $productInfo->color:'',['class' => 'form-control']) !!}
            <span class="text-danger">{{$errors->first('color')}}</span>
          </div>
        </div>


        <div class="card bg-white mb-3" style="max-width: 22rem;">
          <div class="card-header bg-white" style="color:black;">Visibility</div>
          <div class="card-body">
              @if($productInfo->visibility=="true")
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="defaultChecked" name="visibility" value="true" checked>
              <label class="custom-control-label" for="defaultChecked" style="font-size:14px;color:black;">Visible In Shop</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultUnchecked" name="visibility" value="false">
                <label class="custom-control-label" for="defaultUnchecked" style="font-size:14px;color:black;">Hidden From Shop</label>
              </div>  
            @else
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultChecked" name="visibility" value="true" >
                <label class="custom-control-label" for="defaultChecked" style="font-size:14px;color:black;">Visible</label>
              </div>
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="defaultUnchecked" name="visibility" value="false" checked>
              <label class="custom-control-label" for="defaultUnchecked" style="font-size:14px;color:black;">Hidden</label>
            </div>  
@endif
          </div>
        </div>
        
        <div class="box" style="color:black;">
            <div>
              <h6 style="color:gray;float:right;">My Product's Image</h6>
            </div>
            <hr>
            <div>
              <?php 
              $flag = false;
              if(!empty($productInfo->image)){
                $flag = true;
              }
              ?>
              @if($flag != false)
              <div class="row">
                {{-- <div class="col-md-12">
                  <div id="mdb-lightbox-ui"></div>
                </div> --}}
  
                <div class="mdb-lightbox">
                  <div class="row">
                    <?php $img = explode(', ',$productInfo->image); ?>
                    {{-- {{dd($img)}} --}}
                    @foreach($img as $key=>$value)
                    <figure class="view overlay zoom col-lg-11" style="margin-bottom: 5px; margin-left:14px;">
                      <a href="{{asset('images/'.$value)}}" data-size="1600x1067">
                        <img src="{{asset('images/'.$value)}}" alt="img" class="rounded img-fluid" />
                      </a>
                    </figure>
                    @endforeach
                  </div>
                </div>
              </div>
  
              @else
              <i id="iconimg" class="	far fa-images fa-6x" style="color:grey;margin-top:50px;margin-left:30%;"></i>
              @endif
              <div class="md-form file-field">
                <a class="btn-floating purple-gradient mt-0 float-left">
                  <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                  <input type="file" id="image[]" name="image[]" multiple>
                </a>
                @if($flag != false)
                <div class="file-path-wrapper">
                  {!! Form::text('image',!empty($productInfo->image) ? $productInfo->image:'',['class' => 'file-path
                  validate']) !!}
                </div>
                @endif
              </div>
            </div>
          </div>

      </div>
    </div>
    <div class="form-group" style="margin-top:10px;float:left;">
      {!! Form::hidden('hiddenproductid',$productInfo->id)!!}
      {!! Form::submit('Update', ['class' => 'btn btn-sm aqua-gradient','id'=>'update']) !!}
      {!!Form::close()!!}
    </div>

  </div>
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
            $('input[name="color"]').amsifySuggestags();
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