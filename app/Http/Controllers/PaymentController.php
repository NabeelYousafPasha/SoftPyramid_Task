<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Payment;
use App\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('payment_view')))
            return $this->permission_denied();

        return view('dashboard.payment.index')
            ->with([
                'page_title' => trans('lang.payments.page_title'),
                'entity' => trans('lang.payments.entity'),
            ])
            ->with('transaction', $transaction);
    }


    public function list(Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role == 'admin') || $transaction->user_id == $this->loggedInUser->id){
            $payments = $transaction->payments()
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('dashboard.payment.list')
            ->with('payments', $payments)
            ->with('transaction', $transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request, Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_edit')) && ($transaction->user_id != $this->loggedInUser->id))
            return $this->json_permission_denied();

        $payment = Payment::create(array_merge($request->all(), ['transaction_id' => $transaction->id]));
        $response = $payment ? ['code' => 201, 'message' => 'Payment attached successfully.', 'payment' => $payment] : ['code' => 500, 'message' => 'Payment could not be attached. Try again'];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction, Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction, Payment $payment)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('payment_edit')) && ($transaction->user_id != $this->loggedInUser->id))
            return $this->permission_denied('transactions.list');

        return view('dashboard.payment.edit')
            ->with('payment', $payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Transaction $transaction, Payment $payment)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('payment_edit')) && ($transaction->user_id != $this->loggedInUser->id))
            return $this->json_permission_denied();

        $update = $payment->fill($request->all())->save();
        $response = $update ? ['code' => 204, 'message' => 'Attached Payment updated successfully.', 'payment' => $payment] : ['code' => 500, 'message' => 'Attached Payment could not be updated. Try again'];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, Payment $payment)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('payment_delete')) && ($transaction->user_id != $this->loggedInUser->id))
           return $this->json_permission_denied();

        $response = $payment->delete() ? ['code' => 204, 'message' => 'Payment deleted successfully.'] : ['code' => 500, 'message' => 'Payment could not be deleted. Try again'];
        return response()->json($response, 200);
    }
}
