@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Pdf</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('backend/addpdf')}}" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}

               
               <div class="flash-message">
                              @include('backend.pages.notification')
                        </div>
                        
               <div class="form-group">
                  <label>Category:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <select class="form-control " required="required" id="category" name="pdf_category"  style="width: 100%;" >
                        <option selected="selected">Select </option>
                        @foreach ($category as $val)
                        <option value="{{$val->category}}">{{$val->category}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label>Subject:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" name="subject" id="text-input"  placeholder="Subject" class="form-control" required>

                  </div>
               </div>
               <div class="form-group">
                     <label>Source</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <select class="form-control " required="required" id="category" name="source"  style="width: 100%;" >
                           <option selected="selected">Select </option>
                           @foreach ($source as $val)
                           <option value="{{$val->title}}">{{$val->title}}</option>
                           @endforeach
                        </select>
                     </div>
                     <!-- /.input group -->
                  </div>
               <div class="form-group">
                     <label>Grade</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <select class="form-control " required="required" id="grade" name="grade"  style="width: 100%;" >
                        <option selected="selected">Select </option>
                        @foreach ($grade as $val)
                        <option value="{{$val->grade}}">{{$val->grade}}</option>
                        @endforeach
                     </select>
                     </div>
                     <!-- /.input group -->
                  </div>
               <div class="form-group">
                  <label>Topic</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <textarea name="topic" id="textarea-input" rows="2" placeholder="Topic" class="form-control" required></textarea>            </div>
                  <!-- /.input group -->
               </div>
               <div class="form-group">
                     <label>Version</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="version" id="text-input"  placeholder="Version" class="form-control" required>
                     </div>
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