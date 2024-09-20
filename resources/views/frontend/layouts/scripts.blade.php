
<script src="{{ asset('assets/js/slider.js') }}"></script>
<script data-cfasync="false" src="{{ asset('assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
</script>
<script src="{{asset('assets/js/jquery-3.7.0.min.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/js/feather.min.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/js/owl.carousel.min.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/plugins/aos/aos.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}" type="b8ee9809a0c13792276a4346-text/javascript"></script>
<script src="{{asset('assets/js/backToTop.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>

<script src="{{asset('assets/js/script.js')}}" type="98a76c34a45049bd2fdaa03f-text/javascript"></script>
<script src="{{ asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
    data-cf-settings="98a76c34a45049bd2fdaa03f-|49" defer></script>

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
    </script>
