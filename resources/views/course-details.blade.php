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
                                <h2><i class="fa-solid fa-bag-shopping fa-bounce"></i> &nbsp; Buy Now and Get Your Own</h2>
                             </div>
                       </div>
                    </div>
                 </div>
           </div>
        </div>
        <!-- Hero End -->
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area section-padding">
           <div class="container">
              <div class="row">
                 <div class="col-lg-8 posts-list">
                    <div class="single-post">
                       <div class="feature-img">
                          <img class="img-fluid" src="{{ asset($course->course_image) }}" alt="">
                       </div>
                       <br>
                       <br>
                       <div>
                        <button class="btn btn-primary"> Only/- <i class="fa-solid fa-rupee-sign fa-beat"></i>&nbsp;<a href="#">{{ $course->price}}</a></button>
                       </div>
                       <div class="blog_details">
                        {!! $course->long_description !!}

                       </div>
                    </div>

                 </div>
                 <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                       <aside class="single_sidebar_widget search_widget">

                          <a href="#" id="buy-btn" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" data-course_id="{{ $course->course_id }}"><i
                            class="fa-solid fa-bag-shopping fa-bounce"></i> &nbsp;Buy Now</a>
                       </aside>
                       <aside class="single_sidebar_widget post_category_widget">
                          <h4 class="widget_title" style="color: #2d2d2d;">Lesson</h4>
                          <ul class="list cat-list">
                            @foreach($course_videos as $c_video)
                             <li>
                                <a href="#" class="d-flex">
                                   <p>{{$c_video->video_name}}</p>

                                </a>
                             </li>
                             <br>
                             @endforeach
                             <li>
                                <a href="#" class="d-flex">
                                  <h4>10+ More Videos <i class="fa-regular fa-circle-play fa-bounce"></i></h4>

                                </a>
                             </li>
                             <br>
                          </ul>
                       </aside>

                    </div>
                 </div>
              </div>
           </div>
        </section>
        <!--================ Blog Area end =================-->
     </main>
    @include('footer')

    {{-- <script>
        $(document).ready(function() {
            $('#buy-btn').click(function() {
                var course_id = $(this).data('course_id');
                $.ajax({
                    url: '{{ url('payment-details') }}/' + course_id,
                    type: 'GET',
                    success: function(response) {

                    },
                    error: function(error) {

                        console.log(error);
                        if(error.status == 401) {
                            $('#loginModal').modal('show');
                        }

                        if(error.status == 404) {
                            alert('Course not found');
                        }

                    },
                });
            });
        });
    </script> --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $('#buy-btn').click(function() {
                var course_id = $(this).data('course_id');
                $.ajax({
                    url: '{{ url('payment-details') }}/' + course_id,
                    type: 'GET',
                    success: function(response) {
                        // Assuming the response contains `amount`, `currency`, and other Razorpay payment details
                        var options = {
                            "key": "{{ env('RAZORPAY_KEY') }}", // Replace with your Razorpay API key
                            "amount": response.amount *
                                100, // Amount in paise (convert to rupees)
                            "currency": 'INR',
                            "name": "Your Company Name",
                            "description": "Purchase Course",
                            "image": "{{ url('path/to/your/logo.png') }}", // Replace with your logo URL
                            "order_id": response
                                .order_id, // Pass the order ID created from your backend if applicable
                            "handler": function(paymentResponse) {
                                // Handle payment success
                                $.ajax({
                                    url: '{{ url('payment-success') }}',
                                    type: 'POST',
                                    data: {
                                        payment_id: paymentResponse
                                            .razorpay_payment_id,
                                        order_id: response.order_id,
                                        course_id: course_id,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(successResponse) {

                                        Swal.fire({
                                            title: "Good job!",
                                            text: "Payment Successful You can now view your course",
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                                            timerProgressBar: true,
                                        });


                                        // Redirect or update UI
                                    },
                                    error: function(error) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                            showConfirmButton: false,
                                            timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                                            timerProgressBar: true,

                                        });
                                    }
                                });
                            },
                            "prefill": {
                                "name": response.user_name, // Replace with user's name
                                "email": response.user_email, // Replace with user's email
                                "contact": response
                                    .user_contact // Replace with user's contact
                            },
                            "theme": {
                                "color": "#F37254" // Customize color
                            }
                        };
                        var rzp = new Razorpay(options);
                        rzp.open();
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.status == 401) {
                            $('#loginModal').modal('show');
                            return;
                        }
                        if (error.status == 404) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: error.responseJSON.error,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            return;
                        }
                        Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: error.responseJSON.error,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                    }
                });
            });
        });
    </script>

</body>

</html>
