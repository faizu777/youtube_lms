<!DOCTYPE html>
<html lang="en">

@include('student.header')
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
                                   <a href="{{route('get-resume')}}" class="btn gradient-2 btn-rounded">Get Resume</a>
                                </div>
                                <form action="{{ route('save-resume') }}" method="POST">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name"> Design Your Resume</label>
                                        <textarea name="resume" id="resume" cols="10" rows="100" class="summernote"></textarea>
                                    </div>
                                </div>
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
        @include('student.footer')
        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
        <script src="./plugins/summernote/dist/summernote.min.js"></script>
        <script src="./plugins/summernote/dist/summernote-init.js"></script>
        {{-- <script>
            $(document).ready(function(){
var resume = '{!! $resume !!}';
                $('#resume').summernote('code', resume);
            });
        </script> --}}
        <script>
            $(document).ready(function() {
                // Check if the resume data is empty and assign the default template if so
                var resume = '{!! $resume !!}';
                var resumeTemplate;
                if (resume === '') {
                    resumeTemplate  =  `
                    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                        <!-- Header Section -->
                        <div style="text-align: center; margin-bottom: 20px;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: bold;">[Your Name]</h1>
                            <p style="margin: 5px 0; font-size: 14px;">[Your Address]</p>
                            <p style="margin: 5px 0; font-size: 14px;">[Your Email] | [Your Phone]</p>
                            <p style="margin: 5px 0; font-size: 14px;">[Your LinkedIn Profile or Website]</p>
                        </div>

                        <!-- Objective Section -->
                        <div style="margin-bottom: 20px;">
                            <h2 style="font-size: 18px; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Objective</h2>
                            <p>[Write a brief description of your career objective or personal statement]</p>
                        </div>

                        <!-- Education Section -->
                        <div style="margin-bottom: 20px;">
                            <h2 style="font-size: 18px; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Education</h2>
                            <ul style="list-style: none; padding: 0;">
                                <li>
                                    <strong>[Degree Name]</strong> - [Institution Name]
                                    <br>
                                    <span style="font-size: 14px;">[Start Date] - [End Date]</span>
                                </li>
                                <li style="margin-top: 10px;">
                                    <strong>[Degree Name]</strong> - [Institution Name]
                                    <br>
                                    <span style="font-size: 14px;">[Start Date] - [End Date]</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Experience Section -->
                        <div style="margin-bottom: 20px;">
                            <h2 style="font-size: 18px; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Experience</h2>
                            <ul style="list-style: none; padding: 0;">
                                <li>
                                    <strong>[Job Title]</strong> - [Company Name]
                                    <br>
                                    <span style="font-size: 14px;">[Start Date] - [End Date]</span>
                                    <p>[Description of responsibilities and achievements]</p>
                                </li>
                                <li style="margin-top: 10px;">
                                    <strong>[Job Title]</strong> - [Company Name]
                                    <br>
                                    <span style="font-size: 14px;">[Start Date] - [End Date]</span>
                                    <p>[Description of responsibilities and achievements]</p>
                                </li>
                            </ul>
                        </div>

                        <!-- Skills Section -->
                        <div style="margin-bottom: 20px;">
                            <h2 style="font-size: 18px; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Skills</h2>
                            <ul style="list-style: none; padding: 0;">
                                <li>[Skill 1]</li>
                                <li>[Skill 2]</li>
                                <li>[Skill 3]</li>
                                <li>[Skill 4]</li>
                            </ul>
                        </div>

                        <!-- References Section -->
                        <div style="margin-bottom: 20px;">
                            <h2 style="font-size: 18px; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 5px;">References</h2>
                            <p>[Available upon request]</p>
                        </div>
                    </div>
                `;
                }else{
                    resumeTemplate = resume;
                }

                // Initialize Summernote with the appropriate content
               $('#resume').summernote('code', resumeTemplate);
            });
        </script>


</body>


<!-- Modal -->




<!-- Modal -->


</html>
