<!doctype html>
<html class="no-js" lang="zxx">
@include('header')

<body>
    <!--? Preloader Start -->
    @include('navbar')
    <main>
        <!--? Hero Start -->
        <div class="slider-area">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center">
                                <h2> <i class="fa-solid fa-bag-shopping fa-bounce"></i> &nbsp; Buy Now and Get Your Own
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!--? About  Start-->
        <div class="about-area section-padding2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-caption mb-50">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-35">
                                <span>More About Course</span>

                            </div>
                            {!! $course->long_description !!}
                            <br>
                            <br>
                            <a href="#" id="buy-btn" class="btn" data-course_id="{{ $course->course_id }}"><i
                                    class="fa-solid fa-bag-shopping fa-bounce"></i> &nbsp;Get Own</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">


                            <img src="{{ asset($course->course_image) }}" alt=""
                                class="img-fluid img-responsive">
                                <br>
                                <br>

                                <h2 class="alert alert-primary"> Only/ <i class="fa-solid fa-rupee-sign fa-beat"></i>&nbsp;<a href="#">{{ $course->price}}</a></h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Law End-->
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
                            "image": "{{ url('assets/img/logo/logo.png') }}",
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
