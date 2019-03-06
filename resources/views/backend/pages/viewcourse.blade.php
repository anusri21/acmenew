@extends('backend.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Course Details
            <!-- <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <strong> Course Code</strong><br><br>
        <strong> Course Name</strong><br><br>
        <strong> Description</strong><br><br>
        <strong> Category</strong><br><br>
      
        <strong> Start Date</strong><br><br>
        <strong> End Date</strong><br><br>
        <!-- <strong>Religion</strong><br><br>
        <strong> Admission Number</strong><br><br>
        <strong> Admission Date</strong><br><br>
        <strong> Date Of Joining</strong><br><br>
        <strong> Father Name</strong><br><br>
        <strong>Mother Name</strong><br><br>
        <strong> Father Occupation</strong><br><br>
        <strong> Father Mobile</strong><br><br>
        <strong>Address</strong><br><br>
        <strong>City</strong><br><br> -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$coursers->coursecode}}  <br><br>
        {{$coursers->coursename}}   <br><br>
        {{$coursers->description}}   <br><br>
        {{$coursers->category}}  <br><br>
      
        {{$coursers->startdate}}  <br><br>
        {{$coursers->enddate}}   <br><br>
       
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      

     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{url('backend/courselist')}}"  class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
<section>
@stop