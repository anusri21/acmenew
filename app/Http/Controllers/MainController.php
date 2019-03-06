<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use DB;
use Response;
use Mail;
use Session;
use Validator;
use Hash;
use Auth;

class MainController extends Controller
{
    public function __construct()
    {
        $this->course = new Course();
        $this->middleware('auth');
    }

    public function home()
    {
       
        return view('backend.pages.login');
    }
    public function admindashboard()
    {
        $categorycount = DB::table('acme-pdfcatgeory')->count();
        $pdfcount = DB::table('acme_commoncore')->where('status',1)->count();
        //$enquirycount = DB::table('acme-enquiry')->where('status',1)->count();

        return view('backend.pages.dashboard')->with('categorycount',$categorycount)->with('pdfcount',$pdfcount);
        
    }
    public function createstudent()
    {
        $coursers = DB::table('acme-course')->get();

        return view('backend.pages.createstudent')->with('course',$coursers);
    }
    public function studentdetails()
    {
        $studentrs = DB::table('acme-student')->where('status',1)->get();
        //dd($studentrs);
        return view('backend.pages.studentdetails')->with('studentrs',$studentrs);
    }
    public function editstudent($id)
    {
        $studentrs = DB::table('acme-student')->where('id',$id)->first();
        $coursers = DB::table('acme-course')->get();
        $coursedetail = DB::table('student_course')
                    ->select('student_course.*','batch_schedule.batch_name','batch_schedule.start_time',
                             'batch_schedule.end_time','acme-course.coursename')
                    ->join('batch_schedule','batch_schedule.id','=','student_course.course_batch')
                    ->join('acme-course','acme-course.id','=','student_course.course_id')
                    ->where('student_course.student_id',$id)
                    ->first();
               
       
        return view('backend.pages.editstudent')->with('studentrs',$studentrs)->with('course',$coursers)
               ->with('coursedetail',$coursedetail);
    }

