    
<script src="{{ url('assets/js/jquery.min.js')}}"></script><!-- jQuery  -->
<script src="{{ url('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/js/waves.js')}}" ></script>
<script src="{{ url('assets/js/simplebar.min.js')}}"></script>
<!-- Validation custom js-->
<script src="{{ url('assets/pages/validation-demo.js')}}"></script>
<!-- App js -->
<script src="{{ url('assets/js/theme.js">')}}"></script>
  <!-- jQuery  -->
<script src="{{ url('assets/pages/knob-chart-demo.js')}}"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{url('plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Js-->
<script src="{{url('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{url('plugins/morris-js/morris.min.js')}}"></script>
<script src="{{url('plugins/raphael/raphael.min.js')}}"></script>

<!-- Custom Js -->
{{-- <script src="{{ url('assets/pages/dashboard-demo.js') }}"></script> --}}

<!-- App js -->
<script src="{{ url('assets/js/theme.js') }}"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

  
                        



<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
    // alert(value)
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<footer class="footer">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6">
              <div class="text-center text-lg-left">
                  2023 © JanisCare.
              </div>
          </div>
          <div class="col-md-6">
            <div class="text-right d-none d-lg-block">
                Copyright @ 2023. All rights reserved.
            </div>
        </div>
      </div>
  </div>
</footer>

</body>
</html>