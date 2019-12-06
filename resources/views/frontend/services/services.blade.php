@extends('layouts.user')
@section('content')


<!-- Start Main Banner Area -->

<section class="carousel-slider service-slide ">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">


        <div class="carousel-inner">

            <div class="carousel-item active">
                @if(isset($services['banner_image']['url']))
                <img src="{{$services['banner_image']['url']}}" style="max-height:520px;" class="d-block w-100"
                
                    alt="...">
                @endif
                <div class="carousel-caption">
                    <h1>{{$services->name}}
                    </h1>

                    {{-- static servcies for mobile view --}}


                    <div class="center-text"></div>


                    <div class="services-sec-right mobile-resp" style="position:fixed ; ">
                        <div class="service-heading">{{$services->name}} for:</div>

                        <ul>
                            @if(isset($subServices))
                            @foreach($subServices->take(3) as $key => $subService)

                            <li><a class="button-services"
                                    href="/services-details/{{$subService->id}}">{{ $subService->name ?? '' }}

                                </a></li>

                            @endforeach
                            @endif
                        </ul>

                    </div>

                </div>

            </div>
        </div>


    </div>
    </div>



    <!-- End Main Banner Area -->

    {{-- popup --}}



    <script>
        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox();
        });
    </script>


    {{-- Category Section fixed section --}}

    <div class="services-sec-right services-fixed-class" style="position:fixed ; z-index:3">
        <div class="service-heading">{{$services->name}} for:</div>

        <ul>
            @if(isset($subServices))
            @foreach($subServices->take(3) as $key => $subService)

            <li><a class="button-services"
                    href="/services-details/{{$subService->id}}">{{ $subService->name ?? '' }}

                    <b style=" font-weight: bold;
                    float: right;
                margin-right: 10px;"> > </b>

                </a></li>

            @endforeach
            @endif
        </ul>

    </div>


    <section class="home-services">
        <div class="container">

            <h1>Select a {{$services->name}}</h1>

            <div class="row">
                @if(isset($subServices))
                @foreach($subServices as $key => $subService)


                <a href="/services-details/{{$subService->id}}" data-toggle="lightbox" data-gallery="gallery"
                    class="col-md-3 service-img">
                    <img src="{{$subService['picture'][0]['url']}}" class="img-fluid rounded">
                    <div class="image-text">{{ $subService->name ?? '' }}</div>
                </a>

                {{--<a href="#openModal-about3" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 service-img">
                    <img src="https://images.unsplash.com/photo-1512207576147-99bc3066b621?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=60"
                        class="img-fluid rounded">
                    <div class="image-text">Women Message Service</div>
                </a>--}}


                {{--<div id="openModal-about3" class="modalDialog" style="z-index:9999;">
                    <div>
                        <a href="#close" title="Close" class="close">X</a>


                        <section class="message-service">

                            <div class="container">

                                <div class="row">


                                    <h2 class="title text-center">Privacy Policy</h2><br>




                                    <p class="paragraph">

                                        <b class="text-left">For the Protection Purpose</b><br>

                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.<br><br>


                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.<br><br>


                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.<br><br>


                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.<br><br>


                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.<br><br>


                                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying
                                        out print, graphic or web designs. The passage is attributed to an unknown
                                        typesetter in the 15th century who is thought to have scrambled parts of
                                        Cicero's De Finibus Bonorum et Malorum for use in a type specimen book. <br><br>

                                    </p>


                                    <label>Upload Your CNIC (front Side)
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                        </label>
                                        <br>



                                        <button type="submit" class="btn"><a href="{{url('services-detail')}}">Next</a></button>



            </div>


    </section>

    </div>

    </div>--}}
    @endforeach
    @endif
    </div>

    </div>
</section>

{{-- Home Service by Nouman -end --}}


    <!-- Start Working Process Area -->
    <section class="working-process-area p-0 mb-15">
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



{{-- how it Works section --}}

