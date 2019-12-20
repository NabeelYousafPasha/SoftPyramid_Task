@extends('dashboard.layout.app')
@section('stylesheets')
    <link href="{{ asset('backend-assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $page_title }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ '/' }}">Home</a>
                </li>
                <li class="active">
                    <strong>{{ $page_title }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2" style="float: right;">
            <h2></h2>
            <a
                href="javascript:void(0)"
                class="btn btn-primary"
                id="add_new__payment"
            >
                Add New
            </a>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{ $page_title }} {{ trans('lang.actions.list') }}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive" id="listPayment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modals">
        {{-- ___________________________ MODAL CREATE __________________________ --}}
        <div class="modal inmodal" id="createPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{{ trans('lang.actions.add_new') }} {{ $entity }}</h4>
                    </div>
                    <div class="modal-body">
                        <form
                            id="createPaymentForm"
                            name="createPaymentForm"
                        >
                            @include('dashboard.payment.form')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createPaymentButton">{{ trans('lang.actions.save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ___________________________ MODAL DELETE __________________________ --}}
        <div class="modal inmodal" id="deletePaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Delete {{ $entity }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this {{ $entity }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deletePaymentButton">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('backend-assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(function () {
            /* ----------------------
            // list
            *  ----------------------
            */
            listOfPayments();

            /* ----------------------
            // create
            *  ----------------------
            */
            $('#add_new__payment').on('click', function (e) {
                $('#createPaymentModal').modal();
            });

            /* ----------------------
            // store
            *  ----------------------
            */
            $('#createPaymentButton').on('click', function () {
                let transaction = '{{ $transaction->id }}';
                let route = '{{ route("payments.store", ":transaction") }}';
                route = route.replace(':transaction', transaction);
                $.ajax({
                    method: 'POST',
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $("#createPaymentForm").serialize(),
                    success: function (res) {
                        listOfPayments();
                        $('#createPaymentModal').modal('hide');
                        if (res.code == 201)
                            toastr.success(res.message);
                        else
                            toastr.error(res.message);
                    },
                    error: function (err, jqXHR, exception) {
                        printErrorMsg(err.responseJSON.errors);
                    },
                });
            });

            /* ----------------------
            // update
            *  ----------------------
            */
            $('#softpyramid_modal').on('click', '#editPaymentButton', function () {
                let payment = $(this).data('payment');
                let transaction = '{{ $transaction->id }}';
                let route = '{{ route("payments.update", [":transaction", ":payment"]) }}';
                route = route.replace(':transaction', transaction);
                route = route.replace(':payment', payment);

                $.ajax({
                    method: 'POST',
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $("#editPaymentForm").serialize(),
                    success: function (res) {
                        listOfPayments();
                        $('#softpyramid_modal').modal('toggle');
                        if (res.code == 204)
                        {
                            toastr.success(res.message);
                        }
                        else
                        {
                            toastr.error(res.message);
                        }
                    },
                    error: function (err, jqXHR, exception) {
                        printErrorMsg(err.responseJSON.errors);
                    },
                });
            });

            /* ----------------------
            // delete
            *  ----------------------
            */
            $('#listPayment').on('click', '.deletePayment', function (e) {
                $('#deletePaymentModal').modal('show');
                $('#deletePaymentButton').attr('data-payment', $(this).attr('data-payment'));
            });

            $('#deletePaymentButton').on('click', function (e) {
                let payment = $(this).attr('data-payment');
                let transaction = '{{ $transaction->id }}';
                let route = '{{ route("payments.delete", [":transaction", ":payment"]) }}';
                route = route.replace(':transaction', transaction);
                route = route.replace(':payment', payment);
                $.ajax({
                    method: 'DELETE',
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'DELETE',
                    },
                    success: function (res) {
                        listOfPayments();
                        $('#deletePaymentModal').modal('hide');
                        if (res.code == 204)
                        {
                            toastr.success(res.message);
                        }
                        else
                        {
                            toastr.error(res.message);
                        }
                    },
                });
            });

            $("#deletePaymentModal").on("hide.bs.modal", function(t) {
                $('#deletePaymentButton').attr("data-payment" , '');
                $('#deletePaymentButton').removeAttr('data-payment');
            });

            // remove errors on close modal
            $("#createPaymentModal").on("hide.bs.modal", function(t) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','none');
            });

        });

        // validations
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        // list
        function listOfPayments() {
            let transaction = '{{ $transaction->id }}';
            let route = '{{ route("payments.list", ":transaction") }}';
            route = route.replace(':transaction', transaction);
            $.ajax({
                method: 'GET',
                url: route,
                success: function (res) {
                    $('#listPayment').empty().append(res);
                    $('.dataTables-example').DataTable({
                        pageLength: 10,
                        responsive: true,
                    });
                },
                error: function (err) {
                    toastr.error(err);
                },
            });
        }

    </script>

@endsection
