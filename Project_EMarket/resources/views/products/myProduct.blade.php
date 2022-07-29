@extends('home')
@section('content')

<div class="container">
  @csrf
  <table class="table table-bordered" id="products_datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>Model</th>
        <th>Brand</th>
        <th>Category</th>
        <th>CPU</th>
        <th>GPU</th>
        <th>OS</th>
        <th>RAM</th>
        <th>Screen Size</th>
        <th>Edit</th>
      </tr>
    </thead>
  </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
  
  $(document).ready( function () {
    $('#products_datatable').DataTable({
            processing: true,
            serverSide: true,
             ajax: "{{ url('/product-list') }}",
            columns: [
                     { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
                     { data: 'model', name: 'model', render: getImg , orderable: false, searchable: true },
                     { data: 'brand', name: 'brand',orderable: false, searchable: true},
                     { data: 'category', name: 'category', orderable: false, searchable: true },
                     { data: 'cpu', name: 'cpu', orderable: false, searchable: true },
                     { data: 'gpu', name: 'gpu', orderable: false, searchable: true },
                     { data: 'os', name: 'os', orderable: false, searchable: true },
                     { data: 'ram', name: 'ram', orderable: false, searchable: true },
                     { data: 'screensize', name: 'screensize', orderable: false, searchable: false},
                     { data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
         });
         $('#products_datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#removeBtn').click( function () {

     $.ajax({
      
       url: "/product/delete/{id}", 
       success : function(data){
          table.row('.selected').remove().draw( false );
        },
       error: function(xhr){
        }}); 

    } );
    function getImg( data, type, row, meta ) {
      var obj = row;
      var json = obj.image;
      var json_array = json.split(',');
      var first_image = json_array[0];
  
      // var text = JSON.stringify(first_image);
      // alert(text);
      // console.log(text);
            return "<img src=\"/images/" + first_image + "\" width=\"70\" height=\"50\" />" +'&nbsp;&nbsp;' + data;
            

          }
  });
</script>
@endsection
