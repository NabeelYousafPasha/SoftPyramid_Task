<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4 class="modal-title">{!! trans('lang.actions.edit').' '.trans('lang.transaction.entity') !!}</h4>
</div>
<div class="modal-body">
    <form
        id="editTransactionForm"
        name="editTransactionForm"
    >
        @method('PATCH')
        @include('dashboard.transaction.form')
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <button
        type="button"
        class="btn btn-primary"
        data-transaction="{{ $transaction->id ?? '' }}"
        id="editTransactionButton"
    >{{ trans('lang.actions.save') }}</button>
</div>
