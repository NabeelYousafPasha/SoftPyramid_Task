<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
</p>

## SoftPyramid Task 

The task is developed in PHP framework, Laravel i.e; v6

- [Task can be found here](https://github.com/softpyramid/laravel-code-challenge).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

#### Schema for the task: MYSQL

<p align="center">
<img src="https://raw.githubusercontent.com/NabeelYousafPasha/SoftPyramid_Task/master/public/softpyramid/softpyramid_task_db.png" width="400">
</p>

#### IDE used is: PHP STORM

<p align="center">
<img src="https://raw.githubusercontent.com/NabeelYousafPasha/SoftPyramid_Task/master/public/softpyramid/phpStorm.png" width="400">
</p>

#### TEST CASES using PHPUNIT

```php

<?php

namespace Tests\Feature\Transaction;

use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function user_can_see_transactions_list()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/transactions')
                    ->assertOk();
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function user_can_create_transaction()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/transactions', $this->data());

        $this->assertCount(1, Transaction::all());
    }


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function transaction_sales_date_is_required()
    {
        $response = $this->post('/transactions', array_merge($this->data(), ['transaction_sales_date' => null]));

        $response->assertSessionHasErrors('transaction_sales_date');
        $this->assertCount(0, Transaction::all());
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function transaction_sales_price_is_required()
    {
        $response = $this->post('/transactions', array_merge($this->data(), ['transaction_sales_price' => null]));

        $response->assertSessionHasErrors('transaction_sales_price');
        $this->assertCount(0, Transaction::all());
    }


    private function data()
    {
        return [
            'transaction_detail' => 'Test Details',
            'user_id' => 2,
            'transaction_status' => 'draft',
            'transaction_sales_date' => date('Y-m-d'),
            'transaction_sales_price' => 1000,
        ];
    }
}

```

#### For Validations: Form Requests


### Payment Request
```php

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


```

### Transaction Request

```php

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


```
