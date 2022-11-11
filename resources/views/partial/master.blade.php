<!DOCTYPE html>
<html>
<head>
  <title>Admin System</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
  <!-- plugin css -->
    <link rel="stylesheet" href="{{url('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{url('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{url('vendors/css/vendor.bundle.base.css')}}">
  <!-- end plugin css -->


    <link rel="stylesheet" href="{{url('css/horizontal-layout-light/style.css')}}">
  @stack('styles')
</head>
<body>
<div class="container-scroller">
    @include('layouts.horizontal-navbar')
    <div class="container-fluid page-body-wrapper">
{{--    @include('layout.settings-panel')--}}
{{--      @include('layout.sidebar')--}}
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('layouts.footer')
      </div>
    </div>
  </div>

  @stack('plugin-scripts')
  <script src="{{url('vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{url('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

  <script src="{{url('js/off-canvas.js')}}"></script>
  <script src="{{url('js/hoverable-collapse.js')}}"></script>
  <script src="{{url('js/template.js')}}"></script>
  <script src="{{url('js/settings.js')}}"></script>
  <script src="{{url('js/todolist.js')}}"></script>
  @stack('custom-scripts')
</body>
</html>
