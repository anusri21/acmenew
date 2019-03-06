@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Change Password</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('backend/updatepwd')}}" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}

               

               
               <div class="form-group">
                     <label>Current Password</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="cpass" id="text-input"  placeholder="Current Password" class="form-control" required>
                     </div>
                     <!-- /.input group -->
                  </div>
               
               <div class="form-group">
                     <label>New Password</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="npass" id="text-input"  placeholder="New Password" class="form-control" required>
                     </div>
                     <!-- /.input group -->
                  </div>
                  
               
            
            </div>
          
            <button type="submit" class="btn btn-block btn-primary">Submit</button>

         </div>
         <!-- /.box-body -->
      </div>
    </form>
      <!-- /.box -->
   </div>
  
</section>

@stop