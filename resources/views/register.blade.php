@include('layouts.header')
@include('layouts.footer')
@yield('header')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <div class="left-div">
                        @if(!$page['created'])
                            <a href="/">
                                <button class="btn btn-info btn-sm">Back</button></div>
                            </a>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-margin">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <a href="#">
                            <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="Logo">
                        </a>
                        <div class="center-div bold">User Register</div>
                    </div>
                    @if($page['created'])
                        <div class="login-form">
                            <div class="alert alert-success alert-margin">
                                <ul>
                                    <li>Account Created Successfully</li>
                                </ul>
                            </div>
                        </div>
                        <div class="center-div">
                            <a href="/">
                                <button class="btn btn-info btn-sm">Back</button>
                            </a>
                        </div>
                    @else
                        <div class="login-form">
                            <form action="" method="post" class="row">
                                @csrf
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="au-input au-input--full" type="text" name="fullname" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                            <label>Retype Password</label>
                                            <input class="au-input au-input--full" type="password" name="repassword" placeholder="Retype Password">
                                        </div>
                                </div>
                                <div class="col-6">
                                    <div class="login-checkbox">
                                        <label>
                                            <input type="checkbox" name="agree">Agree the terms and policy
                                        </label>
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <button class="au-btn au-btn--block au-btn--blue m-b-20">register with facebook</button>
                                            <button class="au-btn au-btn--block au-btn--blue2">register with twitter</button>
                                        </div>
                                    </div>
                                    <div class="register-link">
                                        <p>
                                            Already have account?
                                            <a href="/">Sign In</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@yield('footer')
