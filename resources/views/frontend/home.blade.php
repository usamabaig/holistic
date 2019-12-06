@extends('layouts.user')

@section('content')


@push('meta')
	<meta name="keyword" content="Shop Online in Lahore, Shop in Pakistan, Online Shopping, Store, Apple, Samsung, Android, Brands, Buy, Buy mobiles online, Electronics, Computers, Cameras, TVs, Tablets Mobile Phones, Laptops, Deals, Pakistan, Lahore, Pakistan, Offers, Promotion"/>
	<meta name="description" content="Holistic DG is the leading online store committed to providing most trusted and convenient shopping platform on the web from electronics, mobiles and much more"/>
	<title>Online Shopping Store | Shop Online in Lahore | Best Online Store in Pakistan</title>
	<meta property="og:description" content="Holistic DG is the leading online store committed to providing most trusted and convenient shopping platform on the web from electronics, mobiles and much more"/>

	<meta property="og:title" content="Holistic DG Pakistan" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="//www.holisticdg.com" />
	<meta property="og:site_name" content="Holistic DG Pakistan" />
@endpush

<!-- Start Main Banner Area -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
<style>

.hidden {
display:none;
}

</style>

<script>

function toggler(divId) {
    $("#" + divId).show();
}
</script>
    
    
</head>



<?php
        use App\Slider;
        $sliders =Slider::select('image', 'title', 'description')->where('status', '=', '1')->get();
        ?>
