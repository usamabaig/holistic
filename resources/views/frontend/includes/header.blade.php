<header class="header-area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="top-header-content">
                        <ul class="nav-list">
                            <li><a href="{{url('about')}}">About Us</a></li>
                        <li><a href="{{url('career')}}">Career</a></li>
                        </ul>

                        <?php

                    use App\HeaderFooter;
                    $headerfooter= HeaderFooter::orderBy('id','desc')->get();
                    ?>
                        

                            @foreach ($headerfooter as $header)
                            <ul class="social">
                            <li><a href="http://{{$header->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="http://{{$header->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="http://{{$header->insta}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="http://{{$header->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">

                    

                    <ul class="header-info">

                        <li><i class="flaticon-email"></i>

                            {{$header->address}} </li>
                        <li><i class="flaticon-phone"></i>

                            {{$header->timing}}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="middle-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="logo">

                        <a href="{{url('/')}}" class="main-logo">
                            <img src="{{URL::asset('assets/img/logo/logo.png')}}" class="logo-img" alt="image">

                        </a>

                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    <ul>
                        <li>
                            <i class="fa fa-envelope-open header-icon"></i>
                            drop us an email
                            <span>{{$header->email}}</span>
                        </li>
                        <li>
                            <i class="fa fa-phone header-icon"></i>
                            24/7 emergency service
                            <span>{{$header->phone_no}}</span>
                        </li>
                        <li>

                            @endforeach

                            <p class="reg-section">


                                @if(Auth::user())

                                <section class="dropdown-menu-header">
                                    <div class="dropdown">
                                        <div class="signin" style="z-index:9999;">


                                            <i class="fa fa-user header-icon" aria-hidden="true"></i>

                                            <div class="dropdown-content">
                                                <ul class="user-profile-sec text-center">
                                                    <li class="nav-link username">{{Auth::user()->full_name }}</li>
                                                    <li class="nav-link email">{{Auth::user()->email }}</li>
                                                    <li class="nav-link order"><a href="{{url('orders-detail')}}">Order History</a></li>

                                                    <li class="nav-link"> <a href="{{ url('/logout') }}">Logout</a></li>
                                                </ul>


                                            </div>
                                        </div>

                                    </div>
                                </section>

                                @else
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href="{{url('signin')}}" class="signin">Log In |</a>
                                <a href="{{url('signup')}}" class="register">Signup</a>

                                @endif


                            </p>


                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-area">
        <div class="fennec-mobile-nav">
            <div class="logo">
                <a href="{{url('/')}}" class="main-logo">
                    <img src="{{URL::asset('assets/img/logo/logo.png')}}" class="logo-img" alt="image">
                </a>
            </div>
        </div>

        <div class="fennec-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            <li class="nav-item"><a href="{{url('/')}}"
                                    class="nav-link {{ Request::path() ==  '/' ? 'active' : ''  }}">Home</a>
                            </li>

                            <li class="nav-item"><a href="{{url('services-detail')}}"
                                    class="nav-link {{ Request::path() ==  'services-detail' ? 'active' : ''  }}">Services
                                </a>
                            </li>

                            <li class="nav-item"><a href="{{url('about')}}"
                                    class="nav-link {{ Request::path() ==  'about' ? 'active' : ''  }}">About Us</a>
                            </li>

                            <li class="nav-item"><a href="{{url('contact')}}"
                                    class="nav-link {{ Request::path() ==  'contact' ? 'active' : ''  }}">Contact</a>
                            </li>

                            <li class="nav-item"><a href="{{url('term')}}"
                                    class="nav-link {{ Request::path() ==  'term' ? 'active' : ''  }}">Terms &
                                    Policy</a>
                            </li>

    
                            @if(Auth::user())
                            
                            <li class="nav-item mob-nav"><a href="{{url('orders-detail')}}">Order History</a></li>
                            
                            <li class="nav-item mob-nav"> <a href="{{ url('/logout') }}">Logout</a></li>
                            
                            @else

                            <li class="nav-item mob-nav"><a href="{{url('signup')}}"
                                class="nav-link mob-nav {{ Request::path() ==  'signup' ? 'active' : ''  }}">Sign Up</a>
                            </li>

                            <li class="nav-item mob-nav"><a href="{{url('signin')}}"
                                    class="nav-link mob-nav {{ Request::path() ==  'signin' ? 'active' : ''  }}">Log In</a>
                            </li>

                            @endif




                        </ul>

                        <div class="others-option">
                            <div class="option-item">
                                <a href="#" data-toggle="modal" data-target="#productsCartModal">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span class="cart-count">{{ count((array) session('cart')) }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- End Header Area -->
