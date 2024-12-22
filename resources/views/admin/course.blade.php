<!DOCTYPE html>
<html lang="en">

@include('admin.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="./plugins/summernote/dist/summernote.css" rel="stylesheet">
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
                                    <h4> <img src="{{ asset('/images/online-education.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Course List</h4>
                                    <button type="button" class="btn gradient-2 btn-rounded" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fa-solid fa-plus fa-beat-fade"></i> Add Course
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Image</th>
                                                <th> Name</th>
                                                <th> Price</th>
                                                <th>
                                                    Short Description
                                                </th>

                                                <th>Long Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $sn++ }}</td>
                                                    <td><img src="{{ asset($course->course_image) }}" alt="log"
                                                            style="height: 50px ; width:50px;"></td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->price }}</td>
                                                    <td>
                                                        <textarea name="" id="" cols="20" rows="3">{{ $course->short_description }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="" id="" cols="20" rows="3">{{ $course->long_description }}</textarea>
                                                    </td>
                                                    @if ($course->is_active == 1)
                                                        <td>
                                                            <a href="{{ route('status-course', $course->course_id) }}"
                                                                class="btn btn-success btn-rounded">
                                                                <i class="fa-solid fa-circle-check fa-flip"></i>
                                                                Active
                                                            </a>


                                                        </td>
                                                    @else
                                                        <td> <a href="{{ route('status-course', $course->course_id) }}"
                                                                class="btn btn-danger btn-rounded">
                                                                <i class="fa-solid fa-circle-xmark fa-fade"></i>
                                                                Inactive
                                                            </a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-center"
                                                            style="gap: 10px;">
                                                            <a href="#"
                                                                class="btn btn-primary btn-rounded edit-btn"
                                                                data-course_id="{{ $course->course_id }}"
                                                                data-price="{{ $course->price }}"
                                                                data-name="{{ $course->name }}"
                                                                data-short_description="{{ $course->short_description }}"
                                                                data-long_description="{{ $course->long_description }}"><i
                                                                    class="fa-regular fa-pen-to-square fa-bounce"></i></a>
                                                            <a href="{{ route('delete-course', $course->course_id) }}"
                                                                class="btn btn-danger btn-rounded"><i
                                                                    class="fa-solid fa-trash-can fa-shake"></i></a>
                                                        </div>
                                                    </td>
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
        <script src="./plugins/summernote/dist/summernote.min.js"></script>
        <script src="./plugins/summernote/dist/summernote-init.js"></script>
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

                    var course_id = $(this).data('course_id');
                    var price = $(this).data('price');
                    var name = $(this).data('name');
                    var short_description = $(this).data('short_description');
                    var long_description = $(this).data('long_description');
                    $('#course_id').val(course_id);
                    $('#editexampleModalCenter #course_name').val(name);
                    $('#editexampleModalCenter #course_price').val(price);
                    $('#editexampleModalCenter #short_description').summernote('code', short_description);


                    $('#editexampleModalCenter #long_description').summernote('code', long_description);
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
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_course" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Name</label>
                                <input type="text" class="form-control input-rounded" name="course_name"
                                    id="course_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Price</label>
                                <input type="number" class="form-control input-rounded" name="course_price"
                                    id="course_price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Image</label>
                                <input type="file" class="form-control input-rounded bg-primary"
                                    name="course_image" id="course_image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Short Description/100 Words</label>
                                <textarea name="short_description" id="short_description" cols="10" rows="5" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Full Description</label>
                                <textarea name="long_description" id="long_description" cols="10" rows="5" class="summernote"></textarea>
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
                <form method="POST" action="{{ route('edit-course') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="course_id" id="course_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Name</label>
                                <input type="text" class="form-control input-rounded" name="course_name"
                                    id="course_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Course Price</label>
                                <input type="number" class="form-control input-rounded" name="course_price"
                                    id="course_price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Image</label>
                                <input type="file" class="form-control input-rounded bg-primary"
                                    name="course_image" id="course_image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Short Description/100 Words</label>
                                <textarea name="short_description" id="short_description" cols="10" rows="5" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Course Full Description</label>
                                <textarea name="long_description" id="long_description" cols="10" rows="5" class="summernote"></textarea>
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