<section class="carousel-slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                <img src="{{ $slider->image }}" class="d-block w-100" alt="...">
                <div class="carousel-caption" style="z-index:2;">
                    <h1><span>{{ $slider->title }}</span> </h1>
                    <p class="lead">{{ $slider->description }}</p>
                    {{-- <a href="#" class="btn btn-lg btn-primary">Learn More</a> --}}
                </div>

            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>


    <section class="search-sec m-0 p-0" style="z-index:1;">
        <div class="container">
            <form action="#" method="post" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-1">

                                <select name="" class="form-control select-box" id="">
                                    <option selected>Select City</option>
                                    <option value="">Lahore</option>
                                    <option value="">Karachi</option>
                                    <option value="">Islamabad</option>

                                </select>


                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-12 p-1">



                                {{--<select class="form-control search-slt" style="overflow-x: hidden; overflow-y: scroll;">
                                    <option selected>Select Services</option>
                                        @foreach($facilities as $facility)
                                            <option value="{{$facility['id']}}">{{$facility['name']}}</option>
                                        @endforeach  
                                </select>--}}
                                
                                <!--<form action="#" method="">-->
                                <!--    <input type="text" disabled class="form-control search-slt" placeholder="Search Service">-->
                                <!--</form>-->



                                <style>
                                * {
                                  box-sizing: border-box;
                                }

                                /*the container must be positioned relative:*/
                                .autocomplete {
                                  position: relative;
                                  display: inline-block;
                                }

                                input {
                                  border: 1px solid transparent;
                                  /* padding: 10px; */
                                  font-size: 16px;
                                  padding-top: 5px;
                                }

                                input[type=text] {
                                  width: 100%;
                                }

                                input[type=submit] {
                                  background-color: DodgerBlue;
                                  color: #fff;
                                  cursor: pointer;
                                }

                                .autocomplete-items {
                                  position: absolute;
                                  border-bottom: none;
                                  border-top: none;
                                  z-index: 9999;
                                  top: 100%;
                                  left: 0;
                                  right: 0;
                                  overflow-y: auto;
                                  max-height: 170px;
                                }

                                .autocomplete-items div {
                                  padding: 10px;
                                  cursor: pointer;
                                  background-color: #fff;
                                  border-bottom: 1px solid #d4d4d4;
                                }

                                /*when hovering an item:*/
                                .autocomplete-items div:hover {
                                  background-color: #e9e9e9;
                                }

                                /*when navigating through the items using the arrow keys:*/
                                .autocomplete-active {
                                  background-color: DodgerBlue !important;
                                  color: #ffffff;
                                }
                                </style>


                                <!--Make sure the form has the autocomplete function switched off:-->
                                <form autocomplete="off" action="#">
                                  <div class="autocomplete form-control search-slt">
                                    <input autocomplete="off" id="myInput" type="text" name="myCountry" placeholder="Search">
                                  </div>
                                  {{-- <input type="submit"> --}}
                                </form>

                                <script>
                                function autocomplete(inp, arr) {
                                  /*the autocomplete function takes two arguments,
                                  the text field element and an array of possible autocompleted values:*/
                                  var currentFocus;
                                  /*execute a function when someone writes in the text field:*/
                                  inp.addEventListener("input", function(e) {
                                      var a, b, i, val = this.value;
                                      /*close any already open lists of autocompleted values*/
                                      closeAllLists();
                                      if (!val) { return false;}
                                      currentFocus = -1;
                                      /*create a DIV element that will contain the items (values):*/
                                      a = document.createElement("DIV");
                                      a.setAttribute("id", this.id + "autocomplete-list");
                                      a.setAttribute("class", "autocomplete-items");
                                      /*append the DIV element as a child of the autocomplete container:*/
                                      this.parentNode.appendChild(a);
                                      /*for each item in the array...*/
                                      for (i = 0; i < arr.length; i++) {
                                        /*check if the item starts with the same letters as the text field value:*/
                                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                          /*create a DIV element for each matching element:*/
                                          b = document.createElement("DIV");
                                          /*make the matching letters bold:*/
                                          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                          b.innerHTML += arr[i].substr(val.length);
                                          /*insert a input field that will hold the current array item's value:*/
                                          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                                          /*execute a function when someone clicks on the item value (DIV element):*/
                                          b.addEventListener("click", function(e) {
                                              
                                              $.ajax({
                                                url: "searchPackages/",
                                                type: 'get',
                                                success: function (response) {
                                                    window.location.href = '/searchPackages';
                                                }
                                            });
                                            
                                              /*insert the value for the autocomplete text field:*/
                                              inp.value = this.getElementsByTagName("input")[0].value;
                                              /*close the list of autocompleted values,
                                              (or any other open lists of autocompleted values:*/
                                              closeAllLists();
                                          });
                                          a.appendChild(b);
                                        }
                                      }
                                  });
                                  /*execute a function presses a key on the keyboard:*/
                                  inp.addEventListener("keydown", function(e) {
                                      var x = document.getElementById(this.id + "autocomplete-list");
                                      if (x) x = x.getElementsByTagName("div");
                                      if (e.keyCode == 40) {
                                        /*If the arrow DOWN key is pressed,
                                        increase the currentFocus variable:*/
                                        currentFocus++;
                                        /*and and make the current item more visible:*/
                                        addActive(x);
                                      } else if (e.keyCode == 38) { //up
                                        /*If the arrow UP key is pressed,
                                        decrease the currentFocus variable:*/
                                        currentFocus--;
                                        /*and and make the current item more visible:*/
                                        addActive(x);
                                      } else if (e.keyCode == 13) {
                                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                                        e.preventDefault();
                                        if (currentFocus > -1) {
                                          /*and simulate a click on the "active" item:*/
                                          if (x) x[currentFocus].click();
                                        }
                                      }
                                  });
                                  function addActive(x) {
                                    /*a function to classify an item as "active":*/
                                    if (!x) return false;
                                    /*start by removing the "active" class on all items:*/
                                    removeActive(x);
                                    if (currentFocus >= x.length) currentFocus = 0;
                                    if (currentFocus < 0) currentFocus = (x.length - 1);
                                    /*add class "autocomplete-active":*/
                                    x[currentFocus].classList.add("autocomplete-active");
                                  }
                                  function removeActive(x) {
                                    /*a function to remove the "active" class from all autocomplete items:*/
                                    for (var i = 0; i < x.length; i++) {
                                      x[i].classList.remove("autocomplete-active");
                                    }
                                  }
                                  function closeAllLists(elmnt) {
                                    /*close all autocomplete lists in the document,
                                    except the one passed as an argument:*/
                                    var x = document.getElementsByClassName("autocomplete-items");
                                    for (var i = 0; i < x.length; i++) {
                                      if (elmnt != x[i] && elmnt != inp) {
                                        x[i].parentNode.removeChild(x[i]);
                                      }
                                    }
                                  }
                                  /*execute a function when someone clicks in the document:*/
                                  document.addEventListener("click", function (e) {
                                      closeAllLists(e.target);
                                  });
                                }

                                /*An array containing all the country names in the world:*/
                                var items_array = JSON.parse('<?php echo str_replace("'", "\'", json_encode($facilities)); ?>');

                                /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                                autocomplete(document.getElementById("myInput"), items_array);
                                </script>






                            </div>


                            <!--<div class="col-lg-2 col-md-3 col-sm-12 p-1 btn-se">-->
                            <!--    <button type="button" class="btn btn-search wrn-btn">SEARCH</button>-->
                            <!--</div>-->

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- End Main Banner Area -->


    <!-- Start Project Area -->
    <section class="project-area m-0 p-0">
        <div class="container">
            <div class="section-title text-center">
                <h2>Our Services</h2>
                
                <p>Making your life easier is our top priority. 50+ services gets you what you need, right when you need
                    it.</p>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="shorting-menu text-center">

                        <?php
                        use App\ServiceCategory;
                        $categoryMenu = ServiceCategory::orderBy('id','desc')->where('status', 1)->get();
                        ?>

                        <!--<button class="filter active" data-filter="*">all</button>-->


                        @foreach($categoryMenu as $menu)
                        
                        <button id="category_home_id_{{$menu->id}}" class="filter" onclick="toggler('myContent');"  data-filter=".{{ $menu->id }}">{{ $menu->name }}</button>
                        
                        @endforeach


                    </div>
                </div>
            </div>



            <div class="shorting hidden" id="myContent">
                <div class="row">

                    <?php
                        use App\Facility;
                        $services = Facility::orderBy('id','desc')->get();
                        ?>


                    @foreach ($services as $service)


                    <div class="col-lg-3 col-md-6 mix {{$service->category_id}}  data-isotope='{ "
                        itemSelector": ".product-item" , "layoutMode" : "fitRows" }">
                        <div class="single-project-box">


                            @if($service->picture)
                            @foreach($service->picture as $key => $media)
                            <img src="{{ $media->getUrl() }}" class="img-fluid custom-img-boxes" alt="image">

                            @endforeach
                            @endif

                            <div class="project-content">
                                <div class="inner-content">
                                    <h3>{{$service->name}}</h3>

                                    <p>{!!substr($service->description, 0, 100)!!}...</p>
                                    <a href="services-details/{{$service->id}}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    @endforeach


                </div>
            </div>
        </div>

    </section>

    {{-- end section --}}



    <!-- Start Working Process Area -->
    <section class="working-process-area p-0 m-0">
        <div class="container">
            <div class="section-title text-center">
                <h2>Our Working Process</h2>
                <p>
                    Holistic Group of companies is a one – stop platform for multiple services.
                    This page is designed to create a fast and easy way for you to connect to your desired service.
                    </p>

            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-working-process">
                        <div class="icon">
                            <i class="flaticon-search"></i>
                        </div>
                        <h3>Choose a Service</h3>
                        <p>
                            Our team of experts will work closely with you and help to choose the service of your choice.
                            From repair & maintenance, retail service, digital marketing and much more.

                        </p>
                        <div class="back-text">
                            1
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-working-process">
                        <div class="icon">
                            <i class="flaticon-help"></i>
                        </div>
                        <h3>Get a Free Quote</h3>
                        <p>
                            Feel free to send us an inquiry and we will provide you with a quote free of cost.
                            We will give you the best resource that fit your needs and budget.

                        </p>
                        <div class="back-text">
                            2
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                    <div class="single-working-process">
                        <div class="icon">
                            <i class="flaticon-like"></i>
                        </div>
                        <h3>Your Work Done!</h3>
                        <p>
                            The designated resource will work in collaboration with you and provide service in a timely manner.
                            Enjoy the service and provide your feedback for constant quality improvement.

                        </p>
                        <div class="back-text">
                            3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Working Process Area -->

    <section class="services-area pb-0 mt-0" style="margin-top:-150px;top:0;">
        <div class="container">
            <div class="mr-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">

                            <h1>50+ home services, what do you need help with today!</h1>
                            <p>Largest network of over 20,000 skilled home service professionals in Pakistan to help
                                you
                                with
                                all kind of jobs at home.</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="h-slider text-center">


                            <?php
                                $catMenu = ServiceCategory::orderBy('id','desc')->get();
                            ?>

                            @foreach ($catMenu as $menu)

                            <div class="st-item">
                                <a href="#openModal-about">

                                    @if(!empty($menu->picture))
                                    <img src="{{ $menu->picture->getUrl() }}">
                                    @else
                                    <img src="" alt="No image">
                                    @endif
                                    <label>{{$menu->name}}</label>
                                </a>

                            </div>

                            @endforeach

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="spacer"></div>

                </div>
            </div>
        </div>
    </section>



    <!--Modal start-->

    <div id="openModal-about" class="modalDialog" style="z-index:9999;">


        <div class="row .home-cat-modal " style="height: 420px;">
            {{-- <a href="#close" title="Close" class="close">X</a> --}}

            <a name="" id="" class="btn close" href="#close" role="button" style="margin-right:20px;">Close</a>

            <div class="col-md-4 col-sm-4 col-6 home-cat-left-popup">
                <ul class="home-cat-left-nav text-left">

                    <?php

                                $categoryMenu = ServiceCategory::orderBy('id','desc')->get();
                                ?>


                    @foreach($categoryMenu as $menu)
                    <li class="filter" data-filter=".{{ $menu->id }}" style="cursor: pointer;">


                        @if(!empty($menu->picture))
                        <img src="{{ $menu->picture->getUrl() }}" class="img-fluid left-cat-img">
                        @else
                        <img src="" alt="No img" class="img-fluid left-cat-img">
                        @endif

                        {{ $menu->name }}</li>
                    @endforeach


                </ul>
            </div>

            <div class="col-md-8 col-sm-8 col-6 .home-cat-right-popup">
                <div class="shorting" style="margin-left:-36px;">

                    <?php

                                $services = Facility::orderBy('id','desc')->get();
                                ?>

                    <ul class="home-cat-right-nav text-left">
                        @foreach ($services as $service)

                        <li class="mix {{$service->category_id}} custom-class {{$service->category_id}}">
                            <a href="services/{{$service->category_id}}">
                                {{$service->name}}

                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                            </a></li>



                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>


    <!--Modal end-->


    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Top Services</h3>
            </div>
        </div>
    </section>
    <section class="carousel slide mb-4" data-ride="carousel" id="postsCarousel">

        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right lead">
                    <a class="btn btn-secondary-outline prev" href="" title="go back" style="border:none;"><i
                            class="fa fa-lg fa-chevron-left"></i></a>
                    <a class="btn btn-secondary-outline next" href="" title="more" style="border:none;"><i
                            class="fa fa-lg fa-chevron-right"></i></a>
                </div>
            </div>
        </div><br>


        <div class="container pt-0 mt-2">
            <div class="carousel-inner services-class">
                <div class="carousel-item active">
                    <div class="card-deck">

                        <?php

                        $oldestservices = Facility::orderBy('id','asc')->get();

                        ?>


                        @foreach ($oldestservices->take(4) as $service)

                        <div class="card">
                            <div class="card-img-top card-img-top-250">


                                @if($service->picture)
                                @foreach($service->picture as $key => $media)
                                <a href="services-details/{{$service->id}}"> <img src="{{ $media->getUrl() }}"
                                        class="services-img-sec" alt=""></a>

                                @endforeach
                                @endif

                            </div>
                            <div class="card-body pt-2">

                                <h6 class="small text-center font-bold p-b-2" style="font-size:14px;">{{$service->name}}</h6>

                            </div>
                        </div>

                        @endforeach




                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">

                        <?php

                        $latestservices = Facility::orderBy('id','desc')->get();

                        ?>

                        @foreach ($latestservices->take(4) as $service)

                        <div class="card">
                            <div class="card-img-top card-img-top-250">


                                @if($service->picture)
                                @foreach($service->picture as $key => $media)
                                <a href="services-details/{{$service->id}}"> <img src="{{ $media->getUrl() }}"
                                        class="services-img-sec" alt=""></a>

                                @endforeach
                                @endif
                            </div>
                            <div class="card-body pt-2">

                                <h6 class="small text-center  p-b-2" style="font-size:14px;">{{$service->name}}</h6>

                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h3>Featured Services</h3>
            </div>
        </div>
    </section>
    <section class="carousel1 slide mb-4" data-ride="carousel" id="postsCarousel">

        <div class="container">
            <div class="row">
                <div class="col-12 text-md-right lead">
                    <a class="btn btn-secondary-outline prev1" href="" title="go back" style="border:none;"><i
                            class="fa fa-lg fa-chevron-left"></i></a>
                    <a class="btn btn-secondary-outline next1" href="" title="more" style="border:none;"><i
                            class="fa fa-lg fa-chevron-right"></i></a>
                </div>
            </div>
        </div>

        <div class="container pt-0 mt-2">
            <div class="carousel-inner services-class">
                <div class="carousel-item active">
                    <div class="card-deck">

                        <?php

                            $latestservices = ServiceCategory::orderBy('id','asc')->get();

                            ?>


                        @foreach ($latestservices->take(4) as $service)

                        <div class="card">
                            <div class="card-img-top card-img-top-250">

                                @if($service->category_picture)

                                <a href="services/{{$service->id}}"> <img src="{{$service['category_picture']['url'] }}"
                                        class="services-img-sec" alt=""></a>


                                @endif

                            </div>
                            <div class="card-body pt-2">

                                <h6 class="small text-center p-b-2" style="font-size:14px;">{{$service->name}}</h6>

                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">



                        <?php

                            $oldestservices = ServiceCategory::orderBy('id','desc')->get();

                            ?>


                        @foreach ($oldestservices->take(4) as $service)

                        <div class="card">
                            <div class="card-img-top card-img-top-250">

                                @if($service->category_picture)

                                <a href="services/{{$service->id}}"> <img src="{{$service['category_picture']['url'] }}"
                                        class="services-img-sec" alt=""></a>


                                @endif

                            </div>
                            <div class="card-body pt-2">

                                <h6 class="small text-center p-b-2" style="font-size:14px;">{{$service->name}}</h6>

                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- Start FunFacts Area -->
    <section class="funfacts-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-6">
                    <div class="single-funfacts-box">

                        <h3><span class="odometer" data-count="107">00</span>+</h3>
                        <p>Total Projects</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="single-funfacts-box">

                        <h3><span class="odometer" data-count="3">00</span> million</h3>
                        <p>Work Employed</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="single-funfacts-box">

                        <h3><span class="odometer" data-count="100000">00</span>+</h3>
                        <p>Happy clients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="single-funfacts-box">

                        <h3><span class="odometer" data-count="69">00</span>+</h3>
                        <p>Winning Awards</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Testimonials and Video Area -->
    <section class="testimonials-video">
        <div class="row m-0">
            <div class="col-lg-6 col-md-12 p-0">
                <div class="testimonials-inner">
                    <div class="section-title">
                        <span>Our testimonials</span>
                        <h2>About Us</h2>
                        <p>To create the most fulfilling consumer experience with innovation as our key and with the goal to make lives easier.</p>


                    </div>

                    <div class="testimonials-slides owl-carousel owl-theme" style="transition: all 5.25s ease 0s;">
                        <div class="testimonials-item">
                            <img src="{{URL::asset('assets/img/md/md-circle.png')}}" alt="No Image">
                               <h3>Saqib Munawar</h3>
                            <span>Founder at Holistic Group</span>

                            <p>We strive to be a reliable and customer-centric service provider to create a noteworthy experience for our customers and help our clients achieve excellence.</p>
                        </div>

                        <div class="testimonials-item">
                            <img src="{{URL::asset('assets/img/md/md-circle.png')}}" alt="No Image">
                               <h3>Saqib Munawar</h3>
                            <span>Founder at Holistic Group</span>

                            <p>We strive to be a reliable and customer-centric service provider to create a noteworthy experience for our customers and help our clients achieve excellence.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 p-0">
                <div class="video-inner">
                    <img src="assets/img/video-bg.jpg" alt="image">

                    <?php

                         use App\Testimonial;
                        $videos=Testimonial::orderBy('id','desc')->get()->take(1);

                        ?>

                    @foreach ($videos as $video)
                    <a href="{{$video->youtube_link}}" class="video-btn popup-youtube"><i
                            class="flaticon-play-button"></i></a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials and Video Area -->



    <!-- Start About Area -->
    <section class="working-process-area mb-3">
        <div class="container">
            <div class="section-title text-center">
                <h2>Payment Method</h2>
                <img src="assets/img/section-title-shape.png" alt="image">
            </div>
            <div class="row">
                <ul class="payment center-text">
                    <li><img src="assets/img/paypal.png"></li>
                    <li><img src="assets/img/visa.png"></li>
                    <li><img src="assets/img/mastercard.jpg"></li>
                    <li><img src="assets/img/easypaisa.png"></li>
                    <li><img src="assets/img/JazzCash.png"></li>

                </ul>
            </div>
        </div>
    </section>
    <!-- End About Area -->
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





    <div class="go-top"><i class="fas fa-arrow-up"></i><i class="fas fa-arrow-up"></i></div>






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

    <script>
        (function($) {
    "use strict";

    // manual carousel controls
    $('.next').click(function(){ $('.carousel').carousel('next');return false; });
    $('.prev').click(function(){ $('.carousel').carousel('prev');return false; });

})(jQuery);
    </script>
    <script>
        (function($) {
    "use strict";

    // manual carousel controls
    $('.next1').click(function(){ $('.carousel1').carousel('next');return false; });
    $('.prev1').click(function(){ $('.carousel1').carousel('prev');return false; });

})(jQuery);

    </script>




    <script type="text/javascript">
         


    </script>
    
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151148697-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151148697-1');
</script>

    @endsection
