<!doctype html>
<html class="no-js" lang="zxx">
@include('header')

<body>
    <!--? Preloader Start -->
    @include('navbar')
    <main>
        <!--? Hero Start -->
        <div class="slider-area ">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center">
                                <h2>All Courses</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- all-course Start -->
        <section class="all-course section-padding30">
            <div class="container">
                <div class="row">
                    <div class="all-course-wrapper">
                        <!-- Heading & Nav Button -->
                        {{-- <div class="row mb-15">
                            <div class="col-lg-12">
                                <div class="properties__button mb-90">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Web</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Graphic</a>
                                            <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Video</a>
                                            <a class="nav-item nav-link" id="nav-Sports" data-toggle="tab" href="#nav-nav-Sport" role="tab" aria-controls="nav-contact" aria-selected="false">Language</a>
                                        </div>
                                    </nav>
                                    <!--End Nav Button  -->
                                </div>
                            </div>
                        </div>
                        <!-- Tab content --> --}}
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!--  one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="row">

                                            @foreach ($courses as $course)
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="{{ asset($course->course_image) }}" alt="" style="height: 300px; width:100%; ">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="{{route('course_detail',$course->course_id )}}">{{ $course->name }}</a></h4>

                                                        </div>
                                                        <div class="course-cap-top">
                                                            <h5> Only/ <i class="fa-solid fa-rupee-sign fa-beat"></i>&nbsp;<a href="#">{{ $course->price}}</a></h5>

                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                               {!!$course->short_description !!}
                                                            </div>

                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
<a href="{{route('course_detail',$course->course_id )}}" class="btn btn-primary btn-rounded">Buy Now <i class="fa-solid fa-cart-shopping fa-shake"></i></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach


                                            {{-- <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    {{-- <!--  Two -->
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Three -->
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Fur -->
                                    <div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Five -->
                                    <div class="tab-pane fade" id="nav-nav-Sport" role="tabpanel" aria-labelledby="nav-Sports">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub2.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Graphic Design</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub3.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Web Development</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <!-- Single course -->
                                                <div class="single-course mb-70">
                                                    <div class="course-img">
                                                        <img src="assets/img/gallery/popular_sub1.png" alt="">
                                                    </div>
                                                    <div class="course-caption">
                                                        <div class="course-cap-top">
                                                            <h4><a href="#">Digital Marketing</a></h4>
                                                        </div>
                                                        <div class="course-cap-mid d-flex justify-content-between">
                                                            <div class="course-ratting">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <ul><li>52 Review</li></ul>
                                                        </div>
                                                        <div class="course-cap-bottom d-flex justify-content-between">
                                                            <ul>
                                                                <li><i class="ti-user"></i> 562</li>
                                                                <li><i class="ti-heart"></i> 562</li>
                                                            </ul>
                                                            <span>Free</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- all-course End -->
    </main>
    @include('footer')

</body>

</html>
