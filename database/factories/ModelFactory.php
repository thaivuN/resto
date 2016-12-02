<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'          => $faker->name,
        'email'         => $faker->unique()->safeEmail,
        'password'      => $password ?: $password = bcrypt('secret'),
        'remember_token'=> str_random(10),
        'postal_code'   => $faker->postcode,
    ];
});

$factory->define(App\Review::class,function (Faker\Generator $faker){
    return [
        'title'         =>$faker->text,
        'content'       =>$faker->paragraph,
        'rating'        =>$faker->randomFloat(2, 1, 5),
        'user_id'       =>function(){
            return factory(App\User::class)->create()->id;
        },
        'resto_id'      =>function(){
            return factory(App\Resto::class)->create()->id;
        },
    ];
});

/**
 * Generates mock Resto records.
 */
$factory->define(App\Resto::class,function (Faker\Generator $faker){
    return [
        'name'          => $faker->company,
        'description' => $faker->paragraph,
        'price'         => $faker->numberBetween(1,5),
        'phone'        => $faker->phoneNumber,
        'user_id'       =>function(){
            return factory(App\User::class)->create()->id;
        },
        'civic_num'       => $faker->buildingNumber,
        'street'       => $faker->streetName,
        'suite'        => $faker->numberBetween(1,999),
        'city'         => $faker->city,
        'country'      => $faker->country,
        'postal_code'  => $faker->postcode,
        'longitude'    => $faker->longitude,
        'latitude'     => $faker->latitude,
        'genre_id'      =>function(){
            return factory(App\Genre::class)->create()->id;
        }
        
    ];
});

/**
 * Generates mock Addresses.
 */
/**
$factory->define(App\Address::class,function (Faker\Generator $faker){
    return [
        'civic_num'       => $faker->buildingNumber,
        'street'       => $faker->streetName,
        'suite'        => $faker->numberBetween(1,999),
        'city'         => $faker->city,
        'country'      => $faker->country,
        'postal_code'  => $faker->postcode,
        'longitude'    => $faker->longitude,
        'latitude'     => $faker->latitude,
        'resto_id'     => function(){
            return factory(App\Resto::class)->create()->id;
        }
    ];
});
*/

/**
 * Generates mock Genres, will be made of first names.
 */
$factory->define(App\Genre::class,function (Faker\Generator $faker){
    return [
      'genre'         => $faker->unique()->firstName
    ];
});
