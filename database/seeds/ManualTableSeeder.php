<?php

use Illuminate\Database\Seeder;

class ManualTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        $this->call("UsersTableSeeder");
        $this->call("GenresTableSeeder");
        $this->call("RestosTableSeeder");
        $this->call("ReviewsTableSeeder");
    }
}
