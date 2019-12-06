@extends('layouts.user')
@section('content')

<div  style="color:white; background-image: url('https://images.unsplash.com/photo-1531538606174-0f90ff5dce83?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80.png');">
<section class="contact-us-sec">

    <div class="container">
                <br><br>
            <h1 class="text-center" style="color:white;">Contact Us</h1>
        <div class="row">



            <div class="col-md-6">
                <form action="#" method="">
                <div class="form-group">
                  <label for="">Full Name</label>
                  <input type="text" name="" id="" class="form-control custom-field" placeholder="" aria-describedby="helpId" required>
                </div>


                <div class="form-group email">
                  <label for="">Email</label>
                  <input type="email" class="form-control custom-field" name="" id="" aria-describedby="emailHelpId" placeholder="" required>
                </div>


                <div class="form-group">
                  <label for="">Message</label>
                  <textarea class="form-control text-area" name="" id="" rows="3" required></textarea>
                </div>

                <button type="submit" class="contact-submit-btn btn">Submit</button>
                </form>

            </div>

            <div class="map-frame col-md-6">

                <div class="mapouter">
                    <div class="gmap_canvas"><iframe class="iframe-width" width="500" height="300" id="gmap_canvas"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13625.42130385738!2d74.185535!3d31.3767646!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaaefb80ae6c634ff!2sHolistic%20Technologies%20Pakistan%20%7C%20Repair%20%26%20Retail!5e0!3m2!1sen!2s!4v1574324588753!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="">"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                         <div class="row">


                                <?php

                                use App\HeaderFooter;
                                $headerfooter= HeaderFooter::orderBy('id','desc')->get();
                                ?>
                                @foreach ($headerfooter as $header)


                             <div class="col-md-4 col-12 con-class text-left">
                                    <img src="{{URL::asset('assets/img/about-icons/icons/location.png')}}"><br>

                                    {{$header->address}}

                            </div>
                             <div class="col-md-5 col-12 text-left">
                                    <img src="{{URL::asset('assets/img/about-icons/icons/message.png')}}"><br>

                                    {{$header->email}}
                             </div>
                             <div class="col-md-3 col-12 text-left">
                                    <img src="{{URL::asset('assets/img/about-icons/icons/phone.png')}}"><br>

                                    {{$header->phone_no}}
                             </div>

                             @endforeach

                         </div>

                            <div class="col-md-6">

                            </div>

                        </a></div>


                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 500px;
                            width: auto;
                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 500px;
                            width: auto;
                        }
                    </style>
                </div>

            </div>

        </div>

    </div>

</section>
</div>

<!-- Start Products Cart Modal -->
<div class="modal right fade productsCartModal" id="productsCartModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <div class="modal-body">
                    <h3>My Cart ({{ count((array) session('cart')) }})</h3>

                    <div class="product-cart-content">
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="product-cart">
                                <div class="product-image">
                                    <img src="{{ $details['photo'] }}" alt="image">
                                </div>

                                <div class="product-content">
                                    <h3><a href="#">{{ $details['name'] }}</a></h3>
                                    <div class="product-price">
                                        <span>Quantity:{{ $details['quantity'] }}</span>
                                        <span>x</span>
                                        <span class="price">{{ $details['price'] }}PKR</span>
                                    </div>

                                    <a href="#" class="remove-btn remove-from-cart" data-id="{{ $id }}"><i class="far fa-trash-alt"></i></a>
                                    <!-- <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button> -->

                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>

                    <?php $total = 0 ?>
                    @foreach((array) session('cart') as $id => $details)
                        <?php $total += $details['price'] * $details['quantity'] ?>
                    @endforeach

                    <div class="product-cart-subtotal">
                        <span>Subtotal</span>

                        <span class="subtotal">{{ $total }}PKR</span>
                    </div>

                    <div class="product-cart-btn">
                            <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Products Cart Modal -->


    <!-- jQuery Min JS -->
<script src="{{asset('frontendJS/jquery.min.js')}}"></script>
<!-- Popper Min JS -->
<script src="{{asset('frontendJS/popper.min.js')}}"></script>
<!-- Bootstrap Min JS -->
<script src="{{asset('frontendJS/bootstrap.min.js')}}"></script>
<!-- Parallax Min JS -->
<script src="{{asset('frontendJS/parallax.min.js')}}"></script>
<!-- MeanMenu JS -->
<script src="{{asset('frontendJS/jquery.meanmenu.js')}}"></script>
<!-- Slick Min JS -->
<script src="{{asset('frontendJS/slick.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('frontendJS/owl.carousel.min.js')}}"></script>
<!-- MixItUp Min JS -->
<script src="{{asset('frontendJS/mixitup.min.js')}}"></script>
<!-- Odometer Min Js -->
<script src="{{asset('frontendJS/odometer.min.js')}}"></script>
<!-- Appear Min JS -->
<script src="{{asset('frontendJS/jquery.appear.min.js')}}"></script>
<!-- Magnific Popup Min JS -->
<script src="{{asset('frontendJS/jquery.magnific-popup.min.js')}}"></script>
<!-- Nice Select Min CSS -->
<script src="{{asset('frontendJS/jquery.nice-select.min.js')}}"></script>
<!-- AjaxChimp Min JS -->
<script src="{{asset('frontendJS/jquery.ajaxchimp.min.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('frontendJS/form-validator.min.js')}}"></script>
<!-- Contact Form Min JS -->
<script src="{{asset('frontendJS/contact-form-script.js')}}"></script>
<!-- Fennec Map JS -->
<script src="{{asset('frontendJS/fennec-map.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('frontendJS/main.js')}}"></script>



<script type="text/javascript">
    $(document).ready(function (e) {

        $("body").on("click", ".categories", function (e) {

            var id = $(this).attr('id');

            $.ajax({
                url: "/getSubService/" + $(this).attr('id'),
                type: 'GET',
                success: function (html) {
                    $('#services-section').html(html);
                }
            });
        });


    });

</script>

<script type="text/javascript">

        $(".update-cart").click(function (e) {
           e.preventDefault();

           var ele = $(this);

            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>


@endsection
