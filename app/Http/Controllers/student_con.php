<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use Illuminate\Support\Facades\DB;
use App\Models\purchase_course;
use App\Models\course_video;
use App\Models\completed_course;
use App\Models\course_test;
use App\Models\student_mark;
use App\Models\student;
use App\Models\certificate;
use App\Models\complain;
use Exception;
use PDF;
use Illuminate\support\facades\session;

class student_con extends Controller
{
    public function is_purchased($course_id)
    {
        $courses = course::where('is_active', 1)->orderBy('id', 'desc')->where('course_id', $course_id)->first();
        if ($courses) {
            $is_purchased = purchase_course::where('course_id', $course_id)->where('student_id', session()->get('std_id'))->first();
            if ($is_purchased) {
                return true;
            }
            return false;
        }
        return false;
    }
    public function student_dashboard()
    {
        return view('student.index');
    }

    public function student_logout()
    {
        session()->flush();
        return redirect()->route('index')->with('success', 'Logged out successfully');
    }

    public function student_course()
    {
        $courses = course::where('is_active', 1)->orderBy('id', 'desc')->get();
        $purchased_courses = purchase_course::where('student_id', session()->get('std_id'))->pluck('course_id')->toArray();

        foreach ($courses as $course) {
            // Check if the current course ID exists in the purchased courses array
            $course->is_able = in_array($course->course_id, $purchased_courses) ? 1 : 0;
        }

        return view('student.course', compact('courses'));
    }

    public function my_course()
    {
        $courses = course::join('purchase_courses', 'purchase_courses.course_id', '=', 'courses.course_id')->select('courses.*')->where('purchase_courses.student_id', session()->get('std_id'))->where('courses.is_active', 1)->get();
        foreach ($courses as $course) {
            $course_id = $course->course_id;
            $total_videos = course_video::where('course_id', $course_id)->where('is_active', 1)->count();
            $completed_videos = completed_course::where('course_id', $course_id)->where('student_id', session()->get('std_id'))->count();
            if ($total_videos == $completed_videos) {
                $course->is_completed = 1;
            } else {
                $course->is_completed = 0;
            }
        }

        return view('student.my-course', compact('courses'));
    }

    public function course_video($course_id)
    {
        if ($this->is_purchased($course_id)) {
            $course_videos = course_video::where('course_id', $course_id)->where('is_active', 1)->get();
            $total_videos = course_video::where('course_id', $course_id)->where('is_active', 1)->count();
            $completed_videos = completed_course::where('course_id', $course_id)->where('student_id', session()->get('std_id'))->count();
            $progress_percentage = $total_videos > 0 ? round(($completed_videos / $total_videos) * 100, 2) : 0;
            return view('student.course-video', compact('course_videos', 'progress_percentage'));
        }
        return back()->with('error', 'Course not found');
    }

    public function completed_course($video_id)
    {
        if (session()->has('std_id')) {
            $already_completed = completed_course::where('video_id', $video_id)->where('student_id', session()->get('std_id'))->first();
            if (!$already_completed) {
                $course_id = course_video::where('video_id', $video_id)->first()->course_id;
                $new_completed_course = new completed_course();
                $new_completed_course->video_id = $video_id;
                $new_completed_course->course_id = $course_id;

                $new_completed_course->student_id = session()->get('std_id');
                $new_completed_course->save();
                $total_videos = course_video::where('course_id', $course_id)->where('is_active', 1)->count();
                $completed_videos = completed_course::where('course_id', $course_id)->where('student_id', session()->get('std_id'))->count();
                $progress_percentage = $total_videos > 0 ? round(($completed_videos / $total_videos) * 100, 2) : 0;
                return response()->json(['success' => 'Course Completed Successfully', 'progress_percentage' => $progress_percentage]);
            }
            return response()->json(['success' => 'Course already completed']);
        }
        return response()->json(['error' => 'You are not logged in']);
    }

