@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Edit User</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('backend/edituser')}}" method="post">
               {{ csrf_field() }}
               <input type="hidden" name="id" class="form-control "   value="{{$user->id}}"  />

               <div class="form-group">
                  <label>Role:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <select name="role_id" class="form-control" name="role_id"  required >
                        <option value="volvo">Select Role</option>
                        <option value="<?php echo $user->role_id;?>" <?php echo ($user->role_id) ? ' selected="selected"' : '';?>><?php echo $user->role_id;?></option>
                        
                        <option value="2">Staff</option>
                      
                    </select>
                  </div>
               </div>
               
               <div class="form-group">
                  <label>Name:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                     <i class="fa fa-user"></i>

                     </div>
                     <input type="text" name="name" class="form-control "   value="{{$user->name}}"  />

                  </div>
               </div>
               <div class="form-group">
                  <label>Mobile</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" name="mobile" class="form-control " value="{{$user->mobile}}" />

                            </div>
               </div>
               <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" name="email" class="form-control "  value="{{$user->email}}"/>        
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