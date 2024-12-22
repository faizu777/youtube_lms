<!DOCTYPE html>
<html lang="en">

@include('student.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="./plugins/summernote/dist/summernote.css" rel="stylesheet">
<link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    /* Styling for print media */
    @media print {
        body * {
            visibility: hidden; /* Hide everything */
        }
        .resume, .resume * {
            visibility: visible; /* Show only the resume */
        }
        .resume {
            position: absolute;
            top: -100%;
            left: -30%;
            width: 100%;
        }
    }
</style>
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
                                    <h4> <img src="{{ asset('/images/online-education.gif') }}" alt="log"
                                            style="height: 50px ; width:50px;">Course List</h4>
                                            <button class="btn btn-primary" onclick="printResume()">Print Resume</button>
                                </div>
                                <div class="resume">
                                    {!! $resume !!}
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
        <script src="./plugins/summernote/dist/summernote.min.js"></script>
        <script src="./plugins/summernote/dist/summernote-init.js"></script>
        <script>
            $(document).ready(function(){
var resume = '{!! $resume !!}';
                $('#resume').summernote('code', resume);
            });
        </script>
<script>
    function printResume() {
        // Triggers the print dialog and applies the print-specific styles
        window.print();
    }
</script>

</body>


<!-- Modal -->




<!-- Modal -->


</html>
