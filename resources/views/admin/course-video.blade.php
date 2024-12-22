<!DOCTYPE html>
<html lang="en">

@include('admin.header')
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

        @include('admin.navbar')


        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('admin.sidebar')
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
                                <div class="card-title d-flex justify-content-between">
                                    <h4> <img src="{{ asset('/images/video.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Video Course List</h4>
                                    <button type="button" class="btn gradient-2 btn-rounded" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fa-solid fa-plus fa-beat-fade"></i> Add Video
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>Course Name</th>
                                                <th>Video title</th>

                                                <th>
                                                    Video Url
                                                </th>
                                                <th>Video Pdf</th>
                                                <th>Description</th>

                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($course_videos as $course_video)
                                                <tr>
                                                    <td>{{ $sn++ }}</td>

                                                    <td>{{ $course_video->name}}</td>
                                                    <td>{{ $course_video->video_name}}</td>
                                                    <td>{{ $course_video->video_url}}</td>
                                                    <td>
                                                        <a href="{{ $course_video->video_pdf }}" target="_blank" class="btn btn-warning btn-rounded">
                                                            <i class="fa-solid fa-file-pdf"></i>
                                                        </a>


                                                        </td>

                                                    <td>
                                                        <textarea name="" id="" cols="20" rows="3">{{ $course_video->video_description }}</textarea>
                                                    </td>

                                                    @if ( $course_video->is_active == 1)
                                                        <td>
                                                            <a href="{{ route('status-course-video', $course_video->video_id) }}" class="btn btn-success btn-rounded">
                                                                <i class="fa-solid fa-circle-check fa-flip"></i>
                                                            Active
                                                            </a>


                                                        </td>
                                                    @else
                                                        <td>  <a href="{{ route('status-course-video', $course_video->video_id) }}" class="btn btn-danger btn-rounded">
                                                            <i class="fa-solid fa-circle-xmark fa-fade"></i> Inactive
                                                        </a>
</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                                                        <a href="#" class="btn btn-primary btn-rounded edit-btn"
                                                            data-video_id = "{{ $course_video->video_id }}"
                                                            data-video_title="{{ $course_video->video_name }}"
                                                            data-course_id="{{ $course_video->course_id }}"
                                                         data-video_url = "{{ $course_video->video_url }}"
                                                         data-video_pdf = "{{ $course_video->video_pdf }}"
                                                         data-video_description = "{{ $course_video->video_description }}"
                                                            ><i class="fa-regular fa-pen-to-square fa-bounce"></i></a>
                                                        <a href="{{route('delete-course-video' , $course_video->video_id)}}" class="btn btn-danger btn-rounded"><i class="fa-solid fa-trash-can fa-shake"></i></a>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        @php
                                        use App\Models\course;
                                            $courses = course::get();
                                        @endphp

                                    </table>
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
        @include('admin.footer')
        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#add_course').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '{{ route('add-course') }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Good job!",
                                text: response.success,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                                timerProgressBar: true,
                            });
                            $('#exampleModalCenter').modal('hide');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: error.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                                timerProgressBar: true,
                            });
                        }
                    });
                });



            });
        </script>
        <script>
            $(document).ready(function() {
                $('.edit-btn').click(function() {

                    var video_id = $(this).data('video_id');
                    var video_title = $(this).data('video_title');
                    var course_id = $(this).data('course_id');
                    var video_url = $(this).data('video_url');
                    var video_pdf = $(this).data('video_pdf');
                    var video_description = $(this).data('video_description');
                    $('#video_id').val(video_id);
                    $('#editexampleModalCenter #course_name').val(course_id);
                    $('#editexampleModalCenter #video_title').val(video_title);
                    $('#editexampleModalCenter #video_url').val(video_url);

                    $('#editexampleModalCenter #video_description').val(video_description);
                    $('#editexampleModalCenter').modal('show');
                });
            });
        </script>

</body>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add-course-video') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Name</label>
                               <select name="course_name" id="course_name" class="form-control input-rounded">

                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                        @endforeach
                                        </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video Title</label>
                                <input type="text" class="form-control input-rounded" name="video_title"
                                    id="video_title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video url</label>
                                <input type="text" class="form-control input-rounded" name="video_url"
                                    id="video_url">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video Pdf</label>
                                <input type="file" class="form-control input-rounded bg-primary" name="video_pdf"
                                    id="video_pdf">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">  Description/20 Words</label>
                                <input type="text" class="form-control input-rounded" name="video_description"
                                id="video_description">
                            </div>
                        </div>




                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editexampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit-course-video') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="video_id" id="video_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Name</label>
                               <select name="course_name" id="course_name" class="form-control input-rounded">

                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                        @endforeach
                                        </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video Title</label>
                                <input type="text" class="form-control input-rounded" name="video_title"
                                    id="video_title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video url</label>
                                <input type="text" class="form-control input-rounded" name="video_url"
                                    id="video_url">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Video Pdf</label>
                                <input type="file" class="form-control input-rounded bg-primary" name="video_pdf"
                                    id="video_pdf">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">  Description/20 Words</label>
                                <input type="text" class="form-control input-rounded" name="video_description"
                                id="video_description">
                            </div>
                        </div>




                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

</html>
