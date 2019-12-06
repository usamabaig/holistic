@extends('layouts.user')
@section('content')


<section class="checkout-menu-main">
    <div class="container">

        <div class="row text-center">

            <ul class="nav nav-pills mb-3 checkout-menu" id="pills-tab" role="tablist">
                <li class="nav-item" style="pointer-events: none">

                    <a class="
                    @if(Auth::user())
                    nav-link nav-class
                    @else
                    nav-link active active-class
                    @endif

                    {{-- href is: #sign-in --}}

                    " id="pills-signin-tab" data-toggle="pill" href="" role="tab" aria-controls="pills-signin-tab"
                        aria-selected="true">1</a>
                    <div class="menu-text-active">
                        Sign In
                    </div>
                    <div class="lines"></div>

                </li>

                <li class="nav-item" style="pointer-events: none">
                    {{-- href is: #customer-info --}}
                    <a class="
                    @if(Auth::user() && session('#pills-complete'))
                    nav-link nav-class
                    @elseif(Auth::user())
                    nav-link active active-class
                    @else
                    nav-link nav-class
                    @endif

                    " id="pills-customer-info-tab" data-toggle="pill" href="" role="tab"
                        aria-controls="pills-customer-info-tab" aria-selected="false">2</a>
                    <div class="menu-text">
                        Customer Information
                    </div>
                    <div class="lines-center"></div>
                </li>
                <li class="nav-item" style="pointer-events: none">
                    {{-- href is: #pills-payment --}}
                    <a class="nav-link nav-class" id="pills-payment-tab" data-toggle="pill" href="" role="tab"
                        aria-controls="pills-payment-tab" aria-selected="false">3</a>
                    <div class="menu-text">
                        Payment
                    </div>
                    <div class="lines"></div>
                </li>

                <li class="nav-item" style="pointer-events: none">
                    {{-- href is: #pills-complete --}}

                    <a class="
                    @if(Auth::user() && session('#pills-complete'))
                    nav-link active active-class
                    @else
                    nav-link nav-class
                    @endif

                    " id="pills-complete-tab" data-toggle="pill" href="
                    " role="tab"
                        aria-controls="pills-complete" aria-selected="false">4</a>
                    <div class="menu-text">
                        Complete
                    </div>
                </li>
            </ul>
        </div>


        <div class="tab-content" id="pills-tabContent">
            <div class="
            @if(Auth::user())
            tab-pane fade
            @else
            tab-pane fade show active
            @endif
            " id="sign-in" role="tabpanel" aria-labelledby="pills-signin-tab">

                {{-- Sign In Section --}}

                <section class="checkout-sec">
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-md-6 left-sec">

                                @if(Auth::user())

                                <h4>Welcome, {{Auth::user()->name }} </h4>

                                @else

                                <h2 class="heading text-center">Sign In to Purchase</h2>
                                @endif

                                <div class="row">




                                    <div class="col-md-6 left-text-sec text-center">

                                        @if(Auth::user())

                                        @else
                                        <p>New to Holistic Group. <a href="{{url('signup')}}">Register</a> </p>

                                        <button class="checkout-btn-register" type="button"><a
                                                href="{{url('signup')}}">Register</a></button>

                                        @endif
                                    </div>

                                    <div class="col-md-6 right-text-sec text-center">

                                        @if(Auth::user())

                                        @else
                                        <p> Already Have an account. <a href="{{url('signin')}}"> Sign In</a> </p>

                                        <button class="checkout-btn-signin" type="button"><a
                                                href="{{url('signin')}}">Sign In</a></button>

                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 right-sec">

                                <h2 class="heading text-center">Summary</h2>

                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)


                                <div class="row">


                                    <div class="col-md-8">


                                        <h4 class="blue-heading">Item</h4>

                                        <h4 class="green-heading">{{ $details['name'] }}</h4>

                                        <ul class="nav-class">

                                            <li>{{ $details['description'] }}</li>

                                        </ul>
                                    </div>

                                    <div class="col-md-4 right-inner-sec">

                                        <h4 class="blue-heading">Total</h4>

                                        <h5 class="green-heading">

                                            {{ $details['price'] }}
                                            PKR</h5>

                                    </div>

                                </div>



                                @endforeach
                                @endif

                                {{-- ---------------------------------------- --}}

                                <hr>

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="blue-heading"> Item Total</h4>
                                    </div>

                                    <div class="col-md-4">


                                        <h4 class="green-heading">
                                            <?php $total = 0 ?>
                                            @foreach((array) session('cart') as $id => $details)
                                            <?php $total += $details['price'] * $details['quantity'] ?>
                                            @endforeach

                                            <span class="subtotal">{{ $total }}PKR</span>

                                        </h4>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-12 text-right">


                                        @if(Auth::user())

                                        <a class="nav-link nav-class" id="pills-customer-info-tab" data-toggle="pill"
                                            href="#customer-info" role="tab" aria-controls="pills-customer-info-tab"
                                            aria-selected="false">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                        @else
                                        @endif

                                    </div>

                                </div>

                                {{-- ---------------------------------------- --}}



                            </div>


                        </div>


                    </div>

                </section>




            </div>


            <div class="

                {{-- xyz --}}
            @if(Auth::user() && session('#pills-complete') )
            tab-pane fade
            @elseif(Auth::user())
            tab-pane fade show active
            @else
            tab-pane fade
            @endif

            " id="customer-info" role="tabpanel" aria-labelledby="pills-customer-info-tab">

                {{-- contact and summary --}}


                <section class="checkout-sec">
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-md-6 left-sec">

                                <h2 class="heading text-center">Contact Info</h2>

                                {{-- @if(session('order'))
                                <div class="alert alert-success" role="alert">
                                    <strong>{{session('order')}}</strong>

                                </div>
                                @endif --}}

                                <form action="{{route('contact-checkout')}}" class="contact-form" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="my-input">DATE</label>
                                        <input id="my-input" class="form-control" type="date" name="date"  required>
                                    </div>


                                    <div class="form-group">
                                        <label for="my-input">TIME</label>
                                        <input id="my-input" class="form-control" type="time" name="time" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="my-input">FULL NAME</label>
                                        <input id="my-input" class="form-control" type="text" name="name" value="
                                         @if (Auth::check())
                                        {{ Auth::user()->name }}
                                         @endif
                                        " required>
                                    </div>


                                    <div class="form-group">
                                        <label for="my-input">ADDRESS</label>
                                        <input id="my-input" class="form-control" type="text" name="address" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="my-input">CITY</label>
                                        <input id="my-input" class="form-control" type="text" name="city" required>
                                    </div>


                                    <label for="">COUNTRY</label>

                                    <div class="form-group">
                                        <select name="country" id="" class="form-control select-option">
                                            <option class="form-control select-option" value="pakistan">PAKISTAN
                                            </option>
                                            <option class="form-control select-option" value="us">UNITED STATES</option>
                                            <option class="form-control select-option" value="uae">UAE</option>
                                            <option class="form-control select-option" value="eng">ENGLAND</option>

                                        </select>

                                    </div>
                                    <br><br>


                                    <button type="submit" class="contact-submit">Submit</button>



                                </form>



                            </div>

                            <div class="col-md-6 right-sec">

                                <h2 class="heading text-center">Summary</h2>

                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)


                                <div class="row">


                                    <div class="col-md-8">


                                        <h4 class="blue-heading">Item</h4>

                                        <h4 class="green-heading">{{ $details['name'] }}</h4>

                                        <ul class="nav-class">

                                            <li>{{ $details['description'] }}</li>

                                        </ul>
                                    </div>

                                    <div class="col-md-4 right-inner-sec">

                                        <h4 class="blue-heading">Total</h4>

                                        <h5 class="green-heading">

                                            {{ $details['price'] }}
                                            PKR</h5>

                                    </div>

                                </div>


                                @endforeach
                                @endif

                                {{-- ---------------------------------------- --}}

                                <hr>

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="blue-heading"> Item Total</h4>
                                    </div>

                                    <div class="col-md-4">


                                        <h4 class="green-heading">
                                            <?php $total = 0 ?>
                                            @foreach((array) session('cart') as $id => $details)
                                            <?php $total += $details['price'] * $details['quantity'] ?>
                                            @endforeach

                                            <span class="subtotal">{{ $total }}PKR</span>

                                        </h4>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-12 text-right">


                                        @if(Auth::user())

                                        <a class="nav-link nav-class" id="pills-customer-info-tab" data-toggle="pill"
                                            href="#customer-info" role="tab" aria-controls="pills-customer-info-tab"
                                            aria-selected="false">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                        @else
                                        @endif

                                    </div>

                                </div>

                                {{-- ---------------------------------------- --}}



                            </div>

                        </div>


                    </div>

                </section>



            </div>
            <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">

                {{-- Payment --}}


                <section class="payment-method">
                    <div class="container bg-section">

                        <h2 class="heading text-center">Payment Method</h2>

                        <div class="row text-center">


                            <div class="col-md-4">


                                <!--<div class="left-sec">-->

                                <!--    <i class="fa fa-cc-visa" aria-hidden="true"></i>-->

                                <!--</div>-->


                            </div>

                            <div class="col-md-4">



                                <div class="right-sec">

                                    <h3>Cash on Delivery</h3>

                                </div>


                                <!--<div class="center-sec">-->

                                <!--    <i class="fa fa-cc-paypal" aria-hidden="true"></i>-->

                                <!--</div>-->

                            </div>

                            <div class="col-md-4">

                                <!--<div class="right-sec">-->

                                <!--    <h3>Cash on Delivery</h3>-->

                                <!--</div>-->

                            </div>

                        </div>


                        <div class="row payment-card">

                            <div class="col-md-6 offset-md-3">
                                <h2 class="blue-heading text-center">Credit Card Info</h2>

                                <form action="" method="">
                                    <label for="" class="text-left">CARD NO</label>
                                    <div class="form-group custom-field">
                                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                                            placeholder="">
                                        <i class="fa fa-cc-visa visa-field" aria-hidden="true"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-left">CARDHOLDER NO</label>
                                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                                            placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text">EXPIRY DATE</label>
                                        <input type="date" class="form-control" name="" id="" aria-describedby="helpId"
                                            placeholder="">
                                    </div>


                                    <div class="form-group">
                                        <label for="">CVV</label>
                                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                                            placeholder="">
                                    </div>


                                    <button class="payment-confirm-order text-center" type="submit">Confirm
                                        Order</button>

                                </form>

                                {{-- <button type="submit" class="btn btn-primary text-center">Confirm Order</button> --}}

                            </div>

                        </div>



                    </div>


                </section>





            </div>
            <div class="



            {{-- abc --}}
            @if(Auth::user() && session('#pills-complete'))
            tab-pane fade show active
            @else
            tab-pane fade show
            @endif


            " id="pills-complete" role="tabpanel" aria-labelledby="pills-complete">


            <section class="complete-sec">

                    <div class="container bg-section">

                            <div class="row center-text complete-row">

                                    <i class="fa fa-check-circle tick-mark text-center" aria-hidden="true"></i>


                                    <h2>Thankyou your order is Complete</h2>

                            </div>

                            <p></p>

                                <div style="width:200px;" class="center-text">
                                <a name="" id="" class="shooping-btn center-text" href="{{url('services-detail')}}" role="button">Continue Shooping</a>
                            </div>

                    </div>
                </section>

            </div>
        </div>



    </div>

</section>

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

                            <a href="#" class="remove-btn remove-from-cart" data-id="{{ $id }}"><i
                                    class="far fa-trash-alt"></i></a>
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
