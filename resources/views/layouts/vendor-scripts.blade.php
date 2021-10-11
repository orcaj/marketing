<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/waypoints/waypoints.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/feather-icons/feather-icons.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

@yield('script')
<!-- App js -->
<script src="{{ URL::asset('/assets/js/app.min.js')}}"></script>
<script>
   $("#show-pass").click(function(e) {
      $("input[type='password']").attr('type', 'text');
   })

</script>

@yield('script-bottom')
