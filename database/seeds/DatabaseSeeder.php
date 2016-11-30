<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        
        factory(App\User::class,5);
        
        factory(App\Genre::class,10);
        
        factory(App\Resto::class,15);
        
        factory(App\Address::class,15);
        
        factory(App\Review::class,50);
    }
}
