@extends('backend.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Grade List </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-info btn-md" data-toggle="modal"  data-target="#myModal"><b>ADD</b><i class="fa fa-user-plus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                           <th>S.No</th>
                           <th>Grde</th>
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                      @foreach ($grade as $val)
                     
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->grade}}</td>
                          

                           <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 editgrade" data-toggle="modal" data-id="{{ $val->id }}" ><i class="fa fa-edit"></i></button></td>
                           <!-- <td><a href="#" data-id="{{$val->id}}" data-toggle="modal" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editgrade" > <i class="fa fa-edit"></i> </a></td> -->
                            <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td>
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
          </section>

          <div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('backend/addGrade')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add GradeDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                       
                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Grade</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="grade"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                 </div>
                  </div>
                  
                </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success addclient" datafrm="add_form">Submit</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </form>
   </div>
</div>
<div id ="editModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal" id="add_form" action="{{url('backend/addGrade')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit GradeDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                     <input type="hidden" name="id"  id="id" class="form-control" placeholder="" required/>

                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">grade</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="grade"  id="st" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        
                    </div>
                  </div>
                  
                  
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success addGrade" datafrm="add_form">Submit</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </form>
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
   $(document).on('click','.editgrade',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('backend/editgrade')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  //console.log($("#"+data));
                  $('#id').val(data.system.id);
                  $('#st').val(data.system.grade);
                  
                 
   
                  $('#editModal').modal('show');
                 }
             });
    });
</script>
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('backend/deletegrade') }}"+"/"+id;
      //alert(id);
      window.location.href = url;
    });
</script>

@stop