<section class="how-works">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 left-section">
                <h1>How it works</h1>

                <div class="my-icon">
                    <div class="row">
                        {{--<div class="col-md-1 col-2">
                            <i class="fa fa-long-arrow-right my-icon">
                            </i>
                        </div>--}}

                        <div class="col-md-11 col-9">
                        {!! $services->how_it_work !!}
                        </div>
                    </div>
                </div>

                

            </div>
            <div class="col-md-6">
                <img src="{{$services['how_it_work_picture']['url']}}"
                    class="resp-img">

            </div>
        </div>
    </div>
</section>




{{-- testimonials --}}

{{-- <section class="testimonials">
        <div class="container">
            <h1>Beauticans</h1>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="item">
                        <img src="https://images.unsplash.com/photo-1506919258185-6078bba55d2a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=815&q=80"
                            class="testimonials-faces">
                        <div class="name">Matthew Perkins</div>
                        <small class="desig">Driver</small>
                        <div class="share"><i class="fa fa-facebook"></i><i class="fa fa-twitter"></i><i
                                class="fa fa-instagram"></i></div>
                        <p>Just had my laptop resurrected and the engineer was fantastic. Very patient, very
                            knowledgeable and knew exactly what he was doing. If I ever have another computer
                            problem, I'll definitely give these guys a call. They are professionals and they have
                            great customer service. Great price, great job, thanks a lot!</p>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="item">
                        <img src="https://livedemo00.template-help.com/wt_prod-10943/images/testimonials-2-120x120.jpg"
                            class="testimonials-faces">
                        <div class="name">Elizabeth Johnson</div>
                        <small class="desig">Real Estate agent</small>
                        <div class="share"><i class="fa fa-facebook"></i><i class="fa fa-twitter"></i><i
                                class="fa fa-instagram"></i></div>
                        <p>My friend recommended Repair & Fix to me when I had some issues with my laptop. I
                            contacted them and they were very understanding, helpful and prompt with dealing with my
                            requirements. Your consultants were happy to talk me through everything during the first
                            consultation. Thank you!</p>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="item">
                        <img src="https://livedemo00.template-help.com/wt_prod-10943/images/testimonials-3-120x120.jpg"
                            class="testimonials-faces">
                        <div class="name">Walter Knight</div>
                        <small class="desig">Photographer</small>
                        <div class="share"><i class="fa fa-facebook"></i><i class="fa fa-twitter"></i><i
                                class="fa fa-instagram"></i></div>
                        <p>I have worked with Repair & Fix for several years. They re-built a computer for me and
                            later upgraded it and now it feels just like a new one. The value, quality, and
                            follow-up are outstanding. I highly recommend this company, their professionalism and
                            customer care are unmatched.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

{{-- faq section --}}

<section class="faq">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <div class="row">
            @foreach($FAQs as $FAQ )
            <div class="col-md-12">

                <div class="wrapper center-block">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        {{$FAQ->question}}    <i class="fas fa-arrow-down" style="float:right;"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body">
                                    {{$FAQ->answer}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            <div class="offset-md-6"></div>
        </div>
    </div>
</section>




<section class="faq">

    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <h1>All About</h1>

            </div>


            <div class="row" style="padding-left:30px; padding-right:30px;">
                    {!!($services->description)!!}

            </div>



        </div>
    </div>


</section>





<section class="faq">

    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <h1>Latest Customer Reviews</h1>

            </div>

        </div>
            <ul class="user-comments">

                @if(isset($comments))

                @foreach ($comments as $comment)


                <div class="row">

                    <div class="col-md-1 pr-0 mr-0 mb-2 col-2 mr-sm-2">

                        <i class="fa fa-user-circle user-icon" aria-hidden="true"></i>

                    </div>

                    <div class="col-md-10 text-left mb-2 col-10">


                            <a class="text-left ml-md-2 ml-4">{{$comment->full_name}}</a>

                            <p class="text-left ml-md-2 ml-4"><i class=" ">"{{$comment->comment}}"</i> </p>

                    </div>
                    <div class="offset-md-1"></div>

                </div>

                @endforeach
                @endif


            </ul>



    </div>


</section>

@endsection

<style>
    .img-fluid {
        max-width: 100%;
        height: auto;
        padding: 5px;
    }
</style>
