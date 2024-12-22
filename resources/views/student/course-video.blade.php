<!DOCTYPE html>
<html lang="en">

@include('student.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> --}}
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
                            <div class="card-body">
                                @if($course_videos->count() != 0)

                                <div class="container d-flex justify-content-center mb-10">
                                <iframe id="video" width="1100" height="415" src="{{$course_videos[0]['video_url']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            @endif

                            <br>
<br>
<h3>You have Completed this course</h3>
<div class="progress" style="height: 9px; margin-bottom: 10px;">
    <div
    id="progress-bar"
        class="progress-bar bg-info progress-bar-striped"
        aria-valuenow="{{ $progress_percentage }}"
        aria-valuemin="0"
        aria-valuemax="100"
        style="width: {{ $progress_percentage }}%;"
        role="progressbar">
        <span class="sr-only">{{ $progress_percentage }}% Complete</span>
    </div>
</div>

<br>
<br>
                            <div class="container d-flex justify-content-center mb-10">
                                <div id="accordion-one" class="accordion">
                                    <div class="row">
                                        @foreach ($course_videos as $index => $course_video)
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0" data-toggle="collapse" data-target="#{{$course_video->video_id}}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapseOne">
                                                        <i class="fa" aria-hidden="true"></i> {{$course_video->video_name}}
                                                    </h5>
                                                </div>
                                                <div id="{{$course_video->video_id}}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-parent="#accordion-one">
                                                    <div class="card-body">
                                                        {{$course_video->video_description}}
                                                        <br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary btn-rounded gradient-3 wacth-now" data-video_url=" {{$course_video->video_url}}" data-video_id="{{$course_video->video_id}}">Watch Now <i class="fa-solid fa-circle-play fa-bounce"></i></button>
                                                      &nbsp;  <a href="{{route('download-pdf',$course_video->video_id)}}" class="btn btn-warning btn-rounded gradient-5" data-video_url=" {{$course_video->video_url}}" data-video_id="{{$course_video->video_id}}">Download pdf <i class="fa-solid fa-download fa-beat"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                        {{-- <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa" aria-hidden="true"></i> Accordion Header Two</h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion-one">
                                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>



                                </div>
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
        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


        <script>
            $(document).ready(function() {
                $('.wacth-now').click(function() {
                    var video_url = $(this).data('video_url');
                    var video_id = $(this).data('video_id');

                    $.ajax({
                        url: '{{ url('completed-course') }}/' +video_id,
                        type: 'POST',
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.progress_percentage !== undefined) {
                // Update the progress bar dynamically
                const progressBar = document.getElementById("progress-bar");
                progressBar.style.width = response.progress_percentage + "%";
                progressBar.setAttribute("aria-valuenow", response.progress_percentage);
            }
                            $('#video').attr('src', video_url);

                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });


                });
            });
        </script>

</body>


</html>
