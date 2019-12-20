<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>{{ trans('lang.serial_num') }}</th>
        <th>{{ trans('lang.payments.payment_estimated_date') }}</th>
        <th>{{ trans('lang.payments.payment_estimated_amount') }}</th>
        <th>{{ trans('lang.payments.payment_actual_date') }}</th>
        <th>{{ trans('lang.payments.payment_actual_amount') }}</th>
        <th>{{ trans('lang.status') }}</th>
        <th>{{ trans('lang.actions.created_at') }}</th>
        <th>{{ trans('lang.actions.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @isset($payments)
        @forelse($payments as $key => $payment)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $payment->payment_estimated_date }}</td>
                <td>{{ $payment->payment_estimated_amount }}</td>
                <td>{{ $payment->payment_actual_date }}</td>
                <td>{{ $payment->payment_actual_amount }}</td>
                <td>{{ ($payment->payment_actual_amount && $payment->payment_actual_date) ? 'Approved' : 'Pending' }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <a
                            href="#"
                            title="{{ trans('lang.actions.edit') }} {{ trans('lang.transaction.entity') }}"
                            class="btn btn-primary btn-sm"
                            data-href="{{ route('payments.edit', [$transaction, $payment]) }}"
                            data-toggle="modal"
                            data-target="#softpyramid_modal"
                        >
                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                        </a>
                        <a
                            title="{{ trans('lang.actions.delete') }} {{ trans('lang.transaction.entity') }}"
                            class="btn btn-danger btn-xs deletePayment"
                            data-payment="{{ $payment->id }}"
                        >
                            <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse
    @endisset
    </tbody>
</table>
