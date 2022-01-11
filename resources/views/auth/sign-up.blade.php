@extends('layouts.auth.master')

@section('auth-content')
     <!-- Sign up form -->
     <section class="signup">
        <div class="container">
            @include('errors.msg')
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title" style="direction: rtl">ثبت نام</h2>
                    <form action="{{ route('register.store') }}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="نام کاربر"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="ایمیل کاربر"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-phone"></i></label>
                            <input type="text" name="number" id="number" placeholder="شماره همراه"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="رمز عبور"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_conf" id="password_" placeholder="تکرار رمز عبور"/>
                        </div>
                        
                        {{-- <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div> --}}
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="/auth/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('login.showPage') }}" class="signup-image-link">من قبلا ثبت نام کرده ام</a>
                </div>
            </div>
        </div>
    </section>
@endsection