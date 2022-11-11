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
    <link rel="stylesheet" href="{{url('vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}">


    <link rel="stylesheet" href="{{url('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


    <link rel="stylesheet" href="{{url('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    @stack('styles')


    <link rel="stylesheet" href="{{url('css/horizontal-layout-light/style.css')}}">
</head>
<body>
<div class="container-scroller">
    @include('layouts.horizontal-navbar')
    <div class="container-fluid page-body-wrapper">
        {{--    @include('layout.settings-panel')--}}
        {{--      @include('layout.sidebar')--}}
        <div class="modal fade" id="modal-tela" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Title</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                                <div class="dot-opacity-loader">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success modal-button-success">Success Button</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="main-panel">
            <div class="content-wrapper">
                <div class="content-wrapper">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

<script src="{{url('vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{url('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
@stack('plugin-scripts')
<script src="{{ url("vendors/select2/select2.min.js") }}"></script>







<script src="{{url('js/off-canvas.js')}}"></script>
<script src="{{url('js/hoverable-collapse.js')}}"></script>
<script src="{{url('js/template.js')}}"></script>
<script src="{{url('js/settings.js')}}"></script>
<script src="{{url('js/todolist.js')}}"></script>
<script src="{{url('js/tooltips.js')}}"></script>
<script src="{{url('js/toast.js')}}"></script>
<script src="{{url('js/custom.js')}}"></script>


<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script src="{{ url("vendors/datatables.net/jquery.dataTables.js") }}"></script>
<script src="{{ url("vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}"></script>
<script src="{{ url("vendors/sweetalert/sweetalert.min.js") }}"></script>




@stack('custom-scripts')
</body>
</html>
