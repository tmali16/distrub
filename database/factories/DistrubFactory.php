<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Distrub;
use Faker\Generator as Faker;

$factory->define(Distrub::class, function (Faker $faker) {
    return [
        "dates"=>$faker->date(),
        "times"=>$faker->time(),
        "descript"=>$faker->text(),
        'whom'=>$faker->randomElement(['prison', 'employee']),
        "serviced"=>1,
        "reg_num"=> random_int(1, 99),//$faker->rand(1, 999),
        "reg_date"=>$faker->date(),
        'dvr_type' =>$faker->randomElement(['dvr', 'bwc']),
        "dvr_num"=>random_int(1, 99),
        "distrub_type"=>1,
        "prision_id"=>random_int(1, 27),
        "operator_id"=>random_int(1, 3),
        "user_id"=>1,
    ];
});
