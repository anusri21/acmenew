@extends('backend.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Course Category</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" ><b>ADD</b><i class="fa fa-user-plus"></i></button>
                </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                          <th>S.No</th>
                           <th>Name</th>
                           <!-- <th>View</th> -->
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                 <?php
                     $i=0;
                    ?>
                  @foreach ($course as $val)
                    
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->category}}</td>
                           <!-- <td><a href="{{ url('admin/viewbanner/'.$val->id) }}"   class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td> -->
                           <td><a href="#"  id="edit" data-id="{{$val->id}}" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" data-toggle="modal" data-target="#myModal1" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
                           <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td>
                        </tr>
                        @endforeach
                
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>
          </section>



 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Course Category</h4>
        </div>
        <div class="modal-body">
        <form action="{{url('backend/addcoursecategory')}}" method="post" id="register">
        {{csrf_field() }}
        <div class="form-group">
                  <label> Category</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="title" name="category" data-mask placeholder="Course Category" required>

                     </div>
               </div>
       
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Course Category</h4>
        </div>
        <div class="modal-body">
        <form action="{{url('backend/addcoursecategory')}}" method="post" id="register">
        {{csrf_field() }}
        <input type="hidden" class="form-control" name="id" id="id" >

        <div class="form-group">
                  <label> Category</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="category" name="category"   data-mask >
                     </div>
               </div>
       
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

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
   $(document).ready(function() {
     $('#admission').DataTable();
   } );
</script>

<script>
 $(document).on('click','.delete',function(){
   alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('backend/deletcoursecategory') }}"+"/"+id;
    //alert(url);
    window.location.href = url;
  });
</script>

<script>
 $(document).on('click','#edit',function(){
   //alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('backend/editcoursecategory') }}"+"/"+id;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            $('#id').val(res.data.id);
            $('#category').val(res.data.category);

            $('#mymodal1').modal('show');
        }
    });
  });
</script>
@stop