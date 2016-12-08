<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'thaivuN',
            'email' => 'superwalkurefan@gmail.com',
            'password' =>  bcrypt('bakabaka'),
            'postal_code' => 'h1z2y8'
          
        ]);
        
        User::create([
            'name' => 'dummy',
            'email' => 'deltathaivun@gmail.com',
            'password' =>bcrypt('bakabaka'),
            'postal_code' => 'h1z2y8'
          
        ]);
        
        User::create([
            'name' => 'blahblah',
            'email' => 'test@gmail.com',
            'password' => 'nyanyan',
            'postal_code' => 'h1z2y8'
          
        ]);
    }
}
