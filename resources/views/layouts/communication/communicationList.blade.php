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
                        <!-- DATA TABLE -->
                        <h3 class="title-5 m-b-35">{{ $page['title'] }}</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-left"></div>
                            <div class="table-data__tool-right">
                                <a href="/communication/{{ $id }}/create">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>new communication</button>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>title</th>
                                        <th>description</th>
                                        <th>user</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $dept)
                                        <tr class="tr-shadow">
                                            <td>{{ $dept->title }}</td>
                                            <td class="desc">{{ $dept->description }}</td>
                                            <td class="desc">{{ $dept->fullname.'('.$dept->username.')' }}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="spacer"></tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('UserPanelBottom')
@endif
@yield('footer')
