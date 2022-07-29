@extends('cusIndex')
@section('cc')

<div class="container" style="width:900px;margin-top:30px;">
  <span>
    <h2 style="font-weight: bold;margin-bottom:20px;">My Order</h2>
  </span>
  <table class="table" id="myorder_datatable" >
    <thead style="background-color:#efefef;">
      <tr>
        <th>ID</th>
        <th>Model</th>
        <th>Total Quantity</th>
        <th>Total Price</th>
        <th>Date</th>
        <th>Status</th>
        <th>View Detail</th>
      </tr>
     
    </thead>
  </table>
</div>


<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->

<script>
  var editor;
  
  $(document).ready( function () {

    $('#myorder_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('myorder-list') }}",

            columns: [
                     { data: 'id', name: 'id', orderable: false, searchable: true },
                     { data: 'model', name: 'model', orderable: false, searchable: true },
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
