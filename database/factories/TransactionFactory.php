<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'transaction_detail' => $faker->paragraph(1),
        'user_id' => factory('App\User')->create(),
        'transaction_status' => 'draft',
        'transaction_sales_date' => date('Y-m-d'),
        'transaction_sales_price' => 1000,
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
    ];
});
