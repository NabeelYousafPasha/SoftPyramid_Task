<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4 class="modal-title">{!! trans('lang.actions.edit').' '.trans('lang.payments.entity') !!}</h4>
</div>
<div class="modal-body">
    <form
        id="editPaymentForm"
        name="editPaymentForm"
    >
        @method('PATCH')
        @include('dashboard.payment.form')
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <button
        type="button"
        class="btn btn-primary"
        data-payment="{{ $payment->id ?? '' }}"
        id="editPaymentButton"
    >{{ trans('lang.actions.save') }}</button>
</div>