    public function deletestudent($id)
    {
        //dd($id);
        $student = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatestudent=DB::table('acme-student')->where('id', $id)->update($student);

        if($updatestudent){
            
            return redirect('backend/studentdetails');
        }
        else{
            return redirect('backend/studentdetails');
        }
    }
    public function viewstudent($id)
    {
        //dd($id);
        $studentrs = DB::table('acme-student')->where('id',$id)->first();
        // $coursers = DB::table('student_lines')->where('student_id',$id)->get();
        $coursers = DB::table('student_course')
                    ->select('student_course.*','acme-course.coursename','batch_schedule.batch_name','batch_schedule.id as batchid',
                            'batch_schedule.start_time','batch_schedule.end_time','acme-student.firstname as studentname')
                    ->join('acme-course','acme-course.id','=','student_course.course_id')
                    ->join('batch_schedule','batch_schedule.id','=','student_course.course_batch')
                    ->join('acme-student','acme-student.id','=','student_course.student_id')
                    ->where('student_course.student_id',$id)
                    ->get();
        //dd($coursers);
        return view('backend.pages.viewstudent')->with('studentrs',$studentrs)->with('coursers',$coursers);
    }
    public function addcourse()
    {
        $category = DB::table('course_category')->get();
        //dd($coursers);
        return view('backend.pages.addcourse')->with('category',$category);
    }
    public function courselist()
    {
        $coursers = DB::table('acme-course')->where('status',1)->get();
        //dd($coursers);
        return view('backend.pages.courselist')->with('coursers',$coursers);
    }
    public function viewcourse($id)
    {
        //dd($id);
        $coursers = DB::table('acme-course')->where('id',$id)->first();
        //dd($studentrs);
        return view('backend.pages.viewcourse')->with('coursers',$coursers);
    }
    public function deletecourse($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('acme-course')->where('id', $id)->update($course);

        if($updatecourse){
            
            return redirect('backend/courselist ');
        }
        else{
            return redirect('backend/courselist');
        }
    }
    public function editcourse($id)
    {
        $coursers = DB::table('acme-course')->where('id',$id)->first();
        $category = DB::table('course_category')->get();

        return view('backend.pages.editcourse')->with('coursers',$coursers)->with('category',$category);
    }
    public function addenquiry()
    {
        $coursers = DB::table('acme-course')->get();
      
        return view('backend.pages.addenquiry')->with('course',$coursers);
    }
    public function enquirylist()
    {
        $enquiryrs = DB::table('acme-enquiry')->where('status',1)->get();
        return view('backend.pages.enquirylist')->with('enquiryrs',$enquiryrs);
    }
    public function viewenquiry($id)
    {
        //dd($id);
        $enquiryrs = DB::table('acme-enquiry')->where('id',$id)->first();
        //dd($studentrs);
        return view('backend.pages.viewenquiry')->with('enquiryrs',$enquiryrs);
    }
    public function deleteenquiry($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('acme-enquiry')->where('id', $id)->update($course);

        if($updatecourse){
            
            return redirect('backend/enquirylist ');
        }
        else{
            return redirect('backend/enquirylist');
        }
    }
    public function editenquiry($id)
    {
        $enquiryrs = DB::table('acme-enquiry')->where('id',$id)->first();
        $coursers = DB::table('acme-course')->get();
        return view('backend.pages.editenquiry')->with('enquiryrs',$enquiryrs)->with('course',$coursers);
    }
    public function addpaymentdetail()
    {
        //$enquiryrs = DB::table('acme-enquiry')->where('id',$id)->first();
        //dd($studentrs);
        return view('backend.pages.addpaymentdetail');
    }
    public function categoryselect($id)
    {
      //dd($id);
      if($id=="staff"){
       $category = DB::table('acme-staff')
       ->select('acme-staff.*')
    //    ->join('tbl_category','tbl_category.id','=','tbl_subcategory.category_id')
    //    ->where('tbl_subcategory.category_id',$id)
       //->pluck("tbl_subcategory","id")->all();
      ->get();
      }if($id=="student"){
        $category = DB::table('acme-student')
        ->select('acme-student.*')
        // ->join('tbl_category','tbl_category.id','=','tbl_subcategory.category_id')
        // ->where('tbl_subcategory.category_id',$id)
        //->pluck("tbl_subcategory","id")->all();
       ->get();
      }
     //dd($category);
       $data = view('backend.pages.select',compact('category'))->render();
       return response()->json(['category'=>$data]);
    }
    public function paymentdetaillist()
    {
        $payrs = DB::table('acme-paymentdetails')
        ->select('acme-paymentdetails.*')
        ->where('status',1)
        ->get();
        //dd($payrs);
        return view('backend.pages.paymentdetaillist')->with('payrs',$payrs);
    }
    public function editpayment($id)
    {
        $payrs = DB::table('acme-paymentdetails')->where('id',$id)->first();
        //dd($studentrs);
        return view('backend.pages.editpayment')->with('payrs',$payrs);
    }
    public function deletepaymentdetail($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('acme-paymentdetails')->where('id', $id)->update($course);

        if($updatecourse){
            
            return redirect('backend/paymentdetaillist ');
        }
        else{
            return redirect('backend/paymentdetaillist');
        }
    }
    public function viewpayment($id)
    {
        //dd($id);
        $paymentrs = DB::table('acme-paymentdetails')->where('id',$id)->first();
        //dd($studentrs);
        return view('backend.pages.viewpayment')->with('paymentrs',$paymentrs);
    }
    public function addcoursecategory()
    {
        $course = DB::table('course_category')->where('status',1)->get();
        return view('backend.pages.addcoursecategory')->with('course',$course);
    }
    public function editcoursecategory($id)
    {
       
        $course = DB::table('course_category')->where('id',$id)->first();
      // dd($course);
        if ($course) {
            return Response::json([
                'status' => 1,
                'data'   => $course,
            ], 200);} else {
            return Response::json([
                'status'  => 0,
                'message' => 'course not found',
            ], 400);
        }
    }
    public function deletcoursecategory($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('course_category')->where('id', $id)->update($course); 
        return redirect('backend/addcoursecategory ');
       
    }

