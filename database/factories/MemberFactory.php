<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    $imgSource = $faker->image('file:///C:/xampp/htdocs/pldha/storage/public', 100, 100, 'cats');
    $publicImg = 'http://localhost/pldha/storage/public/' . basename($imgSource);
    return [
        'fullname' => $faker->firstName . ' ' . $faker->lastName. ' ' . $faker->lastName,
        'ocuppation_code' => $faker->randomNumber(2),
        'country_abbr' => strtoupper($faker->randomLetter.$faker->randomLetter.$faker->randomLetter),
        'state_code' => $faker->randomNumber(2),
        'town_code' => $faker->randomNumber(3),
        'official_id_photo_back' => $publicImg,
    ];
});
