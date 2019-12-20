@csrf

<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>

<div class="form-group @error('transaction_detail') 'has-error' @enderror">
    <label class="control-label">{{ trans('lang.transaction.transaction_detail') }} *</label>
    <textarea
        class="form-control"
        name="transaction_detail"
        placeholder="Enter {{ trans('lang.transaction.transaction_detail') }}"
        required
        rows="5"
    >{{ $transaction->transaction_detail ?? old('transaction_detail') }}</textarea>

    @error('transaction_detail')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group @error('transaction_sales_date') 'has-error' @enderror">
    <label class="control-label">{{ trans('lang.transaction.transaction_sales_date') }} *</label>
    <input
        type="date"
        class="form-control"
        name="transaction_sales_date"
        placeholder=""
        value="{{ $transaction->transaction_sales_date ?? date('Y-m-d') }}"
        required
    >

    @error('transaction_sales_date')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group @error('transaction_sales_price') 'has-error' @enderror">
    <label class="control-label">{{ trans('lang.transaction.transaction_sales_price') }} *</label>
    <input
        type="number"
        class="form-control"
        name="transaction_sales_price"
        placeholder=""
        value="{{ $transaction->transaction_sales_price ?? old('transaction_sales_price') }}"
        min="0"
        required
    >

    @error('transaction_sales_price')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
