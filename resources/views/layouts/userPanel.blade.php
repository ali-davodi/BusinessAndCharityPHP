@include('layouts.panel.footerDesktop')
@include('layouts.panel.headerDesktop')
@include('layouts.panel.headerMobile')
@include('layouts.panel.mainContent')
@include('layouts.panel.menuSidebar')
@include('layouts.panel.pageContainer')

@section('UserPanel')
    @yield('pageContainer')
    @yield('headerMobile')
    @yield('menuSidebar')
    @yield('pageContainer')
    @yield('headerDesktop')
    @yield('mainContent')
    @yield('footerDesktop')
@endsection
