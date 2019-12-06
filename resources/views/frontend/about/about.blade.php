@extends('layouts.user')
@section('content')


{{-- About us section --}}

<div id="myDIV">
<section class="about-heading">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background:black;">


                <img src="{{URL::asset('assets/img/about/images/image6.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">

                <div class="carousel-caption">

                    {{-- <h1>About Us</h1> --}}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="tab1-content">

    <div class="container">

        <div class="row text-center">
            <p>
<font face="roboto">
                Holistic Group has a history of serving people since 2002 with the mission to offer the best services in healthcare sector.
                After eighteen years of consistent efforts and the urge to
                serve, we have successfully established Holistic Group
                of Companies wherein we are providing services like:
                consultancy, digital marketing, event planning, home
                salon, housekeeping, web & app development, rental cars,
                e-commerce, retail, healthcare and insurance. The
                fundamental model of our business is click and mortar</font>

            </p>

            <h1 class="col-md-8 offset-md-2 vision">Vision</h1>

            <p><font face="roboto">
                To create the most fulfilling consumer
                experience with innovation as our key
                and with the goal to make lives easier.
                </font>
            </p>

            <h1 class="col-md-8 offset-md-2 mission">Mission</h1>
            <p><font face="roboto">
                We strive to be a reliable and customer-centric
                service provider to create a noteworthy experience
                for our customers and help our clients achieve excellence.</font>
            </p>


        </div>

        <div class="row center-text">


            <div class="col-md-4 offset-md-4 mt-4 mb-8">

            <img src="{{URL::asset('assets/img/md/md-circle.png')}}" alt="No Image">

                <h2 class="mt-2 mb-1 font-weight-bold">Managing Director </h2>
                <p class="mt-0 mb-2">Saqib Munawar </p>


            </div>


        </div>



    </div>


</section>

</div>

{{-- about us section end --}}






<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">

                        <img src="{{URL::asset('assets/img/about/images/image2.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">

                        <div class="carousel-caption">

                            

                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="tab1-content">

            <div class="container">

                <div class="row text-center">
                    <h2 style="color:#5aaf47">About Us:</h2>
                   
                    <font face="roboto">
                    <p>Holistic Technologies is the leading IT service and solution provider.
                    We operate a wide portfolio of tailored solutions for small, medium and enterprise level businesses
                    Holistic Technologies has made a mark in the industry by adopting a comprehensive approach using the latest 
                    to address business challenges. Our team of professionals collaborate with customers, listen to their concerns,
                    and tailor solution and services aligned with their business strategy.
                    Whatever problem you are facing with your mobile phone, computer or any other gadgets in Lahore,
                    Holistic Technologies will have it fixed at your door step in no time. 
                    Our repairers have extensive years of experience in the phone repair industry. 
                    We take pride in delivering a seamless experience from the get-go. :</p>
                    
                    <ul class="text-left" style="color:#b4b4b4">
                        <li>Networking Products</li>
                        <li>Networking Solutions</li>
                        <li>Server and Workstation Products</li>
                        <li>CCTV and IP Cameras Solutions</li>
                        <li>New Office Setup and Migration</li>
                        <li>Annual IT Support Contract</li>
                        <li>Antivirus and Internet Securities</li>
                        <li>Data Storage and Clouds</li>
                        <li>Access Control and Biometric Solutions</li>
                        <li>Telephone Exchange Solutions</li>
                        <li>Data Recovery</li>
                        <li>Repair Service (Apple, Samsung, Lenovo, HP, Dell, Huawei, Haier, Nokia, Q-mobile, Oppo)</li>
                    </ul>
                    </font>

                </div>





            </div>


        </section>



    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


        {{-- section2 --}}



        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">


                        <img src="{{URL::asset('assets/img/about/images/image1.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">

                        <div class="carousel-caption">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="tab1-content">

            <div class="container">
                
                <font face="roboto">
                <center>
                        
                    <h2>Who We Are</h2>
                    <p>Holistic DG is the leading online store committed to providing the most convenient and trusted shopping platform on the web.
                    With over 3 million products to select from, Holistic DG offers the most comprehensive listing of products.
                    From electronics, mobiles, software, networking products, appliances to everything under the sun, Holistic DG is the name to rely on. </p>
                    
                    <h2>Our Mission</h2>
                    <p>Strive to become a reliable and customer – centric service provider in the era of digital economy.</p>
                    
                    <h2>Our Purchase Protection Policy</h2>
                    <p>With a wide network of riders, you can be assured of a fast and better delivery service in 2-5 business days.
                    We only deal in 100% genuine products, safe and secure payment platform with free and easy returns. 
                    We have payment options that will suit every style. You can choose to pay through easy paisa, debit, credit card or opt for cash on delivery. 
                    We give you the choice to track your package as it makes its way to you so you always know your order status.
                    If you are unsatisfied with any aspect of your order, we have a simple 7-day return or exchange policy. </p>
                    
                    <h2>Why Choose Us</h2>
                    <p>Holistic DG has garnered a reputation for giving a personalized shopping experience at market competitive prices. 
                    The attention we give to the needs of our customers reiterates Holistic DG’s dedication and the expectation that customers keep coming back to us.</p>
                    
                    </center>
                

                <div class="row text-center">
                    <p style="color:#b4b4b4;">

                        Holistic Digital Gallery is a retail-based venture
                        of Holistic Group. We offer you online purchase
                        of IT products through mobile application
                        as well as a retail outlet.
                    </p>
                    
                    
                    </font>

                    

                    <ul>
                    </ul>

                </div>

            </div>


        </section>





    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

        {{-- section 3 --}}





        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">


                        <img src="{{URL::asset('assets/img/about/images/image3.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">

                        <div class="carousel-caption">

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="tab1-content">

            <div class="container">
                
                
                 <center>
                
            <font face="roboto">
            <h2>About Us:</h2>
            <p> Holistic Life is a venture in collaboration with State Life Insurance Corporation of Pakistan.
            We offer you to save today to secure your future with life insurance policies customized as per your needs.
            You work hard to protect the future of those you love. Life insurance provides peace of mind - not only for you, but also for your loved ones.
            Holistic Life has been providing the protection you need and the service you expect – all at a great price. </p>
            
            <p>We are dedicated to delivering greater value to our customers with a wide range of insurance policies such as: </p>

           </center>


                  
                    

                

                <div class="row text-center">
                    
                    <ul class="text-left" style="color:#b4b4b4">
                        <li>Whole Life Assurance</li>
                        <li>Endowment Assurance</li>
                        <li>Sadabahar Plan</li>
                        <li> Child Education & Marriage Plan</li>
                        <li> Shad Abad Assurance </li>
                        <li>Jeevan Saathi Assurance</li>
                        <li>Child Education & Marriage Plan</li>
                        <li>Child Protection Assurance</li>
                        <li>Sunheri Policy </li>
                        <li>Shehnai Policy</li>
                        <li> Nigehban Plan </li>
                        <li>Muhafaz Plan Assurance </li>
                        <li>Term Insurance </li>
                        <li>Retirement Insurance</li>
                        <li>Group Insurance </li>
                    </ul>

                    <center>
                    <p>We are eligible to sell all available Insurance policies and plans in State Life Bahria Town Office Lahore under Holistic Life 
                    / agents / brokers. Speak with a licensed agent today to learn more about the options.</p>
                    </center>



                    </font>


                </div>

            </div>


        </section>

    </div>


    <div class="tab-pane fade" id="pills-section4" role="tabpanel" aria-labelledby="pills-section4-tab">


        {{-- Section4 --}}


        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">

                        <img src="{{URL::asset('assets/img/about/images/image4.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">

                        <div class="carousel-caption">

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="tab1-content">

            <div class="container">

                <div class="row text-center">
                    
                  <font face="roboto">  
                    
