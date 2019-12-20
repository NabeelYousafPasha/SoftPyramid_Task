<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $payment = $this->route('payment');
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    $rules = [];
                    $rules['payment_estimated_date'] = 'required|date';
                    $rules['payment_estimated_amount'] = 'required|numeric';
                    if (auth()->user()->hasRole('admin'))
                    {
                        $rules['payment_actual_date'] = 'required|date|after_or_equal:payment_estimated_date';
                        $rules['payment_actual_amount'] = 'required|numeric|in:'.request()->payment_estimated_amount;
                    }
                    return $rules;
                }
            case 'PUT':
            case 'PATCH':
                {
                    $rules = [];
                    $rules = [
                        'payment_estimated_date' => 'required|date',
                        'payment_estimated_amount' => 'required|numeric',
                    ];
                    if (auth()->user()->hasRole('admin'))
                    {
                        $rules['payment_actual_date'] = 'required|date|after_or_equal:payment_estimated_date';
                        $rules['payment_actual_amount'] = 'required|numeric|in:'.request()->payment_estimated_amount;
                    }
                    return $rules;
                }
            default:break;
        }
    }

    public function attributes()
    {
        return [
            'payment_estimated_date' => trans('lang.payments.payment_estimated_date'),
            'payment_estimated_amount' => trans('lang.payments.payment_estimated_amount'),
            'payment_actual_date' => trans('lang.payments.payment_actual_date'),
            'payment_actual_amount' => trans('lang.payments.payment_actual_amount'),
        ];
    }
}
