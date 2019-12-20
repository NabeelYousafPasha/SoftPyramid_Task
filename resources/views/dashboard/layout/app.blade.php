<!DOCTYPE html>
<html>
<!-- --------------------------    header stylesheets   -------------------------------- -->
<head>
	@include('dashboard.partials.header')
	@yield('stylesheets')
</head>

<body>
    <div id="wrapper">
<!-- ----------------------------------    sidebar    ----------------------------------- -->
    	@include('dashboard.partials.sidebar')

    	<div id="page-wrapper" class="gray-bg dashbard-1">
<!-- ----------------------------------     navbar    ----------------------------------- -->
    	   @include('dashboard.partials.navbar')

           @if (Session::has('message'))
                <div class="alert alert-info alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="note note-info">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                </div>
            @endif
            @if ($errors->count() > 0)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="note note-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
                    
    	   @yield('content')

           @include('dashboard.partials.credits')
    	</div>
    </div>


    <div class="modal inmodal" id="softpyramid_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">

            </div>
        </div>
    </div>

<!-- ---------------------------       footer scripts      ---------------------------- -->
	@include('dashboard.partials.footer')
    {{-- @include('sweetalert::alert') --}}
    @yield('scripts')

    <script>
        /*
        * --------------------------
        * global edit modal "SHOW show.bs.modal"
        * --------------------------
        * */
        $("#softpyramid_modal").on("show.bs.modal", function(t) {
            var e = $(t.relatedTarget);
            e.attr("data-href") && $.get(e.attr("data-href"), function(t) {
                $("#softpyramid_modal").find(".modal-content").html(t);
            });
        });

        /*
        * --------------------------
        * global edit modal "HIDE hide.bs.modal"
        * --------------------------
        * */
        $("#softpyramid_modal").on("hide.bs.modal", function(t) {
            $("#softpyramid_modal").find(".modal-content").html('');
        });
    </script>
</body>
</html>
