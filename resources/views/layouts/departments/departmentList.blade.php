@include('layouts.header')
@include('layouts.footer')
@include('layouts.userPanelSample')
@yield('header')
@if ($page['isLogin'])
    @yield('UserPanelTop')
    @foreach ($departments as $dept)
        <div class="modal" id="myModal{{ $dept->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete "{{ $dept->name }}" ?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure to delete<br />
                    "{{ $dept->name }}" ?
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <a href="/departments/delete/{{ $dept->id }}">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                </div>
                </div>
            </div>
        </div>
    @endforeach
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
                                <a href="/departments/create">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add new</button>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $dept)
                                        <tr class="tr-shadow">
                                            <td>{{ $dept->id }}</td>
                                            <td>
                                                {{ $dept->name }}
                                            </td>
                                            <td class="desc">{{ $dept->description }}</td>
                                            <td>
                                                @if($dept->active)
                                                    <span class="btn btn-success">Active</span>
                                                @else
                                                    <span class="btn btn-danger">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="/departments/users/{{ $dept->id }}">
                                                        <button class="item btn-success" data-toggle="tooltip" data-placement="top" title="Users">
                                                            <i class="zmdi zmdi-account-circle"></i>
                                                        </button>
                                                    </a>
                                                    <a href="/departments/edit/{{ $dept->id }}">
                                                        <button class="item btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <button class="item btn-danger" type="button" data-placement="top" title="Delete" data-toggle="modal" data-target="#myModal{{ $dept->id }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
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
