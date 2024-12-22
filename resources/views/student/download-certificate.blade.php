<!DOCTYPE html>
<html lang="en">

@include('student.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .detail{
        position: absolute;
        top: 40%;
        left: 30%;

    }
    h3{
        color :#2d3092 !important;
        font-weight: 600;
    }
    @media (max-width: 786px) {
        h3{
            font-size: 10px;
        color :#2d3092 !important;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .detail{
        position: absolute;
        top: 45%;
        left: 30%;

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
                                    <h4><i class="fa-solid fa-trophy fa-fade fa-xl"></i> Certificate</h4>
<a href="{{route('downloading-certificate',$course->course_id )}}" class="btn btn-primary btn-sm btn-rounded d-flex justify-content-center align-items-center">Download Now<i class="fa-solid fa-download fa-beat"></i></a>
                                </div>

                                <div class="container">
                                    <div class="detail">
                                        <h3>Name : {{$setudent->name}}</h3>
                                        <h3>Certified Course : {{$course->course_name}}</h3>
                                    </div>
                                </div>
                                    @if ($certificate)
                                        <img src="{{ asset($certificate->image) }}" alt="certificate" class="img-fluid">
                                    @endif

                                <br>
                                <br>


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




</body>


<!-- Modal -->




<!-- Modal -->


</html>
