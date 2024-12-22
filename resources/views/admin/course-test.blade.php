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
                                    <h4> <img src="{{ asset('/images/watching.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Video Course List</h4>
                                    <button type="button" class="btn gradient-2 btn-rounded" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fa-solid fa-plus fa-beat-fade"></i> Add Question
                                    </button>
                                </div>
                                @php
                                use App\Models\course;
                                $courses = course::get();
                            @endphp
                                <form action="{{ route('course-test') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="course_id" id="course_name" class="form-control input-rounded">

                                                <option value="">Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-rounded">
                                                <i class="fa-solid fa-magnifying-glass fa-shake"></i> Search
                                                </button>
                                        </div>


                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>Course Name</th>
                                                <th>Question</th>

                                                <th>Option 1</th>
                                                <th> Option 2</th>
                                                <th>Option 3</th>
                                                <th>Option 4</th>
                                                <th>Marks</th>
                                                <th>Answer</th>
                                                <th>Time Duration/Minitues</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sn = 1;
                                            @endphp

                                            @foreach ($course_tests as $course_test)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>{{ $course_test->course_name }}</td>
                                                <td>{{ $course_test->question }}</td>
                                                <td>{{ $course_test->option1 }}</td>
                                                <td>{{ $course_test->option2 }}</td>
                                                <td>{{ $course_test->option3 }}</td>
                                                <td>{{ $course_test->option4 }}</td>
                                                <td>{{ $course_test->marks }}</td>
                                                <td>{{ $course_test->answer }}</td>
                                                <td>{{ $course_test->time_duration }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-rounded edit-btn" data-test_id = "{{ $course_test->test_id }}"
                                                        data-question_id = "{{ $course_test->question_id }}"
                                                        data-course_id = "{{ $course_test->course_id }}"
                                                        data-question = "{{ $course_test->question }}"
                                                        data-option1 = "{{ $course_test->option1 }}"
                                                        data-option2 = "{{ $course_test->option2 }}"
                                                        data-option3 = "{{ $course_test->option3 }}"
                                                        data-option4 = "{{ $course_test->option4 }}"
                                                        data-marks = "{{ $course_test->marks }}"
                                                        data-answer = "{{ $course_test->answer }}"
                                                        data-time_duration = "{{ $course_test->time_duration }}"
                                                        ><i class="fa-regular fa-pen-to-square fa-bounce"></i></a>
                                                        <a href="{{ route('delete-question', $course_test->test_id) }}" class="btn btn-danger btn-rounded"><i class="fa-solid fa-trash-can fa-shake"></i></a>
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

                    var test_id = $(this).data('test_id');
                    var question_id = $(this).data('question_id');

                    var course_id = $(this).data('course_id');
                    var question = $(this).data('question');
                    var option1 = $(this).data('option1');
                    var option2 = $(this).data('option2');
                    var option3 = $(this).data('option3');
                    var option4 = $(this).data('option4');
                    var marks = $(this).data('marks');
                    var answer = $(this).data('answer');
                    var time_duration = $(this).data('time_duration');
                    $('#test_id').val(test_id);


                    $('#editexampleModalCenter #course_name').val(course_id);

                    $('#editexampleModalCenter #question').val(question);
                    $('#editexampleModalCenter #option1').val(option1);
                    $('#editexampleModalCenter #option2').val(option2);
                    $('#editexampleModalCenter #option3').val(option3);
                    $('#editexampleModalCenter #option4').val(option4);
                    $('#editexampleModalCenter #marks').val(marks);
                    $('#editexampleModalCenter #answer').val(answer);
                    $('#editexampleModalCenter #time_duration').val(time_duration);

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
                <form method="POST" action="{{ route('add-question') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf

                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Question</label>
                                <textarea name="question" id="" cols="30" rows="2" class="form-control input-rounded" placeholder="Enter Question"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 1</label>
                                <input type="text" class="form-control input-rounded" name="option1"
                                    id="option1" placeholder="Enter Option 1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 2</label>
                                <input type="text" class="form-control input-rounded" name="option2"
                                    id="option2" placeholder="Enter Option 2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 3</label>
                                <input type="text" class="form-control input-rounded" name="option3"
                                    id="option3" placeholder="Enter Option 3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 4</label>
                                <input type="text" class="form-control input-rounded" name="option4"
                                    id="option4" placeholder="Enter Option 4">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Answer</label>
                                <input type="text" class="form-control input-rounded" name="answer"
                                    id="answer" placeholder="Enter Answer">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Marks</label>
                                <input type="number" class="form-control input-rounded" name="marks"
                                    id="marks" placeholder="Enter Marks">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text text-warning"> Time Duration (in minutes)</label>
                                <input type="number" class="form-control input-rounded" name="time_duration"
                                    id="time_duration" placeholder="Enter Time Duration">
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
<div class="modal fade" id="editexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                <form method="POST" action="{{ route('edit-question') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="test_id" id="test_id">

                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Question</label>
                                <textarea name="question" id="question" cols="30" rows="2" class="form-control input-rounded" placeholder="Enter Question"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 1</label>
                                <input type="text" class="form-control input-rounded" name="option1"
                                    id="option1" placeholder="Enter Option 1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 2</label>
                                <input type="text" class="form-control input-rounded" name="option2"
                                    id="option2" placeholder="Enter Option 2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 3</label>
                                <input type="text" class="form-control input-rounded" name="option3"
                                    id="option3" placeholder="Enter Option 3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Option 4</label>
                                <input type="text" class="form-control input-rounded" name="option4"
                                    id="option4" placeholder="Enter Option 4">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Answer</label>
                                <input type="text" class="form-control input-rounded" name="answer"
                                    id="answer" placeholder="Enter Answer">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Marks</label>
                                <input type="text" class="form-control input-rounded" name="marks"
                                    id="marks" placeholder="Enter Marks">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text text-warning"> Time Duration (in minutes)</label>
                                <input type="number" class="form-control input-rounded" name="time_duration"
                                    id="time_duration" placeholder="Enter Time Duration">
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
