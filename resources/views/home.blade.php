@include('layouts.header')
@include('layouts.footer')
@include('layouts.userPanel')
@yield('header')
@if($user_login || $admin_login)
    @yield('UserPanel')
@endif
@yield('footer')
