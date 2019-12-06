@extends('layouts.user')
@section('content')

{{-- Log in Form --}}
<section>
@if(session('register'))
<div class="row"><br><br>
    <div class="col-md-4 offset-md-4">
            <div class="alert alert-success" role="alert">
                    <strong>{{session('register')}}</strong>
            </div>
    </div>
</div>
@endif
</section>

<section class="login">
    <div class="container bg-section">
        <div class="row text-center">
            <div class="center-logo-img text-center">
                <img src="assets/img/logo/left-main-icon.png" class="logo-img" alt="image">
            </div>
            <div class="heading text-center container-fluid">Login In</div>
            <div class="col-md-12">


                <p class="login-box-msg">Sign in to start your session</p>
                @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="label text-left"> &nbsp; &nbsp; Email Address*<br>
                                <input type="email"
                                    class="form-control custom-form full-field {{ $errors->has('email') ? ' is-invalid' : '' }} "
                                    required autofocus placeholder="{{ trans('global.login_email') }}" name="email"
                                    value="{{ old('email', null) }}">
                            </label>
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="label text-left">&nbsp; &nbsp;  Password* <br>
                                <input type="password"
                                    class="form-control custom-form full-field {{ $errors->has('password') ? ' is-invalid' : '' }} "
                                    required placeholder="{{ trans('global.login_password') }}" name="password">
                            </label>
                            @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">{{ trans('global.remember_me') }}</label>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">

                            <button type="submit" class="custom-btn">Sign In</button>
                            <a href="signup" class="register-btn text-center">Don't have account?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</section>




<div class="go-top"><i class="fas fa-arrow-up"></i><i class="fas fa-arrow-up"></i></div>



@endsection
