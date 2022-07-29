@extends('home')
@section('content')
<div class="container">
  @csrf
  <table class="table table-bordered" id="news_datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>Title</th>
        <th>Category</th>
        <th>Detail</th>
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
    $('#news_datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('/news-list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
      { data: 'news_title', name: 'news_title',
      render: function( data, type, full, meta ) {
        return "<img src=\"/images/" + full['news_image'] + "\" width=\"70\" height=\"50\" />" +'&nbsp;&nbsp;' + data;
      },
      orderable: false, searchable: true },
      { data: 'news_category', name: 'news_category', orderable: false, searchable: true },
      { data: 'news_detail', name: 'news_detail',render: getText, orderable: false, searchable: true},
      { data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
    $('#news_datatable tbody').on( 'click', 'tr', function () {
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
        
        url: "/news/delete/{id}", 
        success : function(data){
          table.row('.selected').remove().draw( false );
        },
        error: function(xhr){
        }});   
      });

      function getText( data, type, row, meta ) {
      var obj = row;
      var json = obj.news_detail;  
      var detals = $("<span>").html(json).text();
      
      console.log(detals);
      return detals;
      }
    });
  </script>
  @endsection