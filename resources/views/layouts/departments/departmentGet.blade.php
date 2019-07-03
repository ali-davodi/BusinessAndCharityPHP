@include('layouts.header')
@include('layouts.footer')
@include('layouts.userPanelSample')
@yield('header')
@if ($page['isLogin'])
    @yield('UserPanelTop')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="card">
                    <form action="" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="card-header">
                            Department : <strong>{{ $dept->name }}</strong>
                        </div>
                        <div class="card-body card-block">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-margin">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row form-group">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <div class="center-div"><a href="/payment/{{ $id }}/"><button type="button" class="btn btn-success"><i class="zmdi zmdi-money"></i> Add A Payment</button></a></div>
                                    </div>
                                    <div class="col-5">
                                        <div class="center-div"><button type="button" class="btn btn-secondary"><i class="zmdi zmdi-email"></i> Send A Communication</button></div>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @yield('UserPanelBottom')
@endif
@yield('footer')
