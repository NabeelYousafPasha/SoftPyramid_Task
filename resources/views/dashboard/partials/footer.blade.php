<!-- Mainly scripts -->
<script src="{{ asset('backend-assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('backend-assets/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>

<!-- Peity -->
<script src="{{ asset('backend-assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('backend-assets/js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('backend-assets/js/inspinia.js') }}"></script>
<script src="{{ asset('backend-assets/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('backend-assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('backend-assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('backend-assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('backend-assets/js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('backend-assets/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('backend-assets/js/plugins/toastr/toastr.min.js') }}"></script>

<!-- Laravel Toastr -->
{{-- @toastr_js --}}
{{-- @toastr_render --}}

<script type="text/javascript">
	toastr.options = {
		closeButton: true,
		progressBar: true,
		debug: false,
		positionClass: 'toast-bottom-right',
		showMethod: 'slideDown',
		timeOut: 5000
	};
</script>
@if(session("successToastr"))
<script type="text/javascript">
	toastr.success("{{ session("successToastr") }}");
</script>
@endif
@if(session("errorToastr"))
<script type="text/javascript">
	toastr.error("{{ session("errorToastr") }}");
</script>
@endif
@if(session("warningToastr"))
<script type="text/javascript">
	toastr.warning("{{ session("warningToastr") }}");
</script>
@endif
@if(session("infoToastr"))
<script type="text/javascript">
	toastr.info("{{ session("infoToastr") }}");
</script>
@endif

