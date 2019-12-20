<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>{{ trans('lang.serial_num') }}</th>
        <th>{{ trans('lang.transaction.transaction_detail') }}</th>
        <th>{{ trans('lang.transaction.transaction_sales_date') }}</th>
        <th>{{ trans('lang.transaction.transaction_sales_price') }}</th>
        <th>{{ trans('lang.payments.page_title') }}</th>
        <th>{{ trans('lang.actions.created_at') }}</th>
        <th>{{ 'Completed At' }}</th>
    </tr>
    </thead>
    <tbody>
    @isset($transactions)
        @forelse($transactions as $key => $transaction)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $transaction->transaction_detail }}</td>
                <td>{{ $transaction->transaction_sales_date }}</td>
                <td>{{ $transaction->transaction_sales_price }}</td>
                <td>
                    <a
                        class="btn btn-xs btn-success"
                        title="{{ trans('lang.payments.attach_payments') }}"
                        href="{{ route('payments', $transaction) }}"
                    >
                        <i class="fa fa-dollar fa-fw"></i>
                    </a>
                </td>
                <td>{{ $transaction->created_at }}</td>
                <td>
                    {{ $transaction->completed_at }}
                </td>
            </tr>
        @empty
        @endforelse
    @endisset
    </tbody>
</table>