    public function download_pdf($video_id)
    {
        $course_video = course_video::where('video_id', $video_id)->where('is_active', 1)->first();
        if ($course_video) {
            $pdf_file = public_path($course_video->video_pdf);
            if (file_exists($pdf_file)) {
                return response()->download($pdf_file);
            }
            return back()->with('error', 'PDF not found');
        }
    }

    public function test($course_id)
    {
        if ($this->is_purchased($course_id)) {
            $questions = course_test::where('course_id', $course_id)->select('question_id', 'option1', 'option2', 'option3', 'option4', 'marks')->get();
            $total_marks = course_test::where('course_id', $course_id)->sum('marks');
            $total_duration = course_test::where('course_id', $course_id)->sum('time_duration');
            return view('student.test', compact('questions', 'total_marks', 'total_duration', 'course_id'));
        }
        return back()->with('error', 'Course not found');
    }
    //test submit
    public function test_submit(Request $request)
    {
        try {
            $request->validate([
                'course_id' => 'required',
                'questions' => 'required',
            ]);
            if ($this->is_purchased($request->course_id)) {
                $student_id = session()->get('std_id');
                $course_id = $request->course_id;
                $questions = $request->questions;
                DB::beginTransaction();
                $test_submitted = student_mark::where('student_id', session()->get('std_id'))->where('course_id', $course_id)->first();
                if ($test_submitted) {
                    foreach ($questions as $question) {
                        $remarks_save = student_mark::where('student_id', session()->get('std_id'))
                            ->where('course_id', $course_id)
                            ->where('question_id', $question['question_id'])
                            ->first();
                        if ($remarks_save) {
                            $remarks_save->answer = $question['answer'];
                            $remarks_save->save();
                        }
                    }
                } else {
                    foreach ($questions as $question) {
                        $student_mark = new student_mark();
                        $student_mark->student_id = $student_id;
                        $student_mark->course_id = $course_id;
                        $student_mark->question_id = $question['question_id'];
                        $student_mark->answer = $question['answer'];
                        $student_mark->save();
                    }
                }
                DB::commit();

                return back()->with('success', 'Test Submitted Successfully');
            }
            return back()->with('error', 'Course not found');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function result(Request $request)
    {
        $student_id = session()->get('std_id');
        $courses = course::join('purchase_courses', 'purchase_courses.course_id', '=', 'courses.course_id')->select('courses.*')->where('purchase_courses.student_id', $student_id)->where('courses.is_active', 1)->get();
        foreach ($courses as $course) {
            $total_obtained_marks = 0;
            $total_marks = 0;
            $course_id = $course->course_id;
            $total_videos = course_video::where('course_id', $course_id)->where('is_active', 1)->count();
            $student_marks = student_mark::where('course_id', $course_id)->where('student_id', $student_id)->get();
            if ($student_marks) {
                foreach ($student_marks as $student_mark) {
                    $question_id = $student_mark->question_id;
                    $answer = $student_mark->answer;
                    $questions = course_test::where('course_id', $course_id)->where('question_id', $question_id)->first();

                    if ($questions) {
                        if ($questions->answer == $answer) {
                            $total_obtained_marks += $questions->marks;
                        }
                    }
                    $total_marks += $questions->marks;
                }
                $course->get_certificate = 1;
                $course->total_marks = $total_marks;
                $course->total_obtained_marks = $total_obtained_marks;
            } else {
                $course->get_certificate = 0;
            }
            $completed_videos = completed_course::where('course_id', $course_id)->where('student_id', $student_id)->count();
            if ($total_videos == $completed_videos) {
                $course->is_completed = 1;
            } else {
                $course->is_completed = 0;
            }
        }

        return view('student.result', compact('courses'));
    }

    public function download_certificate($course_id)
    {
        $student_id = session()->get('std_id');
        if ($this->is_purchased($course_id)) {
            $student_marks = student_mark::where('course_id', $course_id)->where('student_id', $student_id)->get();
            if ($student_marks) {
                $total_obtained_marks = 0;
                $total_marks = 0;
                foreach ($student_marks as $student_mark) {
                    $question_id = $student_mark->question_id;
                    $answer = $student_mark->answer;
                    $questions = course_test::where('course_id', $course_id)->where('question_id', $question_id)->first();

                    if ($questions) {
                        if ($questions->answer == $answer) {
                            $total_obtained_marks += $questions->marks;
                        }
                    }
                    $total_marks += $questions->marks;
                }
                if($total_obtained_marks >= $total_marks/2)
                {
                    $course = course::where('course_id', $course_id)->where('is_active', 1)->select('course_id', 'name as course_name', 'price')->first();
                    $certificate = certificate::where('is_active', 1)->where('id', 1)->first();
                    $setudent = student::where('std_id', $student_id)->select('name')->first();

                    return view('student.download-certificate', compact('course', 'setudent' ,'certificate'));

                }
                return back()->with('error', 'Please take test again');


            }
            return back()->with('error', 'Certificate not found');

        }
        return back()->with('error', 'Certificate not found');
    }

    public function downloading_certificate($course_id)
    {
        $student_id = session()->get('std_id');

        // Check if the course is purchased
        if ($this->is_purchased($course_id)) {
            $student_marks = student_mark::where('course_id', $course_id)->where('student_id', $student_id)->get();

            if ($student_marks) {
                $total_obtained_marks = 0;
                $total_marks = 0;

                foreach ($student_marks as $student_mark) {
                    $question_id = $student_mark->question_id;
                    $answer = $student_mark->answer;

                    $question = course_test::where('course_id', $course_id)->where('question_id', $question_id)->first();

                    if ($question) {
                        if ($question->answer == $answer) {
                            $total_obtained_marks += $question->marks;
                        }
                        $total_marks += $question->marks;
                    }
                }

                // Check if the student passed the test
                if ($total_obtained_marks >= $total_marks / 2) {
                    $course = course::where('course_id', $course_id)
                        ->where('is_active', 1)
                        ->select('course_id', 'name as course_name', 'price')
                        ->first();

                    $certificate = certificate::where('is_active', 1)->where('id', 1)->first();
                    $setudent = student::where('std_id', $student_id)->select('name')->first();

                    // Prepare data for the PDF
                    $data = compact('course', 'setudent', 'certificate');

                    // Generate the PDF
                    $pdf = PDF::loadView('student.certificate', $data)->setPaper('a4', 'landscape');

                    // Return the PDF as a download
                    return $pdf->download('certificate_' . $setudent->name . '.pdf');
                }

                return back()->with('error', 'Please take the test again.');
            }

            return back()->with('error', 'No marks found for this course.');
        }

        return back()->with('error', 'You have not purchased this course.');
    }

    public function support()
    {
        if(session::has('std_id'))
        {
           $complains= complain::where('std_id',session::get('std_id'))->get();
            return view('student.std-complain',compact('complains'));

        }

        return back()->with('error','Please login first');

    }

    public function complain_submit(Request $request)
    {
        try{
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $complain = new complain();
        $complain->complain_id = 'COMPLAIN'.rand(1000,9999);
        $complain->std_id = session::get('std_id');
        $complain->title = $request->title;
        $complain->complain = $request->message;
        $complain->save();
        return back()->with('success','Complain Submitted Successfully');
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
            return back()->with('error',$e->getMessage());
        }
    }

    public function resume()
    {
        $student_id = session()->get('std_id');
        $student = student::where('std_id', $student_id)->first();
    $resume = $student->resume;

    return view('student.resume', compact('resume'));
    }

    public function save_resume(Request $request)
    {
        try{
        $request->validate([
            'resume' => 'required',
            ]);
        $student_id = session()->get('std_id');
        $student = student::where('std_id', $student_id)->first();
        $student->resume = $request->resume;
        $student->save();
        return redirect()->back()->with('success', 'Resume Saved Successfully');
        }
        catch(\Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }

    public function get_resume()
    {
        $student_id = session()->get('std_id');
        $student = student::where('std_id', $student_id)->first();
    $resume = $student->resume;

    return view('student.resume-view', compact('resume'));
    }
}
