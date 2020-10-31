<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Oxone Official Agent Portal</title>
  <!-- Favicon -->
 <link rel="icon" href="{{asset('/assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
  <!-- Icons -->
<link rel="stylesheet" href="{{asset('/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/assets/css/my.css')}}">

{{-- <link rel="stylesheet" href="{{asset('/assets/vendor/datatables/css/dataTables.bootstrap.css')}}" type="text/css"> --}}
<link rel="stylesheet" href="{{asset('/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}" type="text/css">

  <!-- Page plugins -->
  <!-- Argon CSS -->
<link rel="stylesheet" href="{{asset('/assets/css/argon.css?v=1.2.0')}}" type="text/css">
</head>

<bodys>
  <!-- Main content -->
  
    @yield('content')
  
  <!-- Argon Scripts -->
  <!-- Core -->
   <!-- Footer -->
<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('/assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<script src="{{asset('/assets/js/myjs.js')}}"></script>
  <!-- Optional JS -->
<script src="{{asset('/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
<script src="{{asset('/assets/js/argon.js?v=1.2.0')}}"></script>
</bodys>

</html>