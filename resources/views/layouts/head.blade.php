@yield('css')
<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ URL::asset('assets/css/app-rtl.min.css')}}" id="app-rtl" rel="stylesheet" type="text/css" /> --}}
<link href="{{ URL::asset('/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
<style>
   .vertical-menu {
      background: rgb(27, 22, 77) !important;
      background: linear-gradient(90deg, rgba(27, 22, 77, 1) 0%, rgba(64, 59, 105, 1) 100%) !important;
   }

   .navbar-brand-box {
      background: rgb(27, 22, 77) !important;
      background: linear-gradient(90deg, rgba(27, 22, 77, 1) 0%, rgba(64, 59, 105, 1) 100%) !important;
   }

   .metismenu>li>a {
      background: transparent !important;
   }

   .metismenu>li>a>img {
      margin-left: 0.25rem
   }

  

</style>
