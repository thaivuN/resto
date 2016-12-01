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
        
        factory(App\User::class,5)->create();
        
        factory(App\Genre::class,10)->create();
        
        factory(App\Resto::class)->create();
        
        factory(App\Address::class)->create(['postal_code'=>'H1Z 3S8',]);
        factory(App\Address::class)->create(['postal_code'=>'H1Z 4A8',]);
        factory(App\Address::class)->create(['postal_code'=>'H1K 3G4',]);
        factory(App\Address::class)->create(['postal_code'=>'H1Z 2Y8',]);
        
        factory(App\Review::class,15)->create(['resto_id'=>'1']);
        factory(App\Review::class,15)->create(['resto_id'=>'2']);
        factory(App\Review::class,15)->create(['resto_id'=>'3']);
    }
}
