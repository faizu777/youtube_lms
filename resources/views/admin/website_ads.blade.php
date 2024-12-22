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
                                    <h4> <img src="{{ asset('/images/advertising.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Manage Website Ads</h4>
                                    <button type="button" class="btn gradient-2 btn-rounded" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fa-solid fa-plus fa-beat-fade"></i> Add Ads
                                    </button>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Default Tab</h4>
                                                    <!-- Nav tabs -->
                                                    <div class="default-tab">
                                                        <ul class="nav nav-tabs mb-3" role="tablist">
                                                            <li class="nav-item"><a class="nav-link active"
                                                                    data-toggle="tab" href="#home">Text Ads</a>
                                                            </li>

                                                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                    href="#contact"> Carousel Ads</a>
                                                            </li>
                                                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                    href="#message"> YouTube Ads</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active" id="home"
                                                                role="tabpanel">
                                                                <div class="p-t-15">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-striped table-bordered zero-configuration">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th> Title</th>
                                                                                    <th> Description</th>

                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $sn = 1;
                                                                                @endphp
                                                                                @foreach ($text_ads as $ad)
                                                                                    <tr>
                                                                                        <td>{{ $sn++ }}</td>
                                                                                        <td>{{ $ad->title }}</td>
                                                                                        <td>{{ $ad->description }}</td>
                                                                                        <td>
                                                                                            <a href="{{ route('delete-website-ad', $ad->id) }}"
                                                                                                class="btn btn-danger btn-rounded"><i
                                                                                                    class="fa-solid fa-trash-can fa-shake"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>

                                                                        </table>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="profile">
                                                                <div class="p-t-15">

                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="contact">
                                                                <div class="p-t-15">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-striped table-bordered zero-configuration">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th> Title</th>
                                                                                    <th> Image</th>
                                                                                    <th> Description</th>

                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $sn = 1;
                                                                                @endphp
                                                                                @foreach ($carousel_ads as $ad)
                                                                                    <tr>
                                                                                        <td>{{ $sn++ }}</td>
                                                                                        <td><img src="{{ asset($ad->image) }}"
                                                                                                alt="log"
                                                                                                style="height: 50px ; width:50px;">
                                                                                        </td>
                                                                                        <td>{{ $ad->title }}</td>
                                                                                        <td>{{ $ad->description }}</td>
                                                                                        <td>
                                                                                            <a href="{{ route('delete-website-ad', $ad->id) }}"
                                                                                                class="btn btn-danger btn-rounded"><i
                                                                                                    class="fa-solid fa-trash-can fa-shake"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>

                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="message">
                                                                <div class="p-t-15">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-striped table-bordered zero-configuration">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Link</th>

                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $sn = 1;
                                                                                @endphp
                                                                                @foreach ($youtube_ads as $ad)
                                                                                    <tr>
                                                                                        <td>{{ $sn++ }}</td>

                                                                                        <td>{{ $ad->link }}</td>
                                                                                        <td>
                                                                                            <a href="{{ route('delete-website-ad', $ad->id) }}"
                                                                                                class="btn btn-danger btn-rounded"><i
                                                                                                    class="fa-solid fa-trash-can fa-shake"></i></a>
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
                                            </div>
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
                <form method="POST" action="{{ route('add-website-ad') }}" enctype="multipart/form-data">
                    <div class="row">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Ads Type</label>
                                <select name="ads_type" id="ads_type" class="form-control input-rounded">

                                    <option value="" selected>Select Ads Type</option>
                                    <option value="1">Text Ads</option>
                                    <option value="2"> Carousel Ads</option>
                                    <option value="3"> YouTube Ads</option>



                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="appened">


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
<script>
    $(document).ready(function () {
        $('#ads_type').change(function () {
            var ads_type = $(this).val();
            let html = ''; // Declare `html` outside for reuse

            if (ads_type == '1') {
                html = `
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control input-rounded" name="title" id="title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="video_description">Description/20 Words</label>
                            <input type="text" class="form-control input-rounded" name="video_description" id="video_description">
                        </div>
                    </div>`;
            } else if (ads_type == '2') {
                html = `
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control input-rounded" name="title" id="title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">Image</label>
                            <input type="file" class="form-control input-rounded" name="file" id="file">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="video_description">Description/20 Words</label>
                            <input type="text" class="form-control input-rounded" name="video_description" id="video_description">
                        </div>
                    </div>`;
            } else if (ads_type == '3') {
                html = `
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">YouTube Link</label>
                            <input type="text" class="form-control input-rounded" name="link" id="link">
                        </div>
                    </div>`;
            }

            // Update the content dynamically
            $('#appened').html(html);
        });
    });
</script>


</html>
