@extends('home')
@section('content')

<div class="container">

  <table class="table table-bordered" id="review_datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Title</th>
        <th>Content</th>
        <th>Rating</th>
        <th>Status</th>
        <th>View Detail</th>
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

    $('#review_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/review-list') }}",
            columns: [
                     { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false },
                     { data: 'name', name: 'name', orderable: false, searchable: true },
                     { data: 'rev_title', name: 'rev_title',orderable: false, searchable: true },
                     { data: 'rev_msg', name: 'rev_msg',orderable: false, searchable: true},
                     { data: 'rev_rating', name: 'rev_rating',orderable: false, searchable: true},
                     { data: 'status', name: 'status',
                     render: function ( data, type, row ) {
                      var color = '';
                      if (data == "Pending") {
                        color = 'red';
                      }
                      if (data == "Confirmed") {
                        color = 'blue';
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
