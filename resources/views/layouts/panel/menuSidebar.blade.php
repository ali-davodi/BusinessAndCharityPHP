@section('menuSidebar')
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img class="panel-logo-size" src="{{ asset('img/logo.png') }}" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="active has-sub">
                        <a class="js-arrow" href="/">
                            <i class="fas fa-tachometer-alt"></i>Home</a>
                    </li>
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Departments</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            @if ($admin_login)
                                <li>
                                    <a href="/departments/list">List</a>
                                </li>
                            @else
                                <li>
                                    <a href="/departments/request">Request for Departments</a>
                                </li>
                                @foreach ($user->departments as $department)
                                    <li>
                                        <a href="/departments/list/{{ $department->id }}-{{ $department->name }}">{{ $department->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    @if ($admin_login)
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Payments</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="/payments/list">List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Communications</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                @foreach ($user->communication as $communicate)
                                    <li>
                                        <a href="/communications/{{ $communicate->id }}">{{ $communicate->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->
@endsection
