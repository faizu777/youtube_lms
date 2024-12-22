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
                                    <h4> <img src="{{ asset('/images/file.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Upload Certificate</h4>

                                </div>

                                <div class="container">
                                    @if ($certificate)
                                        <img src="{{ asset($certificate->image) }}" alt="certificate" class="img-fluid">
                                    @endif
                                </div>
                                <br>
                                <br>
                                <form action="{{ route('upload-certificate') }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row mt-10">

                                        @csrf
                                        <div class="col-md-8">
                                            <input type="file" name="image" class="form-control bg-primary"
                                                accept=".jpeg,.jpg,.png" >
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Upload" class="btn btn-primary">
                                        </div>


                                </div>
                            </form>

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




</body>


<!-- Modal -->




<!-- Modal -->


</html>
