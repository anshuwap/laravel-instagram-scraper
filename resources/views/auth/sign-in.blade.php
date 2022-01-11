@extends('layouts.auth.master')

@section('auth-content')
     <!-- Sing in  Form -->
     <section class="sign-in">
        <div class="container">
            @include('errors.msg')
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/auth/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('register.showPage') }}" class="signup-image-link">ساخت اکانت</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title" style="direction: rtl">ورود</h2>
                    <form action="{{ route('login.loginUser') }}" method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="your_name" placeholder="ایمیل کاربر"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="رمز عبور"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>مرا به خاطر داشته باش</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection