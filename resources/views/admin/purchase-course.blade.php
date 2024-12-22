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
                                    <h4> <img src="{{ asset('/images/student.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Course Purchased Student List</h4>

                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th> Name</th>
                                                <th>Email</th>

                                                <th>
                                                   Mobile No
                                                <th>Course Name</th>


                                                <th>Price</th>
                                                <th>Order id</th>
                                                <th>Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $sn++ }}</td>

                                                    <td>{{ $course->name}}</td>
                                                    <td>{{ $course->email}}</td>
                                                    <td>{{ $course->phone}}</td>
                                                    <td>{{ $course->course_name}}</td>
                                                    <td>{{ $course->price}}</td>
                                                    <td>{{$course->order_id}}</td>
                                                    <td>{{$course->date_time}}</td>


                                                </tr>
                                            @endforeach
                                        </tbody>




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




</html>
