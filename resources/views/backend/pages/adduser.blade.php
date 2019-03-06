@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add User</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('backend/adduser')}}" method="post">
               {{ csrf_field() }}

               @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                {!! session('message.content') !!}
                </div>
               @endif
               
               <div class="form-group">
                  <label>Role:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <select name="role_id" class="form-control" name="role_id"  required >
                        <option value="volvo">Select Role</option>
                        <!-- <option value="1">Admin</option> -->
                        <option value="2">Staff</option>
                        <!-- <option value="3">Student</option> -->
                    </select>
                  </div>
               </div>
               
               <div class="form-group">
                  <label>Name:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                     <i class="fa fa-user"></i>

                     </div>
                     <input type="text" name="name" class="form-control "     />

                  </div>
               </div>
               <div class="form-group">
                  <label>Mobile</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" name="mobile" class="form-control " />

                            </div>
               </div>
               <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" name="email" class="form-control " />        
                 </div>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="password" name="password" class="form-control " />        
                 </div>
              </div>
              <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="password" name="password_confirmation" class="form-control " />        
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