    public function email()
    {
       
        return view('backend.pages.email');
    }
    public function postEmail(Request $request)
    {
        //dd($request->all());
       $data=[
           'email'=>$request->email,
           'subject'=>$request->subject,
           'message'=>$request->message,
       ];
       Mail::send('emails.name',$data,function($message) use ($data){
       $message->from('anusrimariyappan@gmail.com','Test Email');
       $message->to($data['email']);
       $message->subject($data['subject']);
       });
        $data = Session::flash('success', 'Your email has been sent successfully!');
        return redirect('backend/email')->with(['data', $data], ['success', $data]);
     
        
    }

    public function addschedule()
    {
        $cid=request()->segment(3);
        //dd($cid);
        $course = DB::table('batch_schedule')
                ->select('batch_schedule.*','acme-course.coursename')
                ->join('acme-course','acme-course.id','=','batch_schedule.course_id')
                ->where('course_id',$cid)
                ->where('batch_schedule.status',1)
                ->get();
        //dd($course);
        return view('backend.pages.addschedule')->with('course',$course);
    }
    public function editschedule($id)
    {
      //dd($id);
        $course = DB::table('batch_schedule')
                ->select('batch_schedule.*','acme-course.coursename')
                ->join('acme-course','acme-course.id','=','batch_schedule.course_id')
                ->where('batch_schedule.id',$id)
                ->first();
            //dd($course);
        return Response::json([
            'status' => 1,
            'course' => $course
        ]);
    }
    public function deletschedule($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('batch_schedule')->where('id', $id)->update($course); 
        return Response::json([
            'status' => 1,
            'schedule' => $updatecourse
        ]);
       
    }
    public function coursedetails($id)
    {
       $course = DB::table('student_lines')->where('student_id',$id)->get();
       //dd($course);
        $c_name=array();
        $arr=array();
        $batch=array();
       foreach ($course as $key => $value)
       {
          
        $namecourse=$value->course_name;
        $c_id=$value->course_id;
        $batchrs=DB::table('batch_schedule')->where('course_id',$c_id)->first();
        //dd($batchrs);
        $c_name['course']=$namecourse;
        $c_name['id']=$c_id;
        $arr[]=$c_name;
        $batch[]=$batchrs;
       }
       //dd($batch);
      $coursename= implode(",",$c_name);
     // dd($coursename);
        return view('backend.pages.coursedetails')->with('course',$course)->with('coursename',$coursename)
              ->with('arr',$arr)->with('batch',$batch);
    }
    public function studentcourse()
    {
        $course = DB::table('student_course')
                  ->select('student_course.*','acme-course.coursename','batch_schedule.batch_name',
                           'batch_schedule.start_time','batch_schedule.end_time','acme-student.firstname as studentname')
                  ->join('acme-course','acme-course.id','=','student_course.course_id')
                  ->join('batch_schedule','batch_schedule.id','=','student_course.course_batch')
                  ->join('acme-student','acme-student.id','=','student_course.student_id')
                  ->where('student_course.status',1)
                  ->get();
                //dd($course);
        return view('backend.pages.studentcourse')->with('coursers',$course);
    }
    public function editstudentcourse($id)
    {
        $course = DB::table('student_course')
                  ->select('student_course.*','acme-course.coursename','batch_schedule.batch_name','batch_schedule.id as batchid',
                           'batch_schedule.start_time','batch_schedule.end_time','acme-student.firstname as studentname')
                  ->join('acme-course','acme-course.id','=','student_course.course_id')
                  ->join('batch_schedule','batch_schedule.id','=','student_course.course_batch')
                  ->join('acme-student','acme-student.id','=','student_course.student_id')
                  ->where('student_course.id',$id)
                  ->first();
                  //dd($course);
         $batch = DB::table('batch_schedule')->where('course_id',$id)->get();
         //dd($batch);
        return view('backend.pages.editstudentcourse')->with('coursers',$course)->with('batch',$batch);
    }
    public function viewstudentcourse($id)
    {
        $course = DB::table('student_course')
                  ->select('student_course.*','acme-course.coursename','batch_schedule.batch_name','batch_schedule.id as batchid',
                           'batch_schedule.start_time','batch_schedule.end_time','acme-student.firstname as studentname')
                  ->join('acme-course','acme-course.id','=','student_course.course_id')
                  ->join('batch_schedule','batch_schedule.id','=','student_course.course_batch')
                  ->join('acme-student','acme-student.id','=','student_course.student_id')
                  ->where('student_course.id',$id)
                  ->first();
                  //dd($course);
         
        return view('backend.pages.viewstudentcourse')->with('coursers',$course);
    }
    public function deletestudentcourse($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('student_course')->where('id', $id)->update($course); 
        return redirect('backend/studentcourse ');
       
    }
    public function category()
    {
        $searchterm = @$_GET['sterm'];
        $searchsource = @$_GET['source'];
        //echo $searchsource;
        if($searchsource&&$searchterm){
            
            //$pdfcat = DB::table('acme_commoncore')->whereIn('sub_category',[$searchsource,$searchterm])->orderBy('id', 'DESC')->get();
            $pdfcat = DB::table('acme_commoncore')->where('sub_category',$searchterm)->where('source',$searchsource)->orderBy('id', 'DESC')->get();
           
        }
        elseif($searchterm){
           
            $pdfcat = DB::table('acme_commoncore')->where('sub_category',$searchterm)->orderBy('id', 'DESC')->get();
            
        }
        elseif($searchsource){
            
            $pdfcat = DB::table('acme_commoncore')->where('sub_category',$searchsource)->orderBy('id', 'DESC')->get();
        }
        else{
            $pdfcat = '';
        }
      
       
         $category = DB::table('acme-pdfcatgeory')->get();
        
        return view('backend.pages.category')->with('pdfcat',$pdfcat)->with('category',$category)->with('item',$searchterm);
    }

