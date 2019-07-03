@section('UserLogin')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <div class="left-div"><button class="btn btn-info btn-sm">Admin Panel</button></div>
                        @if ($hasError)
                            <div class="alert alert-danger alert-margin">
                                <ul>
                                    <li>{{ $errorTitle }}</li>
                                </ul>
                            </div>
                        @endif
                        <a href="#">
                            <img src="{{ asset('img/logo.png') }}" alt="CoolAdmin">
                        </a>
                        <div class="center-div bold">User Panel</div>
                    </div>
                    <div class="login-form">
                        <form action="" method="post" class="row">
                            @csrf
                            <div class="col-6">
                                <div class="form-group">
                                    <label>username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-6">
                                    <input type="hidden" name="type" value="user" />
                                    <div class="login-checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">Remember Me
                                        </label>
                                        <label>
                                            <a href="#">Forgotten Password?</a>
                                        </label>
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                    <div class="register-link">
                                        <a href="/register"><button class="au-btn au-btn--block au-btn--blue m-b-20" type="button">sign up</button></a>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
