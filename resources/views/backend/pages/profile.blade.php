@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
   <div class="col-md-6">
   <div class="box box-danger">
   <div class="box-header">
      <h3 class="box-title">View Profile</h3>
      <div class="box-tools pull-right">
         <a href="#"><button type="button" data-id="{{$userrs->id}}" class="btn btn-info btn-md editprof" data-toggle="modal" ><i class="fa fa-edit"></i></button></a>
      </div>
   </div>
   <div class="box-body">
      <!-- Date dd/mm/yyyy -->
      <div class="row">
         <div class="col-md-12">
            <div class="panel-body">
               <div class="form-group">
                  <label class="col-md-6 col-xs-12 control-label"><b>Name</b></label>
                  <div class="col-md-6 col-xs-12">
                     <label class="col-md-5 col-xs-12 control-label">{{$userrs->name}}</label>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <label class="col-md-6 col-xs-12 control-label"><b>Mobile</b></label>
                  <div class="col-md-6 col-xs-12">
                     <label class="col-md-5 col-xs-12 control-label" >{{$userrs->mobile}}</label>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <label class="col-md-6 col-xs-12 control-label"><b>Email</b></label>
                  <div class="col-md-6 col-xs-12">
                     <label class="col-md-5 col-xs-12 control-label">{{$userrs->email}}</label>
                  </div>
               </div>
               <br>
            </div>
         </div>
      </div>
      <!-- /.box -->
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
         <form action="{{url('backend/editprofile')}}" method="post" id="editpdf" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id"  placeholder="id" class="form-control" required>
            <div class="form-group">
               <label>Name</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="name" id="name"  placeholder="Name" class="form-control" required>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Mobile</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="mobile" id="mobile"  placeholder="Mobile" class="form-control" required>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Email</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="email" id="email"  placeholder="Email" class="form-control" required>
                  <!-- /.input group -->
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary editsubmit">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
         </form>
         </div>
      </div>
   </div>


</section>



<script>
   $(document).on('click','.editprof',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
     // alert(id);
      var url = "{{ url('backend/editprof') }}"+"/"+id;
      $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res.user);
              $('#id').val(res.user.id);
              $('#name').val(res.user.name);
              $('#mobile').val(res.user.mobile);
              $('#email').val(res.user.email);
             
   
              $('#myModal1').modal('show');
          }
      });
    });
</script>
@stop