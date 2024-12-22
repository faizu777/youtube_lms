<!DOCTYPE html>
<html lang="en">

@include('student.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .my-card {
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease, z-index 0.3s ease;
    z-index: 0;
}

.my-card:hover {
    transform: translateY(-10px); /* Moves the card upwards */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Adds a shadow effect */
    z-index: 10; /* Brings the card to the front */
}

</style>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('student.navbar')


        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('student.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">


            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Get Result</div>
                            </div>

                            <div class="card-body">
<div class="row">
    @php

@endphp
@foreach ($courses as $course)
<div class="col-xl-4 col-lg-4 col-md-6 mr-2 my-card" >
    <!-- Single course -->
    <div class="single-course mb-70">
        <div class="course-img">
            <img src="{{ asset($course->course_image) }}" alt="" style="height: 300px; width:100%; ">
        </div>
        <div class="course-caption">
            <div class="course-cap-top">
                <h4><a href="{{route('course_detail',$course->course_id )}}">{{ $course->name }}</a></h4>

            </div>
            <div class="course-cap-top">
                <h5> Only/ <i class="fa-solid fa-rupee-sign fa-beat"></i>&nbsp;<a href="#">{{ $course->price}}</a></h5>

            </div>

            @if ($course->get_certificate == 1)

                @if ($course->total_obtained_marks >= $course->total_marks/2)
                <div class="course-cap-mid d-flex justify-content-between">
                <h3 class="alert alert-success">Passed :{{$course->total_obtained_marks}}/{{$course->total_marks}}</h3>
                </div>
                <div class="course-cap-bottom d-flex justify-content-between">

                    <a href="{{route('download-certificate',$course->course_id )}}" class="btn btn-primary btn-rounded">Download Certificate<i class="fa-solid fa-award fa-beat-fade fa-xl"></i></a>



                </div>
                @else
                <div class="course-cap-bottom d-flex justify-content-between">
                <h4 class="alert alert-danger">Failed : {{$course->total_obtained_marks}} /{{$course->total_marks}}</h4>

            </div>
            <div class="course-cap-bottom d-flex justify-content-between">
                <a href="{{route('test',$course->course_id )}}" class="btn btn-primary btn-rounded">Take Test Again <i class="fa-solid fa-file-lines fa-shake"></i></a>
            </div>
                @endif




            @elseif($course->is_completed == 1)



            <div class="course-cap-bottom d-flex justify-content-between">

                <a href="{{route('test',$course->course_id )}}" class="btn btn-primary btn-rounded">Take Test <i class="fa-solid fa-file-lines fa-shake"></i></a>



            </div>
            @else
            <div class="course-cap-bottom d-flex justify-content-between">

                <a href="{{route('watch-now',$course->course_id )}}" class="btn btn-primary btn-rounded">Complete Now <i class="fa-solid fa-bars-progress fa-beat"></i></a>



            </div>
                @endif
        </div>
    </div>
</div>
@endforeach

</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        @include('student.footer')

        <script src="{{asset('./assets/js/main.js')}}"></script>


</body>




</html>
