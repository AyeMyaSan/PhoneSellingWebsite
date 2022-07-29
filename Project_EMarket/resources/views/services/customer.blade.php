@extends('home')
@section('content')

<div class="container">
  <span style="float:right;">
    {!!Form::open(['route'=>['showAddUser'],'method'=>'get'])!!}
    {!!Form::submit('Add New User',['class'=>'btn btn-sm btn-primary'])!!}
    {!!Form::close()!!}
  </span>
  @csrf
  <table class="table table-bordered" id="customers_datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
        </tr>
    </thead>
  </table>
</div>

<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
  
  $(document).ready( function () {
    $('#customers_datatable').DataTable({
            processing: true,
            serverSide: true,
             ajax: "{{ url('/customer-list') }}",
            columns: [
                     { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
                     { data: 'name', name: 'name', orderable: false, searchable: true },
                     { data: 'email', name: 'email', orderable: false, searchable: true },
                     { data: 'role', name: 'role', orderable: false, searchable: false},
                     { data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
         });
         $('#customers_datatable tbody').on( 'click', 'tr', function () {
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
      
       url: "/delete/customer/{id}", 
       success : function(data){
          table.row('.selected').remove().draw( false );
        },
       error: function(xhr){
        }}); 

    } );
});
</script>
@endsection