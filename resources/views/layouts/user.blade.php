<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>


    @include('frontend.includes.head')

</head>

<!-- Start Preloader Area -->
<div class="preloader">
    <div class="loader">
        <div class="icon">
            <img src="{{URL::asset('assets/img/logo/left-main-icon.png')}}" class="logo-img" alt="image">
        </div>
    </div>
</div>
<!-- End Preloader Area -->


@include('frontend.includes.header')

<body>

    @yield('content')

</body>

@include('frontend.includes.footer')
@include('frontend.javascript.javascript')


