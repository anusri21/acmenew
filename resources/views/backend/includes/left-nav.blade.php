<style>
.user-panel>.image>img {
    width: 100%;
    max-width: 80px;
    height: auto;
}
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src="{{asset('public/admin/image/logo.png')}}"  alt="User Image">
        </div>
      </div>
      @if(Auth::user()->role_id =='1')  
      <ul class="sidebar-menu" data-widget="tree">
        <li >
          <a href="{{url('backend/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Enquiry</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/addenquiry')}}"><i class="fa fa-address-book"></i> Add Enquiry</a></li>
            <li><a href="{{url('backend/enquirylist')}}"><i class="fa fa-th-list"></i> Enquiry List</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-child"></i>
            <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/createstudent')}}"><i class="fa fa-address-book"></i> Add Student</a></li>
            <li><a href="{{url('backend/studentdetails')}}"><i class="fa fa-th-list"></i> Student List</a></li>
            <li><a href="{{url('backend/studentcourse')}}"><i class="fa fa-th-list"></i> Student Course Details</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
          <i class="fa fa-paypal"></i></i>
            <span>Payment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/addpaymentdetail')}}"><i class="fa fa-address-book"></i> Add Payment Details</a></li>
            <li><a href="{{url('backend/paymentdetaillist')}}"><i class="fa fa-th-list"></i></i> Payment Details List</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>Course</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/addcoursecategory')}}"><i class="fa fa-address-book"></i>Course Category</a></li>
            <li><a href="{{url('backend/addcourse')}}"><i class="fa fa-address-book"></i> Add Course</a></li>
            <li><a href="{{url('backend/courselist')}}"><i class="fa fa-th-list"></i>Course List</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>Pdf</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/addpdf')}}"><i class="fa fa-address-book"></i> Add Pdf</a></li>
	    <li><a href="{{url('backend/pdflist')}}"><i class="fa fa-address-book"></i>Pdf List</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>Pdf Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{url('backend/addpdfcategory')}}"><i class="fa fa-address-book"></i>Add Pdf Category</a></li>
          <li><a href="{{url('backend/category')}}"><i class="fa fa-address-book"></i>Category Pdf List</a></li>
          </ul>
        </li> -->
        @foreach($source as $val)
          <li >
            <a href="{{url('backend/category/?source='.$val->title)}}">
              <i class="fa fa-check"></i>
              <span>{{$val->title}}</span>
            </a>
          </li>
          @endforeach
          <li >
            <a href="{{url('backend/pdfsource')}}">
              <i class="fa fa-clone"></i>
              <span>Pdf Source</span>
            </a>
          </li>
          <li >
            <a href="{{url('backend/addpdfcategory')}}">
              <i class="fa fa-clone"></i>
              <span>Add New Pdf Category</span>
            </a>
          </li>
          <li >
            <a href="{{url('backend/category')}}">
              <i class="fa fa-clone"></i>
              <span>Category Pdf List</span>
            </a>
          </li>
          <li >
            <a href="{{url('backend/addpdf')}}">
              <i class="fa fa-clone"></i>
              <span>Add New Pdf </span>
            </a>
          </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('backend/adduser')}}"><i class="fa fa-address-book"></i>Add User</a></li>
            <li><a href="{{url('backend/userlist')}}"><i class="fa fa-address-book"></i>User List</a></li>
          </ul>
        </li>
        <li >
            <a href="{{url('backend/gradelist')}}">
              <i class="fa fa-clone"></i>
              <span>Grade List</span>
            </a>
          </li>
      </ul>
      @else
      <ul class="sidebar-menu" data-widget="tree">
        <li >
          <a href="{{url('backend/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li >
          <a href="{{url('backend/category')}}">
            <i class="fa fa-clone"></i> <span>Category</span>
          </a>
        </li>
      </ul>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>