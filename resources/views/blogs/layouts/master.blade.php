<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Simple Blog</title>
  <!-- Favicon -->
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href=" {{ asset('css/nucleo/css/nucleo.css') }} " type="text/css">
  <link rel="stylesheet" href=" {{ asset('css/fontawesome/all.min.css') }}">
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
   <!-- Page Plugins -->
    <link rel="stylesheet" href="{{asset('datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}  ">
    <link rel="stylesheet" href=" {{asset('datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href=" {{asset('datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link href="{{ asset('css/argon.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/master.css')}}">
  @yield('css')
</head>

<body>
    {{-- side-nav STARTS --}}
        @component('blogs.components.dashboard-side-nav', ['user' => Auth::user()])
        @endcomponent
    {{-- side-nav ENDS --}}

  <div class="main-content" id="panel">

    {{-- top-nav STARTS --}}
        @component('blogs.components.dashboard-top-nav')
        @endcomponent
    {{-- top-nav ENDS --}}

    <!-- Page content -->
    <div class="container-fluid">
        @yield('content')
    </div>

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->


  <script src="{{asset('js/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src=" {{asset('datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src=" {{asset('datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src=" {{asset('datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}} "></script>
<script src=" {{asset('datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src=" {{asset('datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src=" {{asset('datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src=" {{asset('datatables.net-select/js/dataTables.select.min.js')}}"></script>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src=" {{asset('js/js-cookie/js.cookie.js')}}"></script>
  <script src=" {{asset('js/bootstrap-notify.js')}}"></script>
  <script src=" {{asset('js/jquery.scrollbar/jquery.scrollbar.min.js')}} "></script>
  <script src=" {{asset('js/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <script src="{{asset('js/argon.js')}}"></script>
  <script>

$('#datatable-basic').DataTable({
    pageLength: 3,
    order: [[ 3, "desc" ]],
    filter: true,
    deferRender: true,
    scrollY: 200,
    scrollCollapse: true,
    scroller: true,
    bPaginate: false
});
</script>
  @yield('javascript')
</body>

</html>