<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    $imgSource = $faker->image('file:///C:/xampp/htdocs/pldha/storage/app/public', 200, 200, 'people');
    $publicImg = config('app.url') . '/storage/' . basename($imgSource);

    return [
        'id_number' => $faker->randomNumber(5) . $faker->randomNumber(5),
        'fullname' => $faker->firstName . ' ' . $faker->lastName. ' ' . $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'country_abbr' => strtoupper($faker->randomLetter.$faker->randomLetter.$faker->randomLetter),
        'state_code' => $faker->randomNumber(2),
        'town_code' => $faker->randomNumber(3),
        'credential_photo' => $publicImg,
        'official_id_photo_back' => $publicImg,
        'official_id_photo_front' => $publicImg,
        'other_official_id_photo' => $publicImg,
        'occupation_code' => $faker->randomNumber(2),
        'occupation' => $faker->jobTitle,
        'member_comment' => $faker->text(100),
        'verified' => $faker->boolean(30),
    ];
});
