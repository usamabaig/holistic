<!-- Start Footer Area -->
<footer class="footer-area optional-color mt-5" style="z-index:9999;">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Services</h3>

                    <ul class="services-list">

                        <?php
                                    use App\Facility;
                                    $services = Facility::orderBy('id','desc')->get()->take(8);
                                    ?>

                        @foreach ($services as $service)

                        <li><a href="#">{{$service->name}}</a></li>

                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Categories</h3>

                    <ul class="services-list">

                        <?php
                            use App\ServiceCategory;
                            $categoryMenu = ServiceCategory::orderBy('id','desc')->get()->take(8);
                            ?>
                        @foreach($categoryMenu as $menu)

                        <li><a href="/services/{{$menu->id}}">{{ $menu->name }}</a></li>

                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <div class="single-footer-widget">
                    <h3>Quick Links</h3>

                    <ul class="services-list">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/services-detail')}}">Shop</a></li>
                        <li><a href="{{url('/about')}}">Who We Are</a></li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        <li><a href="{{url('/term')}}">Terms & Policy</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-4 col-md-8">
                <div class="single-footer-widget">
                    <h3>Working Hours</h3>

                    <ul class="footer-contact-list">

                            <?php

                            use App\HeaderFooter;
                            $headerfooter= HeaderFooter::orderBy('id','desc')->get();

                            ?>

                            @foreach ($headerfooter as $footer)



                        <li><span>Address:</span> {{$footer->address}} </li>
                        <li><span>Email:</span> <a href="#"> {{$footer->email}} </a></li>
                        <li><span>Phone:</span> <a href="#"> {{$footer->phone_no}} </a></li>
                        <!--<li><span>Fax:</span> <a href="#"> {{$footer->fax}} </a></li>-->


                    </ul>
                </div>
                <div class="pt-2">
                    <div class="single-footer-widget">
                        <ul class="social">
                            <li><a href="http://{{$footer->facebook}}" target="_blank"><i class="fab fa-facebook-f icon-spacing"></i></a></li>
                            <li><a href="http://{{$footer->twitter}}" target="_blank"><i class="fab fa-twitter icon-spacing"></i></a></li>
                            <li><a href="http://{{$footer->insta}}" target="_blank"><i class="fab fa-instagram icon-spacing"></i></a></li>
                            <li><a href="http://{{$footer->youtube}}" target="_blank"><i class="fab fa-youtube icon-spacing"></i></a></li>

                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="pt-2">
                    <form action="#" method="post" novalidate="novalidate">
                        <div class="row mt-2">


                            <div class="col-lg-7 col-md-8 col-sm-12 p-0">
                                <input type="text" class="form-control search-bottom" placeholder="Search"
                                    style="border-radius:0;border:none;">
                            </div>


                            <div class="col-lg-3 col-md-6 p-0">
                                <button type="button" class="btn btn-search btn-sm"
                                    style="padding:9px 15px 9px 15px;border-radius:0;border:none;">Search</button>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="row two-icons">
                    <div class="col-lg-4 col-md-6">
                        <img src="{{URL::asset('assets/img/playstore.png')}}" width="150">
                    </div>
                    <div class="col-lg-4 col-md-6 play-icon">
                        <img src="{{URL::asset('assets/img/applestore.png')}}" width="150">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <span><p>Copyright 2019 | Powered by TrodoSoft | All Rights Reserved.</p>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
