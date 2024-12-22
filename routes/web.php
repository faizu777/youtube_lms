<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_con;
use App\Http\Controllers\Index_con;
use App\Http\Controllers\student_con;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(Index_con::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact-us', 'contact_us')->name('contact_us');
    Route::post('/student-registration', 'student_registration')->name('student_registration');
    Route::post('/student-login', 'student_login')->name('student_login');
    Route::get('/course-detail/{id}', 'course_detail')->name('course_detail');

    Route::get('/payment-details/{course_id}', 'payment_details')->name('payment_details');
    Route::post('/payment-success', 'payment_success')->name('payment_success');
});

Route::controller(student_con::class)->group(function () {
    Route::middleware(['student_login'])->group(function () {
        Route::get('/student-logout', 'student_logout')->name('student-logout');
        Route::get('/student-dashboard', 'student_dashboard')->name('student-dashboard');
        Route::get('/student-course', 'student_course')->name('student-course');
        Route::get('/my-course', 'my_course')->name('my-course');
        Route::get('/watch-now/{course_id}', 'course_video')->name('watch-now');
        Route::post('/completed-course/{video_id}', 'completed_course')->name('completed-course');

        Route::get('/download-pdf/{video_id}', 'download_pdf')->name('download-pdf');

        //Course Test Routes
        Route::get('/test/{course_id}', 'test')->name('test');
        Route::post('/test-submit', 'test_submit')->name('test-submit');
        //Result Routes
        Route::get('/result', 'result')->name('result');
        Route::get('/download-certificate/{course_id}', 'download_certificate')->name('download-certificate');
        Route::get('/downloading-certificate/{course_id}', 'downloading_certificate')->name('downloading-certificate');

        //Complain Routes
        Route::get('/support', 'support')->name('support');
        Route::post('/complain-submit', 'complain_submit')->name('complain-submit');

        //Save Resume Routes
        Route::post('/save-resume', 'save_resume')->name('save-resume');
        Route::get('/resume', 'resume')->name('resume');
        Route::get('/get-resume','get_resume')->name('get-resume');
    });
});

Route::controller(Admin_con::class)->group(function () {
    Route::get('/admin-login', 'index')->name('admin.index');
    Route::post('/login', 'login')->name('admin.login');

    Route::middleware(['admin_login'])->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/logout', 'logout')->name('admin.logout');

        //Course Routes
        Route::get('/course', 'course')->name('course');
        Route::post('/add-course', 'add_course')->name('add-course');
        Route::post('/edit-course', 'edit_course')->name('edit-course');
        Route::get('/delete-course/{id}', 'delete_course')->name('delete-course');
        Route::get('/status-course/{id}', 'status_course')->name('status-course');

        //Course Video Routes
        Route::get('/course-video', 'course_video')->name('course_video');
        Route::post('/add-course-video', 'add_course_video')->name('add-course-video');
        Route::post('/edit-course-video', 'edit_course_video')->name('edit-course-video');
        Route::get('/delete-course-video/{id}', 'delete_course_video')->name('delete-course-video');
        Route::get('/status-course-video/{id}', 'status_course_video')->name('status-course-video');

        //Book Routes
        Route::get('/book', 'book')->name('book');
        Route::post('/add-book', 'add_book')->name('add-book');
        Route::post('/edit-book', 'edit_book')->name('edit-book');
        Route::get('/delete-book/{id}', 'delete_book')->name('delete-book');

        //Student Routes
        Route::get('/student', 'student')->name('student');
        Route::get('/student-status/{id}', 'student_status')->name('student-status');
        Route::get('/delete-student/{id}', 'delete_student')->name('delete-student');

        //Course Purchase Routes
        Route::get('/get-student-course', 'student_purchase_course')->name('get-student-course');

        //Course Test Routes
        Route::get('/course-test', 'course_test')->name('course-test');
        Route::post('/add-question', 'add_question')->name('add-question');
        Route::post('/edit-question', 'edit_question')->name('edit-question');
        Route::get('/delete-question/{id}', 'delete_question')->name('delete-question');

        //Certificate
        Route::get('/certificate','certificate')->name('certificate');
        Route::post('/upload-certificate','upload_certificate')->name('upload-certificate');

        //Website Ads
        Route::get('/website-ads', 'website_ads')->name('website-ads');
        Route::post('/add-website-ad', 'add_website_ad')->name('add-website-ad');
        Route::post('/edit-website-ad', 'edit_website_ad')->name('edit-website-ad');
        Route::get('/delete-website-ad/{id}', 'delete_website_ad')->name('delete-website-ad');

        //
    });
});
