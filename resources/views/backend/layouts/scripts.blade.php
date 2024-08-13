@yield('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script data-cfasync="false"
    src="{{ asset('admin/assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
<script src="assets/js/jquery-3.7.0.min.js" type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/js/select2.min.js')}} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/apexchart/apexcharts.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/apexchart/chart-data.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/js/feather.min.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/js/dataTables.bootstrap4.min.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-ru-mill.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-uk_countries-mill.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-in-mill.js') }}"
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/js/jvectormap.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/sweetalert/sweetalerts.min.js') }} "
        type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>

<script src="{{ asset('admin/assets/js/admin.js') }}" type="c1f77b0a2c00ef20b2ebccd6-text/javascript"></script>
<script src="{{ asset('admin/assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
    data-cf-settings="c1f77b0a2c00ef20b2ebccd6-|49" defer></script>


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script> --}}
