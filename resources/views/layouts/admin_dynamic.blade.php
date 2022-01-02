  
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('e-Office | Universitas Universal')}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{asset('images/fuvers.png')}}"  />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('/css/dataTables.bootstrap.min.css')}}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!--AdminLTE Skins.Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.-->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('dist/clockpicker/bootstrap-clockpicker.min.css')}}">

  <style>
    .entry:not(:first-of-type)
      {
          margin-top: 10px;
      }
      .glyphicon
      {
          font-size: 12px;
      }
      .pt-3-half { padding-top: 1.4rem; }
      .tableFixHead          { overflow: auto; height: 400px; width: 100%; }
      .tableFixHead thead th { position: sticky; top: 0; z-index: 1 !important; background-color: #f4f4f4 !important; border: 1px solid #f4f4f4 !important}
      .tableFixHead tbody td { border: 1px solid #f4f4f4 !important ; z-index: }
      .modal-dialog {
        width: 90%;
        height: 90%;
        margin: auto;
        padding-top: 10px;
      }
      .modal-content {
        height: auto;
        border-radius: 0;
      }
      .border-black{
        border: 1px solid #f4f4f4 !important
      }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{asset('js/app.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div id="progressbar-recommendation" class="pt-loading">
    <div class="loading-progress"></div>
  </div>
  <div class="wrapper" id="app">

    @include('partials.navbar')
    <!-- Left side column. contains the logo and sidebar -->
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')

    <!-- /.content-wrapper -->
    @include('partials.footer')

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
<!-- ./wrapper -->
<!-- jQuery 3 & bootstrap -->
{{-- <script src="{{asset('js/bootstrap.min.js')}}"></script> --}}
<!-- DataTables -->
{{-- <script src="{{asset('js/jquery-ui.js')}}"></script> --}}
{{-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> --}}
{{-- <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script> --}}
<!-- SlimScroll -->
{{-- <script src="{{asset('dist/js/select2.full.min.js')}}"></script> --}}
<!-- AdminLTE App -->
{{-- <script src="{{asset('dist/js/adminlte.js')}}"></script> --}}
<!-- notify js -->
@include('partials.notify')

<!-- page script -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/ckeditor/styles.js')}}"></script>



<script type="text/javascript" src="{{asset('dist/clockpicker/bootstrap-clockpicker.min.js')}}"></script>

@yield('script')


</script>

<script type="text/javascript">
   $( document ).ready(function() {
      $('input').attr('autocomplete','off');
  });
</script>
</body>
</html>