<center>
                <h2>About Us:</h2>
                <p>Holistic Healthcare is the earliest and oldest venture of Holistic Group serving people in the field of healthcare.
                One of our distinguishing features is our team-based approach that work side by side to provide informed, attentive and culturally sensitive care to our members.
                Our kind and compassionate outlook provides a caring and friendly approach that makes all the difference in the lives of those we serve.
                Our staff is dependable and highly professional. </p>
                
                <h2>Mission and Philosophy</h2>
                <p>Our mission is to provide our clients with the highest level of quality of life that is achievable.
                We shall treat each of our clients with the dignity and respect they deserve, as though we were caring for a member of our own family. </p>
                
                <h2>Our Values include the following:</h2>
                
                <h2>Commitment</h2>
                <p>We are dedicated to providing the best standard of care for everyone.</p>
                
                <h2>Mutual Trust and Respect</h2>
                <p>Common courtesy creates a positive work environment. An honest, compassionate and positive interaction with every patient, family member,
                and team member is essential to a productive business relationship.</p>
                
                </center>

                 <div class="row text-center">
                    
                    <ul class="text-left" style="color:#b4b4b4">
                        <li>Home nursing service</li>
                        <li>Babysitting</li>
                        <li>Caregiver service</li>
                        <li>Physiotherapy</li>
                        <li>Speech therapy</li>
                        <li>Elderly care service</li>
                        <li>Patient care service</li>
                       
                    </ul>

                     </font>
                </div>

            </div>


        </section>


    </div>










    <div class="tab-pane fade" id="pills-section5" role="tabpanel" aria-labelledby="pills-section5-tab">

        {{-- Section 5 --}}





        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">

                        <img src="{{URL::asset('assets/img/about/images/image5.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">


                        <div class="carousel-caption">

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

