<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\course;
use App\Models\course_video;
use App\Models\student;
use App\Models\purchase_course;
use App\Models\course_test;
use App\Models\certificate;
use App\Models\websit_ad;
use Illuminate\Support\Facades\Cache;
use Exception;

class Admin_con extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin = admin::where('email', $request->email)->first();
        if ($admin) {
            if ($admin->password == $request->password) {
                session()->put('admin_id', $admin->admin_id);
                return redirect()->route('admin.dashboard');
            }
            return back()->with('error', 'Invalid email or password');
        }
        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.index')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    //***************************************Course Section Start**********************
    public function course()
    {
        $courses = course::get();
        return view('admin.course', compact('courses'));
    }

    public function add_course(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'course_price' => 'required|numeric',
                'course_image' => 'required',
                'short_description' => 'required',
                'long_description' => 'required',
            ]);
            $course = new course();
            $course->course_id = 'course' . time() . rand(1000, 9999);
            $course->name = $request->course_name;
            $course->price = $request->course_price;
            if ($request->hasFile('course_image')) {
                $image = $request->file('course_image');
                $path = 'course_images/';
                $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $course->course_image = $path . $imageName;
            }
            $course->short_description = $request->short_description;
            $course->long_description = $request->long_description;
            $course->save();
            return response()->json(['success' => 'Course added successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit_course(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'course_price' => 'required|numeric',
                'course_id' => 'required',
                'short_description' => 'required|max:110',
                'long_description' => 'required',
            ]);
            $course = course::where('course_id', $request->course_id)->first();
            if ($course) {
                $course->course_id = 'course' . time() . rand(1000, 9999);
                $course->name = $request->course_name;
                $course->price = $request->course_price;
                if ($request->hasFile('course_image')) {
                    $image = $request->file('course_image');
                    $path = 'course_images/';
                    $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path($path), $imageName);
                    $course->course_image = $path . $imageName;
                }
                $course->short_description = $request->short_description;
                $course->long_description = $request->long_description;
                $course->save();
                return back()->with('success', 'Course updated successfully');
            }
            return back()->with('error', 'Course not found');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function status_course($course_id)
    {
        $course = course::where('course_id', $course_id)->first();
        if ($course) {
            $course->is_active = $course->is_active == 1 ? 0 : 1;
            $course->save();
            return back()->with('success', 'Course status updated successfully');
        }
        return back()->with('error', 'Course not found');
    }

    public function delete_course($course_id)
    {
        $course = course::where('course_id', $course_id)->first();
        if ($course) {
            $course->is_deleted = 1;
            $course->save();
            return back()->with('success', 'Course deleted successfully');
        }
        return back()->with('error', 'Course not found');
    }

    //****************************************Course Section End *********************

    // Course Video Section Start

    public function course_video()
    {
        if(Cache::has('course_videos')){
            $course_videos = Cache::get('course_videos');
        }else{
        $course_videos = course_video::join('courses', 'course_videos.course_id', '=', 'courses.course_id')->select('course_videos.*', 'courses.name as name')->get();
        Cache::put('course_videos', $course_videos, now()->addDays(1));
    }
        return view('admin.course-video', compact('course_videos'));
    }
    public function convertShareToIframe($shareLink)
    {
        // Check if the link is already in embed format
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $shareLink, $embedMatches)) {
            // If it's already embedded, return as-is
            return $shareLink;
        }

        // Match YouTube shareable links (youtu.be/VIDEO_ID)
        preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $shareLink, $shareMatches);

        if (isset($shareMatches[1])) {
            // Extracted VIDEO_ID
            $videoId = $shareMatches[1];

            // Return the embed link
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // Match regular YouTube URLs (youtube.com/watch?v=VIDEO_ID)
        preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $shareLink, $fullMatches);

        if (isset($fullMatches[1])) {
            // Extracted VIDEO_ID
            $videoId = $fullMatches[1];

            // Return the embed link
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        return null; // Return null if the link is not recognized
    }

    public function add_course_video(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'video_title' => 'required',
                'video_url' => 'required',
                'video_pdf' => 'required',
                'video_description' => 'required',
            ]);
            $course_video = new course_video();
            $course_video->video_id = 'video' . time() . rand(1000, 9999);
            $course_video->course_id = $request->course_name;
            $course_video->video_name = $request->video_title;
            $course_video->video_url = $this->convertShareToIframe($request->video_url);
            if ($request->hasFile('video_pdf')) {
                $image = $request->file('video_pdf');
                $path = 'course_video_pdf/';
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $course_video->video_pdf = $path . $imageName;
            }
            $course_video->video_description = $request->video_description;
            $course_video->save();
            return back()->with('success', 'Course Video added successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit_course_video(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'video_title' => 'required',
                'video_url' => 'required',

                'video_description' => 'required',
                'video_id' => 'required',
            ]);
            $course_video = course_video::where('video_id', $request->video_id)->first();

            $course_video->course_id = $request->course_name;
            $course_video->video_name = $request->video_title;
            $course_video->video_url = $this->convertShareToIframe($request->video_url);
            if ($request->hasFile('video_pdf')) {
                $image = $request->file('video_pdf');
                $path = 'course_video_pdf/';
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $course_video->video_pdf = $path . $imageName;
            }
            $course_video->video_description = $request->video_description;
            $course_video->save();
            return back()->with('success', 'Course Video Updated successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete_course_video($video_id)
    {
        $course_video = course_video::where('video_id', $video_id)->first();
        if ($course_video) {
            $course_video->is_deleted = 1;
            $course_video->save();
            return back()->with('success', 'Course Video deleted successfully');
        }
        return back()->with('error', 'Course Video not found');
    }

    public function status_course_video($video_id)
    {
        $course_video = course_video::where('video_id', $video_id)->first();
        if ($course_video) {
            $course_video->is_active = $course_video->is_active == 1 ? 0 : 1;
            $course_video->save();
            return back()->with('success', 'Course Video status updated successfully');
        }
        return back()->with('error', 'Course Video not found');
    }

    public function manage_home()
    {
        return view('admin.manage-home');
    }

    public function update_home(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required',
            ]);
            $home = manage_home::where('id', 1)->first();
            $home->content = $request->content;
            if ($request->hasFile('img1')) {
                $image = $request->file('img1');
                $image_name = time() . '_home_image1.' . $image->getClientOriginalExtension();
                $image_path = '/home_images/img1';
                $image->move(public_path($image_path), $image_name);
                $home->img1 = $image_path . '/' . $image_name;
            }
            if ($request->hasFile('img2')) {
                $image = $request->file('img2');
                $image_name = time() . '_home_image2.' . $image->getClientOriginalExtension();
                $image_path = '/home_images/img2';
                $image->move(public_path($image_path), $image_name);
                $home->img2 = $image_path . '/' . $image_name;
            }
            $home->save();
            return back()->with('success', 'Home Updated Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    //Student Registration

    public function student()
    {
        $students = student::where('is_deleted', 0)->get();
        return view('admin.students', compact('students'));
    }
    public function student_status($std_id)
    {
        $students = student::where('is_deleted', 0)->where('std_id', $std_id)->first();
        if ($students) {
            $students->is_active = $students->is_active == 1 ? 0 : 1;
            $students->save();
            return back()->with('success', 'Student status updated successfully');
        }
        return back()->with('error', 'Student not found');
    }

    public function delete_student($std_id)
    {
        $students = student::where('is_deleted', 0)->where('std_id', $std_id)->first();
        if ($students) {
            $students->is_deleted = 1;
            $students->save();
            return back()->with('success', 'Student deleted successfully');
        }
        return back()->with('error', 'Student not found');
    }

    public function student_purchase_course()
    {
        $courses = purchase_course::join('students', 'students.std_id', 'purchase_courses.student_id')->join('courses', 'courses.course_id', 'purchase_courses.course_id')->select('purchase_courses.*', 'courses.name as course_name', 'students.name as name', 'students.email as email', 'students.phone as phone')->get();

        return view('admin.purchase-course', compact('courses'));
    }

    public function course_test(Request $request)
    {
        if ($request->has('course_id')) {
            $course_tests = course_test::join('courses', 'course_tests.course_id', 'courses.course_id')
                ->where('course_tests.course_id', $request->course_id)
                ->select('course_tests.*', 'courses.name as course_name')
                ->get();
            return view('admin.course-test', compact('course_tests'));
        }
        $course_tests = course_test::join('courses', 'course_tests.course_id', 'courses.course_id')->select('course_tests.*', 'courses.name as course_name')->get();
        return view('admin.course-test', compact('course_tests'));
    }

    public function add_question(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'question' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'option4' => 'required',
                'marks' => 'required',
                'answer' => 'required',
                'time_duration' => 'required',
            ]);

            $course_test = new course_test();
            $course_test->test_id = 'test' . time() . rand(1000, 9999);
            $course_test->question_id = 'question' . time() . rand(1000, 9999);
            $course_test->course_id = $request->course_name;
            $course_test->question = $request->question;
            $course_test->option1 = $request->option1;
            $course_test->option2 = $request->option2;
            $course_test->option3 = $request->option3;
            $course_test->option4 = $request->option4;
            $course_test->marks = $request->marks;
            $course_test->answer = $request->answer;
            $course_test->time_duration = $request->time_duration;
            $course_test->save();
            return back()->with('success', 'Course Test added successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit_question(Request $request)
    {
        try {
            $request->validate([
                'course_name' => 'required',
                'question' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'option4' => 'required',
                'marks' => 'required',
                'answer' => 'required',
                'test_id' => 'required',
                'time_duration' => 'required',
            ]);

            $course_test = course_test::where('test_id', $request->test_id)->first();

            $course_test->course_id = $request->course_name;
            $course_test->question = $request->question;
            $course_test->option1 = $request->option1;
            $course_test->option2 = $request->option2;
            $course_test->option3 = $request->option3;
            $course_test->option4 = $request->option4;
            $course_test->marks = $request->marks;
            $course_test->answer = $request->answer;
            $course_test->time_duration = $request->time_duration;
            $course_test->save();
            return back()->with('success', 'Course Test Updated successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function certificate()
    {
        $certificate = certificate::where('is_active', 1)->where('id', 1)->first();
        return view('admin.upload-certificate', compact('certificate'));
    }

    public function upload_certificate(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required | mimes:jpeg,png,jpg',
            ]);
            $certificates = certificate::where('is_active', 1)->where('id', 1)->first();
            if ($certificates) {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $path = 'certificate_images/';
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path($path), $imageName);
                    $certificates->image = $path . $imageName;
                    $certificates->save();
                }
                return back()->with('success', 'Certificate uploaded successfully');
            }
            return back()->with('error', 'Certificate not found');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function website_ads()
    {
        $text_ads = websit_ad::where('type', 1)->get();
        $carousel_ads = websit_ad::where('type', 2)->get();
        $youtube_ads = websit_ad::where('type', 3)->get();

        return view('admin.website_ads', compact('text_ads', 'carousel_ads', 'youtube_ads'));
    }
    public function add_website_ad(Request $request)
    {
        try {
            $request->validate([
                'ads_type' => 'required',
            ]);
            $website_ad = new websit_ad();
            $website_ad->title = $request->title;
            if($request->hasFile('file')) {
                $image = $request->file('file');
                $path = 'website_ad_images/';
                $imageName =  rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $website_ad->image = $path . $imageName;
            }
            $website_ad->description = $request->video_description;
            $website_ad->type = $request->ads_type;
            if($request->has('link')) {
            $website_ad->link = $this->convertShareToIframe($request->link);
            }
            $website_ad->save();
            return back()->with('success', 'Website Ad added successfully');
            } catch (Exception $e) {
                return back()->with('error', $e->getMessage());
            }

        }

        public function delete_website_ad($id)
        {
            $website_ad = websit_ad::where('id', $id)->first();
            if($website_ad) {
                $website_ad->delete();
                return back()->with('success', 'Website Ad deleted successfully');
            }
            return back()->with('error', 'Website Ad not found');
        }
}
