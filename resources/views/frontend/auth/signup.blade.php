@extends('layouts.user')
@section('content')




{{-- Sign Up Form --}}

<section class="sign-up">
    <div class="container bg-section" style="box-shadow: -1px -2px 9px #c0c0c0;">
        <div class="row text-center">
            <div class="center-logo-img text-center">
                <img src="assets/img/logo/left-main-icon.png" class="logo-img" alt="image">
            </div>

            <div class="heading text-center container-fluid">Sign Up</div>

            <div class="col-md-12">

                <div class="pg text-center">Join our community!
                </div>


                <div class="small-text text-center">Already have an account?
                    <a href="signin" class="login-btn text-center">Login</a>
                </div>




                <div class="left-head text-left" style="color:red;">
                    Required fields *
                </div>
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-12">
                        <label for="" class="label text-left">First Name*<br>
                            <input type="text" name="first_name" class="form-control custom-form" required autocomplete="off">
                        </label>
                    </div>


                    <div class="col-md-6 col-12">
                        <label for="" class="label text-left">Last Name*<br>
                            <input type="text" name="last_name" class="form-control custom-form" required autocomplete="off">
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="label text-left">Email Address*<br>
                            <input type="email" name="email" class="form-control custom-form full-field" required autocomplete="off">
                        </label>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group-toggle text-left" >
                            <label class="checkboxes">Gender</label><br>

                            <label class="checkboxes">
                                 <input type="radio" value="male" name="gender"> Male
                            </label>
                            <label class="checkboxes">
                                 <input type="radio" value="female" name="gender"> Female
                            </label>
                            <label class="checkboxes">
                                 <input type="radio" value="custom" name="gender"> Custom
                            </label>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="label text-left">Password*<br>
                            <input type="password" name="password" class="form-control custom-form full-field" required autocomplete="off">
                        </label>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="label text-left">Phone no.*<br>
                            <input type="text" name="phone_no" class="form-control custom-form full-field" required autocomplete="off">
                        </label>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="label text-left">National ID<br>
                            <input type="text" name="cnic" class="form-control custom-form full-field" required autocomplete="off">
                        </label>

                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-12">
                        <label for="" class="label text-left">Home Address<br>
                            <input type="text" name="address" class="form-control custom-form full-field" required autocomplete="off">
                        </label>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">

                        <button type="submit" class="custom-btn">Register
                            {{--<a href="#openModal-about">
                                Register</a>--}}
                            </button>

                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>


        <!--Modal 1-->

        <div id="openModal-about" class="modalDialog" style="z-index:9999;">
            <div>
                <a href="#close" title="Close" class="close">X</a>


                <section class="verify-popup">

                    <div class="container">

                        <div class="row text-center">


                            <h2 class="title text-center">Please Enter The OPT to Verify Your Phone Number</h2>

                            <p class="paragraph text-center">We have Sent You a 4-digit code Please Enter the code:</p>

                            <div class="col-md-6 text-center offset-md-3">


                                <input type="text" name="" id="" class="field form-control">

                                <button type="submit" class="custom-submit"><a href="#openModal-about2">Submit</a></button><br>

                                <button type="reset" class="custom-reset">Reset</button>

                            </div>



                        </div>

                    </div>


                </section>



            </div>

        </div>







    <!--Modal 2-->

    <div id="openModal-about2" class="modalDialog" style="z-index:9999;">
        <div>
            <a href="#close" title="Close" class="close">X</a>


            <section class="verify-popup2">

                <div class="container">

                    <div class="row text-center">


                        <h2 class="title text-center">Thank You! Your Phone Number is Verified</h2><br>

                            <i class="fa fa-check-circle tick-mark text-center" aria-hidden="true"></i>

                    </div>

                </div>


            </section>

        </div>

    </div>





</section>
@endsection
