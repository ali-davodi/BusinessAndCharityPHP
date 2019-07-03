@include('layouts.header')
@include('layouts.footer')
@include('layouts.userLogin')
@include('layouts.userPanel')
@yield('header')
@if ($user_login || $admin_login)
    @yield('UserPanel')
@else
    @yield('UserLogin')
@endif
@yield('footer')
