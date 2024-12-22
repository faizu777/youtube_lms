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
                                <div class="card-title d-flex justify-content-between">
                                    <h4> <img src="{{ asset('/images/helpdesk.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Support</h4>
                                    <button type="button" class="btn gradient-2 btn-rounded" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fa-solid fa-plus fa-beat-fade"></i> Leave Message
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Complain Id</th>

                                                <th>Title</th>
                                                <th>Message</th>



                                                <th>Status</th>
                                                <th>Admin Reply</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sn = 1;
                                            @endphp
                                            @foreach ($complains as $complain)
                                                <tr>
                                                    <td>{{ $sn++ }}</td>
                                                    <td>{{ $complain->complain_id }}</td>
                                                    <td>{{ $complain->title }}</td>
                                                    <td>{{ $complain->complain }}</td>
                                                    <td>
                                                        @if ($complain->status == 2)
                                                            <span class="badge badge-success">Approved</span>
                                                        @elseif($complain->status == 3)
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $complain->remark }}</td>
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
        @include('student.footer')
        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


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
                <form method="POST" action="{{ route('complain-submit') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">  Title</label>
                                <input type="text" class="form-control input-rounded" name="title"
                                    id="title">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">  Message</label>
                                <input type="text" class="form-control input-rounded" name="message"
                                    id="message">
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


</html>
