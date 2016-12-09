<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create(['genre' => 'Fast Food']);
        Genre::create(['genre' => 'Fine Dining']);
        Genre::create(['genre' => 'Japanese']);
        Genre::create(['genre' => 'Breakfast']);
        Genre::create(['genre' => 'Vietnamese']);
        Genre::create(['genre' => 'Greek']);
        Genre::create(['genre' => 'Mexican']);
        Genre::create(['genre' => 'Bar']);
        Genre::create(['genre' => 'Steakhouse']);
        Genre::create(['genre' => 'Italian']);
        Genre::create(['genre' => 'Chinese']);
        Genre::create(['genre' => 'Buffet']);
        Genre::create(['genre' => 'Diner']);
        Genre::create(['genre' => 'Sea Food']);
        
        
    }
}
