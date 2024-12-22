
<style>
    /* Glass background for modal content */
.glass-bg {
    background: #fff; /* Semi-transparent white */
    backdrop-filter: blur(10px);         /* Blur effect */
    -webkit-backdrop-filter: blur(10px); /* For Safari */
    border-radius: 15px;                /* Rounded corners */
    border: 1px solid rgba(255, 255, 255, 0.3); /* Optional border */
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); /* Subtle shadow */
    color : #000000;

}

.form-control.input-rounded {
    border-radius: 25px; /* Adjust the rounding */
    border: 1px solid #ccc; /* Customize border color */
    padding: 10px 15px; /* Adjust padding */
    font-size: 16px; /* Adjust text size */
    outline: none; /* Remove outline on focus */
    box-shadow: none; /* Remove inner shadow */
    transition: border-color 0.3s ease-in-out; /* Smooth border focus effect */
}

.form-control.input-rounded:focus {
    border-color: #007bff; /* Change to your desired color */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Subtle focus effect */
}

</style>

<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>










<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{asset('assets/img/logo/loder.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top d-none d-lg-block">
                <!-- Left Social -->
                <div class="header-left-social">
                    <ul class="header-social">
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    </ul>
                </div>
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li>needhelp@gmail.com</li>
                                    <li>666 7475 25252</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                @if(!session()->has('std_id'))
                                <ul>
                                    <li><a href="#" data-toggle="modal"
                                        data-target="#loginModal"><i class="ti-user" ></i>Login</a></li>
                                    <li><a href="#"><i class="ti-lock" data-toggle="modal"
                                        data-target="#registerModal"></i>Register</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <!-- Logo -->
                <div class="logo d-none d-lg-block">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png')}}" alt=""></a>
                </div>
                <div class="container">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo logo2 d-block d-lg-none">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png')}}" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('courses') }}">Courses</a></li>
                                    {{-- <li><a href="instructor.html">Instructors</a></li> --}}
                                    {{-- <li><a href="blog.html">Blog</a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog_details.html">Blog Details</a></li>
                                            <li><a href="elements.html">Element</a></li>
                                        </ul> --}}

                                    <li><a href="{{ route('contact_us') }}">Contact</a></li>
                                    @if(!session()->has('std_id'))
                                    <li><a href="#" data-toggle="modal"
                                        data-target="#loginModal"><i class="ti-user" ></i>&nbsp;Login</a></li>
                                    <li><a href="#" data-toggle="modal"  data-target="#registerModal"><i class="ti-lock"
                                       ></i>&nbsp;Register</a></li>
                                       @else
                                       <li><a href="{{ route('student-dashboard') }}">Dashboard</a></li>
                                       @endif
                                </ul>
                            </nav>
                        </div>
                        <!-- Header-btn -->
                        <div class="header-search d-none d-lg-block">
                            <form action="{{route('courses')}}" class="form-box f-right " method="GET">
                                <input type="text" name="Search" placeholder="Search Courses" >
                                <button type="submit">
                                <div class="search-icon">
                                    <i class="fas fa-search special-tag"></i>
                                </div>
                            </button>
                            </form>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content glass-bg">
            <div class="modal-body">
                <div class="row">
                    <!-- Image Section -->
                    <div class="col-md-6 d-none d-md-block ">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player src="https://lottie.host/78a5b873-65d8-4486-b3a6-c1c42aa9e7a7/GwM165q6nG.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                    </div>

                    <!-- Registration Form Section -->
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('student_registration') }}" >
                            <div class="row">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">


                                </div>
                                </div>
                                <!-- Name -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control input-rounded"
                                            name="name"
                                            id="name"
                                            required
                                            placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control input-rounded"
                                            name="email"
                                            id="email"
                                            required
                                            placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="tel"
                                            class="form-control input-rounded"
                                            name="phone"
                                            id="phone"
                                            required
                                            placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control input-rounded"
                                            name="password"
                                            id="password"
                                            required
                                            placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control input-rounded"
                                            name="confirm_password"
                                            id="confirm_password"
                                            required
                                            placeholder="Confirm Password">
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Register</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content glass-bg">
            <div class="modal-body">
                <div class="row">
                    <!-- Image Section -->
                    <div class="col-md-6 d-none d-md-block">
                        <dotlottie-player src="https://lottie.host/570a72ea-dc70-4e9c-8407-1fc2c7093600/ijYJxGDN96.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                    </div>

                    <!-- Registration Form Section -->
                    <div class="col-md-6" style="display: flex; justify-content: center; align-items: center;">
                        <form method="POST" action="{{ route('student_login') }}" >
                            <div class="row">
                                @csrf
                                <!-- Name -->
                                <div class="col-md-12">
                                    <div class="form-group">


                                </div>
                                </div>
                                <!-- Email -->
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <input type="email" class="form-control input-rounded" name="email" id="email" required placeholder="Email ">
                                    </div>
                                </div>

                                <!-- Phone Number -->


                                <!-- Password -->
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <input type="password" class="form-control input-rounded" name="password" id="password" required placeholder="Password ">
                                    </div>
                                </div>

                                <!-- Confirm Password -->

                            </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Login Now</button>
            </div>
        </form>
        </div>
    </div>
</div>
