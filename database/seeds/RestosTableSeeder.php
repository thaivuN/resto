<?php

use Illuminate\Database\Seeder;
use App\Resto;


class RestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the restos table.
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
        
        Resto::create([
            'name' => 'Tim Hortons',
            'price' => 1,
            'description' => 'Canadian chain selling signature premium-blend coffee, plus light fare like pastries, panini & soup.',
            'phone' => '((514) 727-3432',
            'civic_num' => 8055,
            'street' => 'Boulevard Saint-Michel',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H1Z 3C9',
            'latitude' => 45.5632569,
            'longitude' =>-73.6076287,
            'genre_id' => 1,
            'user_id' => 1,
            'image_link' => "http://www.expatechodubai.com/wp-content/uploads/2011/10/tim-hortons-dubai-300x240.jpg"
        ]);
        
        Resto::create([
            'name' => 'Restaurant Deli Plus',
            'price' => 1,
            'description' => 'Utilitarian deli offering sandwiches, pizzas & other simple grub plus take-out & delivery services.',
            'phone' => '(514) 721-1500',
            'civic_num' => 1675,
            'street' => 'Rue Villeray',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H2E 1H5',
            'latitude' => 45.5522408,
            'longitude' =>-73.6136669,
            'genre_id' => 1,
            'user_id' => 2,
            'link' => "http://citemenu.ca/restodeliplus/menu.html"
        ]);
        
        Resto::create([
            'name' => 'Sol y Mar Restaurant',
            'price' => 3,
            'description' => 'Casual, 2-floor venue serving traditional Peruvian fare, with private wine imports & weekend brunch.',
            'phone' => '(514) 273-4446',
            'civic_num' => 7610,
            'street' => 'Rue St-Hubert',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H2R 2N6',
            'latitude' => 45.5522408,
            'longitude' =>-73.6136669,
            'genre_id' => 14,
            'user_id' => 3,
            'link' => "http://www.restaurantsolymar.com/menu/"
        ]);
        
        Resto::create([
            'name' => 'Sol y Mar Restaurant',
            'price' => 3,
            'description' => 'Casual, 2-floor venue serving traditional Peruvian fare, with private wine imports & weekend brunch.',
            'phone' => '(514) 273-4446',
            'civic_num' => 7610,
            'street' => 'Rue St-Hubert',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H2R 2N6',
            'latitude' => 45.5434484,
            'longitude' =>-73.6195948,
            'genre_id' => 14,
            'user_id' => 3,
            'link' => "http://www.restaurantsolymar.com/menu/"
        ]);
        
        Resto::create([
            'name' => 'Queue de Cheval',
            'price' => 4,
            'description' => 'Aged steaks, cocktails & cigars are on offer in this swanky stone mansion with patio seating.',
            'phone' => '(514) 390-0091',
            'civic_num' => 1181,
            'street' => 'Rue de la Montagne',
            'city' => 'Montréal',
            'province' => 'QC',
            'country' => 'Canada',
            'postal_code' => 'H3G 1Z2',
            'latitude' => 45.4974191,
            'longitude' =>-73.5735298,
            'genre_id' => 9,
            'user_id' => 3,
        ]);
        
        
    }
}