    public function getcategory($id)
    {
        $images = DB::table('acme-pdfcatgeory')
                  ->where('id',$id)->get();
        //dd($images);
        if($images){
            return Response::json([
                'status' => 1,
                'images' => $images,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }
    }
    public function addpdfcategory()
    {
        $category = DB::table('acme-pdfcatgeory')->get();
        return view('backend.pages.addpdfcategory')->with('category',$category);
    }
    public function addpdf()
    {
        $category = DB::table('acme-pdfcatgeory')->get();
        $source = DB::table('acme_pdf_source')->where('status',1)->get();
        return view('backend.pages.addpdf')->with('category',$category)->with('source',$source);
    }
    public function viewpdf($id)
    {
        $pdf = DB::table('acme-pdf')->where('id',$id)->first();
        //dd($pdf);
        return view('backend.pages.viewpdf')->with('pdf',$pdf);
    }
    public function adduser()
    {
        
        return view('backend.pages.adduser');
    }
    public function saveuser(Request $request)
    {
        $data=$request->all();
      
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'role_id' => isset($data['role_id']) ? $data['role_id'] : '',  
                'name' => isset($data['name']) ? $data['name'] : '',  
                'mobile' => isset($data['mobile']) ? $data['mobile'] : '',  
                'email' => isset($data['email']) ? $data['email'] : '',  
                'password' => isset($data['password']) ? $data['password'] : '',  

                

            ];
           
            $verifyuser = DB::table('users')->where('email',$input['email'])->first();

            if($verifyuser=='')
            {

            $rules = array(
                'role_id' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $input['id'],
                    'role_id'=>$input['role_id'], 
                    'name'=>$input['name'], 
                    'email'=>$input['email'], 
                    'mobile'=>$input['mobile'], 
                    'password'=>Hash::make($input['password']), 
                    
                );
             
                $adduser = $this->course->saveuser($dataInput);
              
               if ($adduser) {

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'User was successfully Added!');

                    return redirect('backend/adduser');
                } else {
                    return redirect('backend/adduser');
                }
            }
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'User Already Exist!');

