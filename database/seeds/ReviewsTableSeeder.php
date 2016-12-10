<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the reviews table.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'title' => 'Not impression',
            'content' => 'The food is unfortunately very bland',
            'rating'  => 1,
            'user_id' => 1,
            'resto_id' => 1
        ]);
        
        Review::create([
            'title' => 'Best place ever',
            'content' => 'The restaurant is actually really amazing. Love to eat here',
            'rating'  => 5,
            'user_id' => 2,
            'resto_id' => 1
        ]);
        
        Review::create([
            'title' => 'Average place',
            'content' => 'Meh',
            'rating'  => 2,
            'user_id' => 3,
            'resto_id' => 1
        ]);
        
        Review::create([
            'title' => 'Really awesome foooooood',
            'content' => 'Yolo',
            'rating'  => 1,
            'user_id' => 2,
            'resto_id' => 1
        ]);
        
        Review::create([
            'title' => 'Decent',
            'content' => 'This place is okay. Could be better',
            'rating'  => 3,
            'user_id' => 3,
            'resto_id' => 1
        ]);
        
        Review::create([
            'title' => 'AWESOME OMG',
            'content' => 'THIS IS SO GOOOOOOOOD. Dunno why the reviews here are so negative',
            'rating'  => 5,
            'user_id' => 2,
            'resto_id' => 2
        ]);
        Review::create([
            'title' => 'Stop liking everything',
            'content' => 'Bad taste',
            'rating'  => 1,
            'user_id' => 1,
            'resto_id' => 2
        ]);
        Review::create([
            'title' => 'Another mediocre restaurant',
            'content' => 'Will I ever find any amazing restaurant',
            'rating'  => 2,
            'user_id' => 3,
            'resto_id' => 3
        ]);
        Review::create([
            'title' => 'No',
            'content' => 'You wont',
            'rating'  => 1,
            'user_id' => 1,
            'resto_id' => 3
        ]);
        
        Review::create([
            'title' => 'this is place is so mazing yo',
            'content' => 'AMAZING FOOOD EVERYWHERE, im full',
            'rating'  => 5,
            'user_id' => 2,
            'resto_id' => 3
        ]);
        Review::create([
            'title' => 'meh',
            'content' => 'meh',
            'rating'  => 2,
            'user_id' => 3,
            'resto_id' => 3
        ]);
        Review::create([
            'title' => 'ditto',
            'content' => 'ditto',
            'rating'  => 1,
            'user_id' => 1,
            'resto_id' => 3
        ]);
        Review::create([
            'title' => 'booo buzzkill much',
            'content' => 'amazing food yo',
            'rating'  => 5,
            'user_id' => 2,
            'resto_id' => 3
        ]);
        
        Review::create([
            'title' => 'blal blah bhal',
            'content' => 'blah blah blah blah blah blah blah blah',
            'rating'  => 1,
            'user_id' => 1,
            'resto_id' => 3
        ]);
        Review::create([
            'title' => 'yolo yolo yolo yolo yolo',
            'content' => 'yolo yolo yolo yolo yolo yolo yolo yolo yolo yolo',
            'rating'  => 5,
            'user_id' => 1,
            'resto_id' => 4
        ]);
        
        Review::create([
            'title' => 'spam',
            'content' => 'spam spam spam spam spam spam spam spam spam spam spam spam spam spam spam spam',
            'rating'  => 5,
            'user_id' => 2,
            'resto_id' => 4
        ]);
    }
}
