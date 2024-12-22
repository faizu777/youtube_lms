<!DOCTYPE html>
<html lang="en">
@include('student.header')


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

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Products Sold</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">$ 8541</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">New Customers</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Online Learning Progress</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">85%</h2>
                                    <p class="text-white mb-0">Courses Completed</p>
                                </div>

                                <span class="float-right display-5 opacity-5"><i class="fa fa-graduation-cap"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
                @php
                      use App\Models\websit_ad;
                      $youtube_ads = websit_ad::where('type', 3)->first();
                      $text_ads = websit_ad::where('type', 1)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">YouTube Ads</h4>
                                <iframe width="560" height="315" src="{{$youtube_ads->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="overflow-y: scroll;
                            ">
                                @foreach ($text_ads as $ad)
                                <h4 class="card-title">{{$ad->title}}</h4>
                                <p>{{$ad->description}}</p>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Exculsive Offers</h4>
                        <div class="bootstrap-carousel">
                            <div data-ride="carousel" class="carousel slide" id="carouselExampleCaptions">
                                <ol class="carousel-indicators">
                                    <li class="" data-slide-to="0" data-target="#carouselExampleCaptions"></li>
                                    <li data-slide-to="1" data-target="#carouselExampleCaptions" class=""></li>
                                    <li data-slide-to="2" data-target="#carouselExampleCaptions" class="active"></li>
                                </ol>
                                @php

                                    $carousel_ads = websit_ad::where('type', 2)->limit(4)->get();
                                @endphp
                                <div class="carousel-inner">
                                    @foreach ($carousel_ads as $key => $ad)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset($ad->image) }}" alt="Ad Image"
                                                style="height: 200px ; width:100%;">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $ad->title }}</h5>
                                                <p>{{ $ad->description }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><a data-slide="prev" href="#carouselExampleCaptions"
                                    class="carousel-control-prev"><span class="carousel-control-prev-icon"></span> <span
                                        class="sr-only">Previous</span> </a><a data-slide="next"
                                    href="#carouselExampleCaptions" class="carousel-control-next"><span
                                        class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
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
    @include('student.footer')

</body>

</html>
