<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TransactionController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_view')))
            return $this->permission_denied();

        return view('dashboard.transaction.index')
                ->with([
                    'page_title' => trans('lang.transaction.page_title'),
                    'entity' => trans('lang.transaction.entity'),
                ]);
    }


    public function list()
    {
        $transactions = $this->loggedInUser->transactions()
                        ->orderBy('created_at', 'DESC')
                        ->get();

        if($this->loggedInUser->hasRole('admin'))
            $transactions = Transaction::orderBy('created_at', 'DESC')->get();


        return view('dashboard.transaction.list')
                ->with('transactions', $transactions);
    }


    public function completed_list()
    {
        $transactions = $this->loggedInUser->transactions()
                        ->whereNotNull('completed_at')
                        ->orderBy('completed_at', 'DESC')
                        ->get();

        if($this->loggedInUser->hasRole('admin'))
            $transactions = Transaction::whereNotNull('completed_at')->orderBy('completed_at', 'DESC')->get();


        return view('dashboard.transaction.completed_list')
                ->with('transactions', $transactions);
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
    public function store(TransactionRequest $request)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_add')))
            return $this->json_permission_denied();

        $transaction = Transaction::create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        $response = $transaction ? ['code' => 201, 'message' => 'Transaction created successfully. You can attach Payments now.', 'transaction' => $transaction] : ['code' => 500, 'message' => 'Transaction could not be created. Try again'];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_edit')) || $transaction->completed_at == null)
            return $this->permission_denied();

        return view('dashboard.transaction.edit')
                ->with('transaction', $transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_edit')) || $transaction->completed_at == null)
            return $this->json_permission_denied();

        $update = $transaction->fill($request->all())->save();
        $response = $update ? ['code' => 204, 'message' => 'Transaction updated successfully.', 'transaction' => $transaction] : ['code' => 500, 'message' => 'Transaction could not be updated. Try again'];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        if(!(loggedInUserRole() instanceof Role && loggedInUserRole()->hasPermissionTo('transaction_delete')) || $transaction->completed_at == null)
            return $this->json_permission_denied();

        $response = $transaction->delete() ? ['code' => 204, 'message' => 'Transaction deleted successfully.'] : ['code' => 500, 'message' => 'Transaction could not be deleted. Try again'];
        return response()->json($response, 200);
    }
}
