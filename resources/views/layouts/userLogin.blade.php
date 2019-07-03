@section('UserLogin')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <div class="left-div">
                        <a href="/{{ $user_type=='user' ? 'admin' : '' }}">
                            <button class="btn btn-info btn-sm">{{ $user_type=='user' ? 'Admin' : 'User' }} Login</button></div>
                        </a>
                        @if ($hasError)
                            <div class="alert alert-danger alert-margin">
                                <ul>
                                    <li>{{ $errorTitle }}</li>
                                </ul>
                            </div>
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
                        <div class="center-div bold">{{ $user_type=='user' ? 'User' : 'Admin' }} Panel</div>
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
                                    <input type="hidden" name="type" value="{{ $user_type=='user' ? 'user' : 'admin' }}" />
                                    <div class="login-checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">Remember Me
                                        </label>
                                        <label>
                                            <a href="#">Forgotten Password?</a>
                                        </label>
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                    @if ($user_type=='user')
                                        <div class="register-link">
                                            <a class="width-100" href="/register"><button class="au-btn au-btn--block au-btn--blue m-b-20" type="button">sign up</button></a>
                                        </div>
                                    @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
