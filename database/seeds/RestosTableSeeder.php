<?php

use Illuminate\Database\Seeder;
use App\Resto;


class RestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resto::create([
            'name' => 'IMADAKE',
            'description' => 'Japanese izakaya turning out tapas-sized, sustainable dishes & ramen with a long sake list.',
            'price' => 2,
            'phone' => '(514) 931-8833',
            'civic_num' => 1657,
            'street' => 'Rue Sainte-Catherine O',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H3H 1L7',
            'latitude' => 45.4940054,
            'longitude' => -73.5785774,
            'genre_id' => 3,
            'user_id' => 1,
            
        ]);
        
        Resto::create([
            'name' => '3 Amigos',
            'description' => 'Vibrant Mexican venue with weekly specials on tacos & fajitas, plus margaritas & birthday gifts.',
            'price' => 2,
            'phone' => '(514) 939-3329',
            'civic_num' => 4006,
            'street' => 'Rue Sainte-Catherine',
            'city' => 'Westmount',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H3Z 1P2',
            'latitude' => 45.4830403,
            'longitude' => -73.5939302,
            'genre_id' => 6,
            'user_id' => 1,
            
        ]);
        
        Resto::create([
            'name' => 'Chez Nick',
            'description' => 'Family-run deli/diner open since 1920 for classic & modern standards, with counter seating & booths.',
            'price' => 2,
            'phone' => '(514) 935-0946',
            'civic_num' => 1377,
            'street' => 'Avenue Greene',
            'city' => 'Westmount',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H3Z 2A5',
            'latitude' => 45.4876287,
            'longitude' =>-73.5907046,
            'genre_id' => 4,
            'user_id' => 2,
            
        ]);
        
        Resto::create([
            'name' => 'Restaurant Pho Ngon',
            'price' => 2,
            'phone' => '(514) 723-6466',
            'civic_num' => 1377,
            'street' => 'Boul Crémazie E',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H1Z 4M5',
            'latitude' => 45.5617231,
            'longitude' =>-73.6080074,
            'genre_id' => 5,
            'user_id' => 1,
            
        ]);
    }
}