<section class="tab1-content">

    <div class="container">
 
         
 
        <div class="row text-center">
           <center>
                    
                
                
                 <h2>Who We Are</h2>

                <p>We are the very first certified company that has been taking care of elderly individuals and patients in major cities of Pakistan since 2006.
                During this time, we have served about 5000 patients.
                 </p>
                
                <h2>Why We Exist</h2>
                <p>The Second Home, formerly known as Fraternity Old Age Home, is one of the pioneers in providing quality health care services in Pakistan to elderly people.</p>
                
                <h2>Our Mission</h2>
                <p>To consistently provide the highest quality care that helps everyone live a fulfilled life.
                Our compassionate and dedicated team will endeavor to deliver state-of-the-art care in a nurturing and safe environment.
                Every member of our community, resident and employee, will be valued for their individuality while being treated with kindness and respect.
                Come by today for a tour of our outstanding senior independent living community. You won’t be disappointed.</p>
                
                
                                        <h2>Service Offered:</h2>
                </center>
                



                    
                        <ul class="text-left" style="color:#b4b4b4">
                            <li>Residence</li>
                            <li>Medication</li>
                            <li>Mental and physical Healthcare</li>
                            <li>Quality Food</li>
                            <li>Recreation</li>
                        </ul>



        </div>



    </div>


</section>

        

    </div>






    <div class="tab-pane fade" id="pills-section6" role="tabpanel" aria-labelledby="pills-section6-tab">

        {{-- Section 6 --}}





        <section class="about-heading">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background:black;">

                           <img src="{{URL::asset('assets/img/about/images/image6.jpg')}}" style="max-height:480px; opacity:75%;" class="d-block w-100" alt="...">


                        <div class="carousel-caption">

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

<section class="tab1-content">

    <div class="container">

        <div class="row text-center">
            <p>
<font face="roboto">
                Holistic Group has a history of serving people since 2002 with the mission to offer the best services in healthcare sector.
                After eighteen years of consistent efforts and the urge to
                serve, we have successfully established Holistic Group
                of Companies wherein we are providing services like:
                consultancy, digital marketing, event planning, home
                salon, housekeeping, web & app development, rental cars,
                e-commerce, retail, healthcare and insurance. The
                fundamental model of our business is click and mortar</font>

            </p>

            <h1 class="col-md-8 offset-md-2 vision">Vision</h1>

            <p><font face="roboto">
                To create the most fulfilling consumer
                experience with innovation as our key
                and with the goal to make lives easier.
                </font>
            </p>

            <h1 class="col-md-8 offset-md-2 mission">Mission</h1>
            <p><font face="roboto">
                We strive to be a reliable and customer-centric
                service provider to create a noteworthy experience
                for our customers and help our clients achieve excellence.</font>
            </p>


        </div>

        <div class="row center-text">


            <div class="col-md-4 offset-md-4 mt-4 mb-8">

            <img src="{{URL::asset('assets/img/md/md-circle.png')}}" alt="No Image">

                <h2 class="mt-2 mb-1 font-weight-bold">Managing Director </h2>
                <p class="mt-0 mb-2">Saqib Munawar </p>


            </div>


        </div>



    </div>


</section>

        

    </div>


</div>












 

























{{-- 6 icon tabs --}}

<h1 class="meet-team">Our Companies</h1>



<section class="five-icons">

    <div class="row text-center">

        <div class="container">

            <ul class="nav nav-pills" id="pills-tab" role="tablist" style="margin-bottom: 55px;">
                
               
                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://www.holisticgroup.com.pk/')" id="pills-section6-tab" data-toggle="pill" href="#pills-section6" role="tab"
                        aria-controls="pills-section4" aria-selected="false">
                        <img src="{{URL::asset('assets/img/about/icons/hlisticaboutlogo.png')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">

                    </a>
                    <h4 class="text-center">Holistic Group of Compenies</h4>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://holisticdg.com/')" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">

                        <img src="{{URL::asset('assets/img/about/icons/company-logo5.jpg')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">

                    </a>
                    <h5 class="text-center">Holistic Digital Gallery</h5>

                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://www.holistictechnologies.com.pk/')" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">

                        <img src="{{URL::asset('assets/img/about/icons/company-logo1.jpg')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">

                    </a>
                    <h5 class="text-center">Holistic Technologies</h5>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://www.holisticlife.com.pk/')" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">

                        <img src="{{URL::asset('assets/img/about/icons/company-logo4.jpg')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">
                    </a>
                    <h5 class="text-center">Holistic Life</h5>
                </li>

                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://holistic.com.pk/')" id="pills-section4-tab" data-toggle="pill" href="#pills-section4" role="tab"
                        aria-controls="pills-section4" aria-selected="false">
                        <img src="{{URL::asset('assets/img/about/icons/company-logo3.jpg')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">
                    </a>
                    <h4 class="text-center">Holistic Health Care</h4>
                </li>

                <li class="nav-item">
                    <a class="nav-link mb-1" onclick="myFunction('https://holistic.com.pk/fraternity/')" id="pills-section5-tab" data-toggle="pill" href="#pills-section5" role="tab"
                        aria-controls="pills-section4" aria-selected="false">
                        <img src="{{URL::asset('assets/img/about/icons/company-logo2.jpg')}}" class="logo-img" alt="image" style="width: 120px;
                        border-radius: 100px;">

                    </a>
                    <h4 class="text-center">Second Home</h4>
                </li>
                
                
                
                
                

            </ul>

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


<script>
    function myFunction(url) {
      var x = document.getElementById("myDIV");
      x.style.display = "none";
      $("html, body").animate({ scrollTop: 0 }, "slow");
      
       window.open(url,'_blank');
 
    }
    </script>


@endsection
