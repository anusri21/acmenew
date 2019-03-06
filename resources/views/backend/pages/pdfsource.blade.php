@extends('backend.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pdf Source List </h3>
              <div class="box-tools pull-right">
              <a href="#"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal"><b>ADD</b><i class="fa fa-plus-circle"></i></button></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                           <th>S.No</th>
                           <th>Title</th>
                           <th>Web Url</th>
                           <!-- <th>Phone</th>
                           <th>Role</th> -->
                           <!--<th>View</th>-->
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                      @foreach ($source as $val)
                     
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->title}}</td>
                           <td>{{ $val->web_url}}</td>
                         

                           <!--<td><a href="{{ url('backend/viewuser/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>-->
                           <td><a href="#" data-id="{{$val->id}}" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editsource" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
                           <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td>
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

<!-- Add Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('backend/addpdfsource')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add Pdf Source</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                       
                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Title</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="title"  class="form-control" placeholder="Title" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Web Url</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="web_url" class="form-control" placeholder="Web Url" required/>
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

<!-- Edit System Detail Modal -->
<div id="myModal1" class="modal fade" role="dialog">
   <div class="modal-dialog">
   <form class="form-horizontal" action="{{url('backend/addpdfsource')}}" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit Pdf Source</h4>
            </div>
            <div class="modal-body">
          
            <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                     <input type="hidden" name="id" id="sid" class="form-control"  required/>

                     <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Title</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="title" id="title" class="form-control" placeholder="Title" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Web Url</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="web_url" id="web_url" class="form-control" placeholder="Web Url" required/>
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




<!-- END DEFAULT DATATABLE -->
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('backend/deletepdfsource') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>

<script>
   $(document).on('click','.editsource',function(){
      //alert('clivk');
      //$('#myModal1').modal('show');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('backend/getpdfsource')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                 
                  $("#sid").val(data.pdf.id);
                  $('#title').val(data.pdf.title);
                  $('#web_url').val(data.pdf.web_url);
   
                  $('#myModal1').modal('show');
                 }
             });
    });
</script>
@stop