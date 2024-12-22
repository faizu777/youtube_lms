<!DOCTYPE html>
<html class="h-100" lang="en">

@include('admin.header')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center pt-2">
                                <img src="{{asset('images/book.png')}}" alt="book" class="img-fluid">
                                <h1 class="error-text  " style="color :  #0e4cfd;">404</h1>
                                <h2>What are you looking for?</h2>


                                <form class="mt-5 mb-5">

                                    <div class="text-center mb-4 mt-4"><a href="{{route('index')}}" class="btn btn-primary gradient-4">Go to Homepage</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('plugins/common/common.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/gleek.js')}}"></script>
    <script src="{{asset('js/styleSwitcher.js')}}"></script>
</body>
</html>





