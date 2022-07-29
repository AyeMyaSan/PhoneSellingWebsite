@extends('home')
@section('content')

<div class="container">
  <table class="table table-bordered" id="order_datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Phone No.</th>
        <th>Model</th>
        <th>Total Quantity</th>
        <th>Total Price</th>
        <th>Date</th>
        <th>Status</th>
        <th>View Detail</th>
        {{-- <th colspan="2">Action</th> --}}
      </tr>
    </thead>
  </table>
</div>

<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
  var editor;
  
  $(document).ready( function () {

    $('#order_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/order-list') }}",

            columns: [
                     { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false },
                     { data: 'id', name: 'id', orderable: false, searchable: true },
                     { data: 'name', name: 'name',orderable: false, searchable: true },
                     { data: 'phoneNo', name: 'phoneNo',orderable: false, searchable: true},
                     { data: 'products', name: 'products', orderable: false, searchable: true },
                     { data: 'total_quantity', name: 'total_quantity', orderable: false, searchable: true },
                     { data: 'total_price', name: 'total_price', orderable: false, searchable: true },
                     { data: 'updated_at', name: 'updated_at', orderable: false, searchable: true },
                     { data: 'status', name: 'status',
                     render: function ( data, type, row ) {
                      var color = '';
                      if (data == "Pending") {
                        color = 'red';
                      }
                      if (data == "Confirmed") {
                        color = 'blue';
                      }
                      if (data == "Delivered") {
                        color = 'teal';
                      }
                      return '<span style="color:' + color + '">' + data + '</span>';
                    },
                      orderable: false, searchable: true },
                     { data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
         });


    $('#detailBtn').click( function () {

 } );

      });
      
</script>
@endsection
