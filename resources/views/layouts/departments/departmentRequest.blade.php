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
                            Request for <strong>Departments</strong>
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
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Request For</label>
                                    </div>
                                    @if ($in_request)
                                        <div>{{ $in_request }}</div>
                                    @else
                                        <div class="col-12 col-md-9">
                                            <select name="request_department" id="select" class="form-control">
                                                <option value="0">Please select</option>
                                                @foreach ($dept as $d)
                                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                        </div>
                        <div class="card-footer">
                            @if ($in_request)
                                <div class="alert alert-success" role="alert">
                                    You requested {{ $in_request }} successfully
                                </div>
                            @else
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Request
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @yield('UserPanelBottom')
@endif
@yield('footer')
