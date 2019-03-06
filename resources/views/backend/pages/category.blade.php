@extends('backend.default')
@section('content')
<section class="content">
   <div class="row">
   <div class="col-md-12">
      <div class="box box-danger">
         <div class="box-header">
            <h3 class="box-title">Category</h3>
         </div>
         <center>
            <div id="selectitem"><b>Selected Category is: {{$item}}</b></div>
         </center>
         <?php
               $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
               $src = parse_url($url, PHP_URL_QUERY);
               //echo $pieces;

         ?>
        <input type="hidden" value="<?php echo $src; ?>" id="src">
         <div class="box-body">
            <div class="col-md-12">
               <form action="{{url('admin/addenquiry')}}" method="post">
               {{csrf_field() }}
                    <div class="form-group">
                        <label>Select Category:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                            </div>
                            <select name="reference" id="selectcat" class="form-control p_cat" >
                            <option value="0">Select</option>
                            @foreach ($category as $val)
                                 <option value="{{$val->category}}">{{$val->category}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <br>
                    <div class="images">
                     <!-- <div id="list">
                     </div> -->
                     <table class="table table-hover" id="example1">
                        <thead>
                           <tr>
                              <th >S.No</th>
                              <th >Subject</th>
                              <th >Topic</th>
                              <!-- <th ></th> -->
                              <th >View</th>
                              <!-- <th scope="col">Print</th> -->
                           </tr>
                        </thead>
                        @if($pdfcat!='')
                        <tbody id="list">
                       
                                 <?php
                                    $i=0;
                                 ?>
                           @foreach ($pdfcat as $val)
                              
                                 <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $val->subject}}</td>
                                    <td>{{ $val->topic}}</td>
                                    <!-- <td>{{ $val->source}}</td> -->
                                    <td><a href="#" data-id="{{$val->id}}" id="viewpdf" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                                   
                                 </tr>
                                 @endforeach
                              
                        
                           
                        </tbody>
                        @else
                        <tbody>
                        
                        </tbody>
                        @endif
                     </table>
                  </div>
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
               <!-- <button type="submit" class="btn btn-block btn-primary">Submit</button> -->
         </div>
         <!-- /.box-body -->
      </div>
      </form>
      <!-- /.box -->
   </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Pdf Document</h4>
      </div>
      <div class="modal-body">
          <iframe src="#" id="showpdf" width="550" height="500" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="printpdf" target="_blank" class="btn btn-primary">Print</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

         

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


<script>
   $('#selectcat').on('change', function()
   {
     select = $('#selectcat option:selected').val(); 
     source = $('#src').val();
      console.log(source);
   if(source){
    // var url = "{{ url('backend/category') }}"+"/?sterm="+select+"&"+source;
      var url = "{{ url('backend/category') }}"+"/?"+source+"&sterm="+select;
     //alert(url);
     window.location.href = url;
   }
   else{
      var url = "{{ url('backend/category') }}"+"/?sterm="+select;
      window.location.href = url;
   }
   });
</script>


<!-- <script type="text/javascript">
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
</script> -->

<script>
$(document).on('click', '#viewpdf', function () {

   var id=$(this).attr('data-id');
   //alert(id);
   var url = "{{url('backend/getpdf')}}"+"/"+id;
            $.ajax({
               type: 'GET',
               url: url,
               success:function(data){
                 
                pdfpath= data.pdf.pdf_path;
               // console.log(pdfpath);
                pathurl = pdfpath+"?page=hsn#toolbar=0";
                $('#showpdf').attr('src', pathurl);
                $('#myModal').modal('show');
               }
           });
   

});
</script>

<script>
$(document).on('click', '#printpdf', function () {
   // window.open(url, '_blank');
   $('#myModal').modal('hide');
   printFrame();
});


function printFrame() {
            // var frm = document.getElementById("showpdf").contentWindow;
            // frm.focus();// focus on contentWindow is needed on some ie versions
            // frm.print();
            // return false;
            var PDF = document.getElementById("showpdf");
            PDF.focus();
            PDF.contentWindow.print();
}
</script>


@stop