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
        
        $users=factory(App\User::class,5);
        
        $genres=factory(App\Genre::class,10);
        
        $restos=factory(App\Resto::class,15);
        
        $addresses=factory(App\Address::class,15);
        
        $reviews=factory(App\Review::class,50);
    }
}
