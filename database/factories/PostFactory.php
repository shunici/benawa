<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\produk;
use Faker\Generator as Faker;

$factory->define(produk::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'satuan' => 'cm'  
        
    ];
});
