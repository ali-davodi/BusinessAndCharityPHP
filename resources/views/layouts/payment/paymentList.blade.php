@include('layouts.header')
@include('layouts.footer')
@include('layouts.userPanelSample')
@yield('header')
@if ($page['isLogin'])
    @yield('UserPanelTop')
    @foreach ($list as $dept)
        <div class="modal" id="myModal{{ $dept->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete "{{ $dept->title }}" ?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure to delete<br />
                    "{{ $dept->title }}" ?
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <a href="/payment/{{ $id }}/delete">
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
                                <a href="/payment/{{ $id }}/create">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add new</button>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>code</th>
                                        <th>price</th>
                                        <th>title</th>
                                        <th>description</th>
                                        <th>activation</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $dept)
                                        <tr class="tr-shadow">
                                            <td>{{ $dept->code }}</td>
                                            <td>
                                                {{ $dept->price }}
                                            </td>
                                            <td>{{ $dept->title }}</td>
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
                                                    @if (!$dept->active)
                                                        <button class="item btn-danger" type="button" data-placement="top" title="Delete" data-toggle="modal" data-target="#myModal{{ $dept->id }}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    @endif
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
