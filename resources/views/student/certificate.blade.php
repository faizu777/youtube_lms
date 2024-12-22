<!DOCTYPE html>
<html lang="en">




<body>

    <!--*******************
        Preloader start
    ********************-->

    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <div class="card-body">


            <div class="container">

            </div>
                @if ($certificate)
                <div class="detail" style=" position: absolute;
        top: 260px;
        left: 300px;
        z-index: 999;">
                <h3 style="color: #2d3092; font-weight: 600;">Name : {{$setudent->name}}</h3>
                <h3 style="color: #2d3092; font-weight: 600;">Certified Course : {{$course->course_name}}</h3>
                </div>

                    <img src="{{ public_path($certificate->image) }}" alt="certificate" class="img-fluid" style="width: 950px ; height: 700px;">
                @endif




        </div>


    </div>






</body>


<!-- Modal -->




<!-- Modal -->


</html>
