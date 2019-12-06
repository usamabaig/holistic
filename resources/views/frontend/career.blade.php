@extends('layouts.user')
@section('content')




<section class="about-heading">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background:black;">


                <img src="{{URL::asset('assets/img/about/images/careers-1.jpg')}}" style="max-height:380px; opacity:75%;" class="d-block w-100" alt="...">

                <div class="carousel-caption">

                    {{-- <h1>About Us</h1> --}}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="tab1-content">

    <div class="container">

        <div class="row center-text">
            <h1>CAREERS</h1>
            <p>
                Join our Growing, Creative & Diverse Team! Experience a new level of success with an industry leading group. At Holistic Group we bring a unique understanding, assessment and interpretation to our clients. 
           </p>
        </div>

        <div class="row center-text">

            <h1>Experienced Professionals</h1>
                <p>
            Join a highly successful company that is growing year on year. You will grow with us, learning a diverse set of technologies and pursuing the type of work that interests you most.          </p>
        </div>

        <div class="row center-text">

            <h1>Students and Graduates</h1>
                <p>
               Exciting opportunities await for students and graduates to kick start their careers </p>
       </div>



    </div>


</section>






@endsection
