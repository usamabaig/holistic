@extends('layouts.user')
@section('content')


<?php
use App\Cnic;
use Illuminate\Support\Facades\Auth;

?>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style>
    #wrapper {
        overflow: hidden;
        transition: height 200ms;
        height: 0;
    }
</style>

    
</head>


<div class="row">

    @if(session('success'))

    <div class="alert alert-success text-center w-100" role="alert">
        <strong>{{session('success')}}</strong>
    </div>

    @endif

</div>


<section class="services-detail">

    <div class="container">

        <div class="row">
            <div class="col-md-3 left-sec services">
                <ul class="services-left">
                    <h4>Services</h4>
                    @foreach($services->take(10) as $service)
                    <li class="categories" id="{{$service->id}}"><a href="#">{{$service->name}}</a></li>
                    @endforeach
                </ul>

                    <div id="wrapper">
                    <ul class="services-left" id="list">

                        @foreach($services->skip(10) as $service)
                        <li class="categories" id="{{$service->id}}"><a href="#">{{$service->name}}</a></li>
                        @endforeach

                    </ul>
                </div>

                <button class="services-left-btn text-center" id="button">MORE</button>

                <div id="wrapper">
                    <ul class="services-left" id="list">

                        @foreach($services->skip(1) as $service)
                        <li class="categories" id="{{$service->id}}"><a href="#">{{$service->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
             
                
            </div>
            <div class="col-md-9" id="services-section">

                @if($allservices == 1)
                @foreach($SubServices as $service)
                <div class="col-md-12">
                    <div class="row right-sec">
                        <div class="col-md-4">
                            @foreach($service->picture as $media)
                            <div class="card">
                                <div class="card-img-top card-img-top-250">
                                    <img class="services-img-sec" src="{{$media->url}}" alt="Carousel 1">
                                </div>
                                <div class="card-body pt-2">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-8">
                            <h2>{{$service->name}}</h2>
                            <div class="top-sec">

                                <?php

                                    if(Auth::check()){
                                    $user_id = Auth::user()->id;
                                    }
                                    else{
                                    $user_id = NULL;
                                    }

                                    $is_cnic_exist = Cnic::where('subservice_id', $service->id)->where('user_id', $user_id)->first();

                                    // dd($is_cnic_exist->toArray());

                                    ?>


                                <div class="rating">

                                    {{-- <input id="input-1" name="rate" class="rating rating-loading" data-min="0"
                                                data-max="5" data-step="1" value="{{ $service->userAverageRating }}"
                                    data-size="xs">

                                    <input type="hidden" name="id" required="" value="{{ $service->id }}">

                                    <span class="review-no">0 reviews</span>

                                    <br />

                                    <button class="btn btn-success">Submit Review</button> --}}

                                </div>


                                <div class="rating"><label for="e4">☆</label><label for="e4">☆</label><label for="e4">☆</label><label for="e4">☆</label><label for="e4">☆</label></div>
                                
                                <div class="review"> 0 Reviews</div>
                                
                                {{--<div class="review-submit"> Submit a review</div>--}}

                                <div class="review-submit">
                                    <a href="#openModal-comment{{$service->id}}" id="{{$service->id}}">Write a
                                        comment</a>
                                </div>


                                <!--Modal start-->

                                <div id="openModal-comment{{$service->id}}" class="modalDialog" style="z-index:9999;">

                                    <div class="row .home-cat-modal w-100" style="height: 350px;">

                                        <a name="" id="" class="btn close" href="#close" role="button">Close</a>

                                        <section>
                                            <div class="container">

                                                <p>Write a comment ...</p>

                                                <form action="{{url('comments-post')}}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="sub_service_id" value="{{$service->id}}">

                                                    <textarea class="w-100" name="comment" id="" cols="60"
                                                        rows="10"></textarea>

                                                    <button type="submit" class="btn btn-primary mt-1">Comment</button>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!--Modal end-->



                            </div>
                            <hr>
                            @if($service->charges != 0 && !empty($service->charges))
                            <h3>{{$service->charges}} pkr</h3>
                            @else
                            <h3>Depend on customer requirements</h3>
                            @endif
                            <p>
                                <!--{{$service->description}}-->
                                {!!substr($service->description, 0, 150)!!}...

                            </p>

                            {{-- {{$service->is_women}} --}}


                            @if($service->is_women == 0 )

                            {{-- @if($service->is_women == 0) --}}


                            <a class="btn custom-cart-btn" href="/add-to-cart/{{$service->id}}">Add to cart</a>

                            <a class="btn custom-cart-btn" href="/checkout/{{$service->id}}">Checkout</a>


                            @elseif($service->is_women == 1 && $is_cnic_exist == NULL && Auth::user() )


                            <a href="#openModal-about3" data-toggle="lightbox" data-gallery="gallery"
                                class="btn custom-cart-btn">
                                Add to Cart

                            </a>

                            <a href="#openModal-about3" data-toggle="lightbox" data-gallery="gallery"
                                class="btn custom-cart-btn">
                                Checkout

                            </a>






                            <div id="openModal-about3" class="modalDialog" style="z-index:9999;">
                                <div>
                                    <a href="#close" title="Close" class="text-right text-secondary">Close</a>


                                    <section class="message-service">

                                        <div class="container">

                                            <div class="row">


                                                <h2 class="title text-center">Privacy Policy</h2><br>


                                                <p class="paragraph">

                                                    <b class="text-left">For the Protection Purpose</b><br>

                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book.<br><br>


                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book.<br><br>


                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book.<br><br>


                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book.<br><br>


                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book.<br><br>


                                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                                    in laying
                                                    out print, graphic or web designs. The passage is attributed to an
                                                    unknown
                                                    typesetter in the 15th century who is thought to have scrambled
                                                    parts of
                                                    Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                                    book. <br><br>

                                                </p>

                                            </div>


                                            <form action="{{url('uploadcnic')}}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <br>

                                                <input type="hidden" name="subservice_id" value="{{$service->id}}">

                                                <label>Upload Your CNIC (front Side)
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                    <input type="file" name="cnic_front" required>

                                                </label>
                                                <br>



                                                <label>Upload Your CNIC (Back Side)
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                    <input type="file" name="cnic_back" required>
                                                </label>
                                                <br><br>

                                                <input type="submit" value="submit" name="submit"
                                                    class="btn text-secondary">


                                            </form>



                                    </section>

                                </div>

                            </div>

                            @elseif (Auth::guest())


                            <a class="btn custom-cart-btn" href="/signin">Login first to Verify your identity</a>


                            @else


                            <a class="btn custom-cart-btn" href="/add-to-cart/{{$service->id}}">Add to cart</a>

                            <a class="btn custom-cart-btn" href="/checkout/{{$service->id}}">Checkout</a>



                            @endif

                            {{-- <a class="btn custom-cart-btn" href="/add-to-cart/{{$service->id}}">Add to cart</a>




                            <a class="btn custom-cart-btn" href="/checkout/{{$service->id}}">Checkout</a>

                            <i class="fa fa-heart custom-heart-icon" aria-hidden="true"></i> --}}

                        </div>
                    </div>
                </div>

                @endforeach
                @endif
            </div>
            <div class="col-md-9" id="services-section">
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
                                <span class="price">{{ $details['price'] }} pkr</span>
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

                    <span class="subtotal">{{ $total }} pkr</span>
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


<script type="text/javascript">
    $("#input-id").rating();

</script>



<script>

$(function() {
  var b = $("#button");
  var w = $("#wrapper");
  var l = $("#list");

  // w.height(l.outerHeight(true)); REMOVE THIS

  b.click(function() {

    if (w.hasClass('open')) {
      w.removeClass('open');
      w.height(0);
    } else {
      w.addClass('open');
      w.height(l.outerHeight(true));
    }

  });
});

</script>


@endsection
