<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
    </div>
</div>
<!--**********************************
    Footer end
***********************************-->
</div>
<!--**********************************
Main wrapper end
***********************************-->

<!--**********************************
Scripts
***********************************-->
<script src="{{ asset('plugins/common/common.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/settings.js') }}"></script>
<script src="{{ asset('js/gleek.js') }}"></script>
<script src="{{ asset('js/styleSwitcher.js') }}"></script>

{{-- <!-- Chartjs -->
<script src="{{asset('./plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Circle progress -->
<script src="{{asset('./plugins/circle-progress/circle-progress.min.js')}}"></script>
<!-- Datamap -->
<script src="{{asset('./plugins/d3v3/index.js')}}"></script>
<script src="{{asset('./plugins/topojson/topojson.min.js')}}"></script>
<script src="{{asset('./plugins/datamaps/datamaps.world.min.js')}}"></script> --}}
<!-- Morrisjs -->
{{-- <script src="{{asset('./plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('./plugins/morris/morris.min.js')}}"></script>
<!-- Pignose Calender -->
<script src="{{asset('./plugins/moment/moment.min.js')}}"></script> --}}
{{-- <script src="{{asset('./plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script> --}}
<!-- ChartistJS -->
{{-- <script src="{{asset('./plugins/chartist/js/chartist.min.js')}}"></script> --}}
{{-- <script src="{{asset('./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script> --}}



<script src="{{ asset('./js/dashboard/dashboard-1.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}",
            icon: "success",
            showConfirmButton: false,
            timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
            timerProgressBar: true,
        });
    </script>
@endif
@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
            timerProgressBar: true,

        });
    </script>
@endif
