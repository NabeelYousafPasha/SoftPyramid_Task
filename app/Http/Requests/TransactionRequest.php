<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $transaction = $this->route('transaction');
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'transaction_detail' => 'required',
                        'transaction_sales_date' => 'required|date',
                        'transaction_sales_price' => 'required|numeric',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'transaction_detail' => 'required',
                        'transaction_sales_date' => 'required|date',
                        'transaction_sales_price' => 'required|numeric',
                    ];
                }
            default:break;
        }
    }


    public function attributes()
    {
        return [
            'transaction_detail' => trans('lang.transaction.transaction_detail'),
            'transaction_sales_date' => trans('lang.transaction.transaction_sales_date'),
            'transaction_sales_price' => trans('lang.transaction.transaction_sales_price'),
        ];
    }
}
