<!DOCTYPE html>
<html lang="en">

@include('student.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .my-card {
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease, z-index 0.3s ease;
        z-index: 0;
    }

    .my-card:hover {
        transform: translateY(-10px);
        /* Moves the card upwards */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Adds a shadow effect */
        z-index: 10;
        /* Brings the card to the front */
    }
</style>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
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
                                <h1 class="text text-center">Test</h1>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <h4>Total Marks: {{ $total_marks }}</h4>
                                        {{-- <h4> Total Duration: {{ $total_duration }} minitues</h4> --}}
                                        <h4 id="timer"></h4>
                                    </div>
                                </div>
                                <form action="{{ route('test-submit') }}" class="form-horizontal" method="POST">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course_id }}">
                                        @php
                                            $sn = 1;
                                        @endphp
@foreach ($questions as $key => $question)
<div class="col-md-12">
    <div class="basic-list-group">
        <ul class="list-group">
            <li class="list-group-item active gradient-4">
                [Question :{{ $sn++ }}] - {{ $question->question }} [ :-{{ $question->marks }}]
            </li>
            <input type="hidden" name="questions[{{ $key }}][question_id]" value="{{ $question->question_id }}">
            <input type="hidden" name="questions[{{ $key }}][answer]" id="defaultAnswer_{{ $key }}" value="not attempted">

            <li class="list-group-item">
                <input type="radio" name="questions[{{ $key }}][answer]" id="option1_{{ $key }}" value="{{ $question->option1 }}">
                {{ $question->option1 }}
            </li>
            <li class="list-group-item">
                <input type="radio" name="questions[{{ $key }}][answer]" id="option2_{{ $key }}" value="{{ $question->option2 }}">
                {{ $question->option2 }}
            </li>
            <li class="list-group-item">
                <input type="radio" name="questions[{{ $key }}][answer]" id="option3_{{ $key }}" value="{{ $question->option3 }}">
                {{ $question->option3 }}
            </li>
            <li class="list-group-item">
                <input type="radio" name="questions[{{ $key }}][answer]" id="option4_{{ $key }}" value="{{ $question->option4 }}">
                {{ $question->option4 }}
            </li>
        </ul>
    </div>
</div>
@endforeach




                                    </div>
                                    <br>
                                    <br>
                                    <input type="submit" value="Submit" class="btn btn-primary gradient-4">
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
        @include('student.footer')

        <script>
            $(document).ready(function() {
                // Get the total duration in minutes from the server
                var totalDuration = {{ $total_duration }}; // Replace with actual PHP variable output
                var timeInSeconds = totalDuration * 60; // Convert minutes to seconds

                // Timer function
                function startTimer(duration) {
                    var timer = duration,
                        minutes, seconds;

                    var interval = setInterval(function() {
                        minutes = Math.floor(timer / 60);
                        seconds = timer % 60;

                        // Ensure double digits for display
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        seconds = seconds < 10 ? '0' + seconds : seconds;

                        // Update the timer display
                        $('#timer').text(`Time Left: ${minutes}:${seconds}`);

                        if (--timer < 0) {
                            clearInterval(interval);
                            $('#timer').text("Time's up!");
                            // Add any additional actions when the timer ends
                        }
                    }, 1000);
                }

                // Start the timer
                startTimer(timeInSeconds);
            });
        </script>


</body>




</html>
