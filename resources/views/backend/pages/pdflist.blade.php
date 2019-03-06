@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">Pdf List</h3>
               <div class="box-tools pull-right">
                  <a href="{{url('backend/addpdf')}}"><button type="button" class="btn btn-info btn-md addcat" data-toggle="modal" ><b>ADD</b><i class="fa fa-user-plus"></i></button></a>
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Pdf Category</th>
                           <th>Subject</th>
                           <th>Topic</th>
                           <th>Source</th>
                           <th>View</th>
                           <th>Edit </th>
                           <th>Delete</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=0;
                           ?>
                        @foreach ($pdfrs as $val)
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->sub_category}}</td>
                           <td>{{ $val->subject}}</td>
                           <td>{{ $val->topic}}</td>
                           <td>{{ $val->source}}</td>
                           <td><a href="{{ $val->pdf_path }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                           <td><a href="" data-id="{{ $val->id }}" data-toggle="modal" data-target="#myModal1" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editpdf" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
                           <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td>
                           <!-- <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td> -->
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
   </div>
   <!-- The  Edit Modal -->
   <div class="modal" id="myModal1">
   <div class="modal-dialog">
   <div class="modal-content">
   <!-- Modal Header -->
   <div class="modal-header">
      <h4 class="modal-title">Edit Pdf </h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <!-- Modal body -->
   <div class="modal-body">
      <form action="" method="post" id="editpdf" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input type="hidden" name="id" id="id"  placeholder="id" class="form-control" required>
         <div class="form-group">
            <label>Category:</label>
            <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-laptop"></i>
               </div>
               <select class="form-control " id="category" name="pdf_category"  style="width: 100%;" >
                  <option selected="selected">Select </option>
                  @foreach ($category as $val)
                  <option value="{{$val->category}}">{{$val->category}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group">
            <label>Subject</label>
            <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
               </div>
               <input type="text" name="subject" id="subject"  placeholder="Subject" class="form-control" required>
            </div>
            <!-- /.input group -->
         </div>
         <div class="form-group">
            <label>Topic</label>
            <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
               </div>
               <textarea name="topic" id="topic" rows="2" placeholder="Topic..." class="form-control" ></textarea>
            </div>
            <!-- /.input group -->
         </div>
         <div class="form-group">
            <label>Version</label>
            <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
               </div>
               <input type="text" name="version" id="version"  placeholder="Version" class="form-control" required>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Source</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="source" id="source"  placeholder="Source" class="form-control" required>
                  <!-- /.input group -->
               </div>
               <div class="form-group">
                  <label>Upload Pdf</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="file" name="pdf" id="text-input"  placeholder="Name" class="form-control" required>
                  </div>
                  <!-- /.input group -->
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary editsubmit">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
      </form>
      </div>
      </div>
   </div>
</section>
<script>
   $(function () {
     $('#example1').DataTable()
     $('#example2').DataTable({
       'paging'      : true,
       'lengthChange': false,
       'searching'   : false,
       'ordering'    : true,
       'info'        : true,
       'autoWidth'   : false
     })
   })
</script>
<script type="text/javascript">
   $(function() {
       $('.images').hide(); 
       $('.p_cat').change(function(){
         //$('.images').show(); 
           var id=$(this).val();
            //alert(id);
            var url = "{{url('backend/getpdfcategory')}}"+"/"+id;
            $.ajax({
               type: 'GET',
               url: url,
               success:function(data){
                //console.log(data.pdf.length);
                $('.images').show(); 
                var len=data.pdf.length;
                //alert(len);
   
                var s= "";
                       for(i=0; i<len; i++){
   
                         url = "{{ asset('public/pdf') }}"+"/"+data.pdf[i].pdf_path;
                           s+='<tr><th >'+ (parseInt(i)+1) +'</th><td>'+data.pdf[i].subject+'</td><td>'+data.pdf[i].topic+'</td><td><a href="#" id="viewpdf" data-id='+data.pdf[i].id+' class="btn btn-primary">View</a></td></tr>';
                       }
                       document.getElementById("list").innerHTML=s;
                       datatable();
               }
           });
         
       });
   });
</script>
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('backend/deletepdf') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>
<script>
   $(document).on('click', '.submit', function () {
         // var data  = $('#batchForm').serializeArray();
         //  console.log(data);
         var data = new FormData($('#addcat')[0]);
          console.log(data);
          var url = "{{url('backend/addcat')}}";
        $.ajax({
              type:'POST',
              url:url,
              data:data,
              dataType: "json",
              processData: false,
              contentType: false,
              async:true,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success:function(response){
                  // console.log(response);
                  if(response.status='1')
                  
                  {
                      console.log(response);
                      $('#myModal1').modal('hide');
                     location.reload()
                    
                  }
           }
        });
      });
   
</script>
<script>
   $(document).on('click','.editpdf',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
     // alert(id);
      var url = "{{ url('backend/editpdf') }}"+"/"+id;
      $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res.pdf);
              $('#id').val(res.pdf.id);
              $('#category').val(res.pdf.category);
              $('#subject').val(res.pdf.subject);
              $('#topic').val(res.pdf.topic);
              $('#version').val(res.pdf.version);
              $('#source').val(res.pdf.source);
   
              $('#mymodal1').modal('show');
          }
      });
    });
</script>
<script>
   $(document).on('click', '.editsubmit', function () {
       //   var data  = $('#editpdf').serializeArray();
       //   console.log(data);
         //var data = new FormData($('#editpdf')[0]);
         var data = new FormData( $( 'form#editpdf' )[ 0 ] );
          //console.log(data);
          var url = "{{url('backend/saveeditpdf')}}";
        $.ajax({
              type:'POST',
              url:url,
              data:data,
              dataType: "json",
              processData: false,
              contentType: false,
              async:true,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success:function(response){
                  // console.log(response);
                  if(response.status='1')
                  
                  {
                      console.log(response);
                      $('#myModal').modal('hide');
                     location.reload()
                    
                  }
           }
        });
      });
   
</script>
@stop