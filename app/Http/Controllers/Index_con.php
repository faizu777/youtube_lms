<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\purchase_course;
use App\Models\student;
use App\Models\course_video;
use Exception;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class Index_con extends Controller
{
   public function index()
   {
       return view('index');
   }

   public function courses(Request $request)
   {
    if($request->has('Search'))

    {
        $courses = course::where('is_active', 1)->orderBy('id', 'desc')->where('name', 'like', '%'.$request->Search.'%')->get();
        return view('courses',compact('courses'));

    }
    if(Cache::has('courses'))
    {
        $courses = Cache::get('courses');
    }else{
        $courses = course::where('is_active', 1)->orderBy('id', 'desc')->get();
        Cache::put('courses', $courses, 60);
    }

       return view('courses',compact('courses'));
   }

public function about()
{
    return view('about');
}

public function contact_us()
{
    return view('contact');
}

public function student_registration( Request $request)
{
    try{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'password' => 'required',
        'confirm_password' => 'required',
    ]);
    if($request->password == $request->confirm_password) {
    $student = new student();
    $student->std_id = 'std'.time().rand(1000,9999);
    $student->name = $request->name;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->password = $request->password;
    $student->save();
    return back()->with('success', 'Student Registered Successfully');
    }
    return back()->with('error', 'Passwords do not match');
    }catch( Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}

public function student_login( Request $request)
{
    try{
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $student = student::where('email', $request->email)->where('is_deleted', 0)->where('is_active', 1)->first();
        if($student) {
            if($student->password == $request->password) {
                session()->put('std_id', $student->std_id);
                return back()->with('success', 'Login Successfully');
            }
            return back()->with('error', 'Invalid Credentials');
        }
        return back()->with('error', 'Invalid Credentials');
    }catch( Exception $e) {
        return back()->with('error', $e->getMessage());
}
}




public function course_detail($course_id)
{
    $course = course::where('course_id', $course_id)->first();
    if($course) {
        $course_videos =course_video::where('course_id',$course_id)->where('is_active',1)->select('video_name')->limit(10)->get();
        return view('course-details', compact('course','course_videos'));
    }
    return back()->with('error', 'Course not found');
}

// public function payment_details($course_id)
// {
//     if(session()->has('std_id') ) {
//     $course = course::where('course_id', $course_id)->first();
//     if($course) {
//         $student = student::where('std_id', session()->get('std_id'))->first();
//         $order_id = 'order_id'.time().rand(1000,9999);
//         return response()->json(['amount' => $course->price , 'course_id' => $course->course_id , 'user_name' => $student->name , 'user_email' => $student->email , 'user_contact' => $student->phone , 'order_id' => $order_id]);
//     }
//     return response()->json(['error' => 'Course not found'], 404);
// }


public function payment_details($course_id)
{
    if (session()->has('std_id')) {
        $already_purchased = purchase_course::where('course_id', $course_id)->where('student_id', session()->get('std_id'))->first();
        if(!$already_purchased) {
        $course = course::where('course_id', $course_id)->first();

        if ($course) {
            $student = student::where('std_id', session()->get('std_id'))->first();

            // Initialize Razorpay API
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // Prepare the order data
            $orderData = [
                'receipt' => 'receipt_' . time(),
                'amount' => $course->price * 100, // Amount in paise
                'currency' => 'INR',
                'payment_capture' => 1, // Auto-capture payment
            ];

            try {
                // Create Razorpay order
                $razorpayOrder = $api->order->create($orderData);

                // Return payment details with Razorpay order_id
                return response()->json([
                    'amount' => $course->price,
                    'course_id' => $course->course_id,
                    'user_name' => $student->name,
                    'user_email' => $student->email,
                    'user_contact' => $student->phone,
                    'order_id' => $razorpayOrder['id'], // Razorpay order_id
                    'currency' => $razorpayOrder['currency'],
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to create Razorpay order',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['error' => 'Course not found'], 404);
    }
    return response()->json(['error' => 'You have already purchased this course'], 404);
    }

    return response()->json(['error' => 'Student not authenticated'], 401);
}



public function payment_success(Request $request)
{
    // Razorpay API credentials
    $apiKey = env('RAZORPAY_KEY');
    $apiSecret = env('RAZORPAY_SECRET');

    // Initialize Razorpay API
    $api = new Api($apiKey, $apiSecret);

    try {
        // Validate payment ID
        $payment = $api->payment->fetch($request->payment_id);

        // Check if payment is successful
        if ($payment->status === 'captured') {
            // Fetch the order ID and course ID from the request
            $order_id = $request->order_id;
            $course_id = $request->course_id;

            $purchase_course = new  purchase_course();
            $purchase_course->order_id = $order_id;
            $purchase_course->course_id = $course_id;
            $purchase_course->student_id = session()->get('std_id');
            $purchase_course->price = $payment->amount;
            $purchase_course->payment_id = $request->payment_id;
            $purchase_course->date_time = Carbon::now();
            $purchase_course->save();



            // Perform any additional actions (e.g., granting course access)
            // Example: Enroll the user in the course
            // Enrollment::create([...]);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment verified and processed successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed.',
            ], 400);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred during payment verification.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}
