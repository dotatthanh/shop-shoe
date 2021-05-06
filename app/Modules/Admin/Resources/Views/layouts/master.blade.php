
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shop Shoe</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <!-- jQuery 3 -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script>
        const BASE_URL = "{{ url('/') }}";
        const BASE_API_URL = "{{ url('/api') }}";
    </script>
    <script src="{{ asset('plugins/toastr/sweetalert2@10.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- HEADER -->
		@include('admin::layouts.header')
		<!-- END HEADER -->
		
		
        <!-- SIDEBAR -->
        @include('admin::layouts.sidebar')

		<!-- END SIDEBAR -->
		
		<!-- CONTENT -->
        <div class="content-wrapper">
            @yield('breadcrumb')
            <section class="content">
                @yield('content')
            </section>
        </div>
        <!-- END CONTENT -->
        
        <!-- FOOTER -->
		@include('admin::layouts.footer')
		<!-- END FOOTER -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('modules/admin/js/common.js') }}"></script>

    @yield('script')

    <script>
        @if(Session::has('alert-success'))
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('alert-success') }}"
            })
        @endif

        @if(Session::has('alert-error'))
            Toast.fire({
                icon: 'error',
                title: "{{ Session::get('alert-error') }}"
            })
        @endif
    </script>
</body>

</html>
