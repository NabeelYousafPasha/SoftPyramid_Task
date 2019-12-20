@extends('dashboard.layout.app')
@section('stylesheets')
    <link href="{{ asset('backend-assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
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
        <div class="col-lg-4" style="float: right;">
            <h2></h2>
            <a
                href="javascript:void(0)"
                class="btn btn-primary"
                id="view_completed__transaction"
            >
                Completed List
            </a>
            <a
                href="javascript:void(0)"
                class="btn btn-primary"
                id="add_new__transaction"
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
                        <div class="table-responsive" id="listTransaction">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modals">
        {{-- ___________________________ MODAL CREATE __________________________ --}}
        <div class="modal inmodal" id="createTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{{ trans('lang.actions.add_new') }} {{ $entity }}</h4>
                    </div>
                    <div class="modal-body">
                        <form
                            id="createTransactionForm"
                            name="createTransactionForm"
                        >
                            @include('dashboard.transaction.form')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createTransactionButton">{{ trans('lang.actions.save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ___________________________ MODAL DELETE __________________________ --}}
        <div class="modal inmodal" id="deleteTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button type="button" class="btn btn-danger" id="deleteTransactionButton">Delete</button>
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
            listOfTransactions();

            /* ----------------------
            // create
            *  ----------------------
            */
            $('#add_new__transaction').on('click', function (e) {
                $('#createTransactionModal').modal();
            });

            /* ----------------------
            // store
            *  ----------------------
            */
            $('#createTransactionButton').on('click', function () {
               $.ajax({
                   method: 'POST',
                   url: '{!! route('transactions.store') !!}',
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data: $("#createTransactionForm").serialize(),
                   success: function (res) {
                       listOfTransactions();
                       $('#createTransactionModal').modal('toggle');
                       if (res.code == 201)
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
            // update
            *  ----------------------
            */
            $('#softpyramid_modal').on('click', '#editTransactionButton', function () {
                let transaction = $(this).data('transaction');
                let route = '{{ route("transactions.update", ":id") }}';
                route = route.replace(':id', transaction);
                $.ajax({
                    method: 'POST',
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $("#editTransactionForm").serialize(),
                    success: function (res) {
                        listOfTransactions();
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
            $('#listTransaction').on('click', '.deleteTransaction', function (e) {
                $('#deleteTransactionModal').modal('show');
                $('#deleteTransactionButton').attr('data-transaction', $(this).attr('data-transaction'));
            });

            $('#deleteTransactionButton').on('click', function (e) {
                let transaction = $(this).attr('data-transaction');
                let route = '{{ route("transactions.delete", ":id") }}';
                route = route.replace(':id', transaction);
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
                        listOfTransactions();
                        $('#deleteTransactionModal').modal('hide');
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

            $("#deleteTransactionModal").on("hide.bs.modal", function(t) {
                $('#deleteTransactionButton').attr("data-transaction" , '');
                $('#deleteTransactionButton').removeAttr('data-transaction');
            });

            // remove errors on close modal
            $("#createTransactionModal").on("hide.bs.modal", function(t) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','none');
            });

            // completed
            $('#view_completed__transaction').on('click', function () {
                listOfCompletedTransactions();
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
        function listOfTransactions() {
            $.ajax({
                method: 'GET',
                url: '{!! route('transactions.list') !!}',
                success: function (res) {
                    $('#listTransaction').empty().append(res);
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

        // completed list
        function listOfCompletedTransactions() {
            $.ajax({
                method: 'GET',
                url: '{!! route('transactions.completed.list') !!}',
                success: function (res) {
                    $('#listTransaction').empty().append(res);
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
