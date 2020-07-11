<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset(get_option('app_fav_icon'))}}" type="image/gif" sizes="16x16">
    @include('backend.layouts.assets.css')

    @yield('css')
</head>

<body id="page-top">


<!-- Page Wrapper -->
<div id="wrapper">
    @if(active_if_full_match('purchase/create') != 'active'
     && active_if_full_match('purchase/*/edit') != 'active'
     &&  active_if_full_match('sell/create') != 'active'
     &&  active_if_full_match('sell/*/edit') != 'active'
     &&  active_if_full_match('requisition/create') != 'active'
     &&  active_if_full_match('requisition/*/edit') != 'active'
     )
        @include('backend.layouts.particles.sidebar')
    @endif

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="app">
            <div id="content">
                @include('backend.layouts.particles.header')
                @yield('content')
            </div>
        </div>

        <!-- End of Main Content -->
        @include('backend.layouts.particles.footer')
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('backend.layouts.assets.js')
{!! Toastr::message() !!}

@if(Session::has('message'))
    <input type="hidden" value="{{ Session::get('type') }}" id="toastrType">
    <input type="hidden" value="{{ Session::get('message') }}" id="toastrMessage">
    <script src="{{asset('/backend/js/custom-toastr.js')}}"></script>
@endif

@yield('js')
</body>

</html>
