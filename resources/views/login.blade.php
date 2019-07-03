@include('layouts.header')
@include('layouts.footer')
@include('layouts.userLogin')
@yield('header')
@if (!$user_login && !$admin_login)
    @yield('UserLogin')
@endif
@yield('footer')