                return redirect('backend/adduser');
        }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }
    public function userlist()
    {
        $userlist = DB::table('users')
                   ->select('users.*','roles.name as role')
                   ->join('roles','roles.id','=','users.role_id')
                   ->where('users.status',1)
                   ->where('users.role_id',2)
                   ->get();
        return view('backend.pages.userlist')->with('userlist',$userlist);
    }
    public function deleteuser($id)
    {
        //dd($id);
        $user = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updateuser=DB::table('users')->where('id', $id)->update($user);

        if($updateuser){
            
            return redirect('backend/userlist');
        }
        else{
            return redirect('backend/userlist');
        }
    }
    public function edituser($id)
    {
        //$role = DB::table('roles')->get();
        $user = DB::table('users')
                //    ->select('users.*','roles.name as role','roles.id as roleid')
                //    ->join('roles','roles.id','=','users.role_id')
                   ->where('id',$id)
                   ->first();
        return view('backend.pages.edituser')->with('user',$user);
    }
public function pdflist()
    {
        $category = DB::table('acme-pdfcatgeory')->get();

        $pdfrs = DB::table('acme_commoncore')
                // ->select('acme_commoncore.*','acme-pdfcatgeory.id as pdfcatid','acme-pdfcatgeory.category')
                // ->join('acme-pdfcatgeory','acme-pdfcatgeory.id','=','acme-pdf.pdf_category')
                ->where('status',1)
                ->orderby('id','DESC')
                ->get();
        return view('backend.pages.pdflist')->with('pdfrs',$pdfrs)->with('category',$category);
    }
    

    


    public function editpdf($id)
    {
        $pdfrs = DB::table('acme_commoncore')
                // ->select('acme-pdf.*','acme-pdfcatgeory.id as pdfcatid','acme-pdfcatgeory.category')
                // ->join('acme-pdfcatgeory','acme-pdfcatgeory.id','=','acme-pdf.pdf_category')
                ->where('id',$id)
                ->first();
        //dd($pdfrs);
        if($pdfrs){
            return Response::json([
                'status' => 1,
                'pdf' => $pdfrs,
                    ], 200);
        }else{
            return Response::json([
                'status' => 1,
                'message' => 'Not Selected'
                    ], 200);
        }

    }
    public function deletepdf($id)
    {
        //dd($id);
        $course = array(
           
            'status'=>0,
            //'updated_at' => date("Y-m-d H:i:s")
        );
        $updatecourse=DB::table('acme_commoncore')->where('id', $id)->update($course); 
        return redirect('backend/pdflist ');
       
    }
    public function updateuser(Request $request)
    {
        $data=$request->all();
      
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'role_id' => isset($data['role_id']) ? $data['role_id'] : '',  
                'name' => isset($data['name']) ? $data['name'] : '',  
                'mobile' => isset($data['mobile']) ? $data['mobile'] : '',  
                'email' => isset($data['email']) ? $data['email'] : '',  
                //'password' => isset($data['password']) ? $data['password'] : '',  

                

            ];

            $rules = array(
                'role_id' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $input['id'],
                    'role_id'=>$input['role_id'], 
                    'name'=>$input['name'], 
                    'email'=>$input['email'], 
                    'mobile'=>$input['mobile'],  
                    
                );
             
                $adduser = $this->course->saveuser($dataInput);
              
               if ($adduser) {

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'User was successfully Updated!');

                    return redirect('backend/adduser');
                } else {
                    return redirect('backend/adduser');
                }
            }
        
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function profile()
    {
        $uid = Auth::id();
        $userrs = DB::table('users')->where('id',$uid)->first();
        //dd($userrs);
        return view('backend.pages.profile')->with('userrs',$userrs);
    }
    public function editprof($id)
    {
        //$uid = Auth::id();
        $user = DB::table('users')->where('id',$id)->first();
        if($user){
            return Response::json([
                'status' => 1,
                'user' => $user,
                    ], 200);
        }else{
            return Response::json([
                'status' => 1,
                'message' => 'Not Selected'
                    ], 200);
        }
    }
    public function editprofile(Request $request)
    {
        $data=$request->all();
      
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                //'role_id' => isset($data['role_id']) ? $data['role_id'] : '',  
                'name' => isset($data['name']) ? $data['name'] : '',  
                'mobile' => isset($data['mobile']) ? $data['mobile'] : '',  
                'email' => isset($data['email']) ? $data['email'] : '',  
                //'password' => isset($data['password']) ? $data['password'] : '',  

                

            ];

            $rules = array(
                'name' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $input['id'],
                    //'role_id'=>$input['role_id'], 
                    'name'=>$input['name'], 
                    'email'=>$input['email'], 
                    'mobile'=>$input['mobile'],  
                    
                );
             
                $adduser = $this->course->saveuser($dataInput);
              
               if ($adduser) {

                // $request->session()->flash('message.level', 'success');
                // $request->session()->flash('message.content', 'User was successfully Updated!');

                    return redirect('backend/profile');
                } else {
                    return redirect('backend/adduser');
                }
            }
        
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function changepwd()
    {
        return view('backend.pages.changepwd');
    }

    public function updatepwd(Request $request)
    {
        $data=$request->all();
      
        $uid = Auth::id();

        if ($data != null) {

            $input = [
                'cpass' => isset($data['cpass']) ? $data['cpass'] : '',  
                'npass' => isset($data['npass']) ? $data['npass'] : '',  
            ];

            $oldpass =Hash::make($input['cpass']);
            echo "$oldpass";
            $verifypwd = DB::table('users')->where('id',$uid)->first();
            dd($verifypwd->password);
            $rules = array(
                'npass' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $uid,
                    //'role_id'=>$input['role_id'], 
                    'password'=>$input['npass'], 
                    'updated_at' => date("Y-m-d H:i:s")
                    
                );
             
                $adduser = $this->course->saveuser($dataInput);
              
               if ($adduser) {

                // $request->session()->flash('message.level', 'success');
                // $request->session()->flash('message.content', 'User was successfully Updated!');

                    return redirect('backend/profile');
                } else {
                    return redirect('backend/adduser');
                }
            }
        
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }

    public function pdfsource()
    {
       $source=DB::table('acme_pdf_source')->where('status',1)->get();
        return view('backend.pages.pdfsource')->with('source',$source);
    }

    public function addpdfsource(Request $request)
    {
        $data=$request->all();
      
        $uid = Auth::id();

        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'title' => isset($data['title']) ? $data['title'] : '',  
                'web_url' => isset($data['web_url']) ? $data['web_url'] : '',  
            ];

            $rules = array(
                'title' => 'required',
    
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
              
                $dataInput = array(
                    'id' => $input['id'],
                    'title'=>$input['title'], 
                    'web_url'=>$input['web_url'], 
                    
                );
             
                $addpdfsource = $this->course->savepdfsource($dataInput);
              
               if ($addpdfsource) {

                // $request->session()->flash('message.level', 'success');
                // $request->session()->flash('message.content', 'User was successfully Updated!');

                    return redirect('backend/pdfsource');
                } else {
                    return redirect('backend/adduser');
                }
            }
        
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
        
    }
    public function getpdfsource($id)
    {
        //$uid = Auth::id();
        $pdf = DB::table('acme_pdf_source')->where('id',$id)->first();
        //dd($pdf);
        if($pdf){
            return Response::json([
                'status' => 1,
                'pdf' => $pdf,
                    ], 200);
        }else{
            return Response::json([
                'status' => 1,
                'message' => 'Not Selected'
                    ], 200);
        }
    }
    public function deletepdfsource($id)
    {
        //dd($id);
        $pdf = array(
           
            'status'=>0,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updatepdf=DB::table('acme_pdf_source')->where('id', $id)->update($pdf); 
        return redirect('backend/pdfsource ');
       
    }
}
