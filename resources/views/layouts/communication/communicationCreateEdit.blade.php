@include('layouts.header')
@include('layouts.footer')
@include('layouts.userPanelSample')
@yield('header')
@if ($page['isLogin'])
    @yield('UserPanelTop')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="card-header">
                                    <a href="/communication/{{ $id }}"><button type="submit" class="btn btn-info btn-sm">Back</button></a>
                                    {{ $type=='create' ? 'Create' : 'Update' }} <strong>Communication</strong> for "{{ $dept->name }}"
                                </div>
                                <div class="card-body card-block">
                                    @if(isset($page['error']))
                                        <div class="alert alert-danger alert-margin">
                                            <ul>
                                                <li>{{ $page['error'] }}</li>
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
                                    @if($page['created'])
                                        <div>
                                            <div class="alert alert-success alert-margin">
                                                <ul>
                                                    <li>Communication {{ $type=='create' ? 'Created' : 'Updated' }} Successfully</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="title" class="form-control-label">Title</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="title" name="title" type="text" class="form-control valid" data-val="true" data-val-required="Please enter the name on card" aria-required="true" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="description" class="form-control-label">Description</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="description" id="description" rows="9" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    @if(!$page['created'])
                                    <button type="submit" class="btn btn-info btn-md">
                                        <i class="fa fa-dot-circle-o"></i> {{ $type=='create' ? 'Create' : 'Update' }}
                                    </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('UserPanelBottom')
@endif
@yield('footer')
