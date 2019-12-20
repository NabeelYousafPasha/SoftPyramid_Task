@csrf

<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>

<div class="form-group @error('payment_estimated_date') 'has-error' @enderror">
    <label class="control-label">{{ trans('lang.payments.payment_estimated_date') }} *</label>
    <input
        type="date"
        class="form-control"
        name="payment_estimated_date"
        placeholder=""
        value="{{ $payment->payment_estimated_date ?? date('Y-m-d') }}"
        required
    >

    @error('payment_estimated_date')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group @error('payment_estimated_amount') 'has-error' @enderror">
    <label class="control-label">{{ trans('lang.payments.payment_estimated_amount') }} *</label>
    <input
        type="number"
        class="form-control"
        name="payment_estimated_amount"
        placeholder=""
        value="{{ $payment->payment_estimated_amount ?? old('payment_estimated_amount') }}"
        min="0"
        required
    >

    @error('payment_estimated_amount')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@if(auth()->user()->hasRole('admin'))
    <div class="form-group @error('payment_actual_date') 'has-error' @enderror">
        <label class="control-label">{{ trans('lang.payments.payment_actual_date') }} *</label>
        <input
            type="date"
            class="form-control"
            name="payment_actual_date"
            placeholder=""
            value="{{ $payment->payment_actual_date ?? date('Y-m-d') }}"
            required
        >

        @error('payment_actual_date')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group @error('payment_actual_amount') 'has-error' @enderror">
        <label class="control-label">{{ trans('lang.payments.payment_actual_amount') }} *</label>
        <input
            type="number"
            class="form-control"
            name="payment_actual_amount"
            placeholder=""
            value="{{ $payment->payment_actual_amount ?? old('payment_actual_amount') }}"
            min="0"
            required
        >

        @error('payment_actual_amount')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
@endif
