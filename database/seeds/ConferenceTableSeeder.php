<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Conference;
use App\Models\Presentation;
use App\Models\Speaker;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Database\Seeder;

class ConferenceTableSeeder extends Seeder  
{
    public function run()
    {
        /* Attendees::create([
            'name' => 'Winston Churchill',
            'email' => '1.jpg',
			'salted_password' => '123sgjsdhjsw^&^&*&*',
			
        ]);*/
        
        Client::create([
            'contact_name' => 'Shaquanda',
            'email' => 'soccer@q.com',
            'password' => 'hudat',
            'organisation' => 'Nastradamus',
            'address1' => 'Daz not an address',
            'city' => 'Compton',
            'country' => 'Hell',
        ]);
        
        Client::insert([
            'contact_name' => 'Spiderman',
            'email' => 'deez@nutscom',
            'password' => 'Pingingly',
            'organisation' => 'Villuminati',
            'address1' => 'Ultimecia',
            'city' => 'Coronary',
            'country' => 'Heaven',
        ]);

         Conference::create([
            'client_id' => '1',
            'name' => 'Anakin',
            'type' => 'public',
            'address1' => 'Inuit',
            'city' => 'Hell',
            'country' => 'Heaven',
            'start_time' => '10/06/2016 10:09',
            'end_time' => '10/06/2016 10:19',
        ]
       ); 
         
          Conference::insert([
            'client_id' => '2',
            'name' => 'Luke Skywalker',
            'type' => 'public',
            'address1' => 'Tattooine',
            'city' => 'Dantooine',
            'country' => 'Star Wars',
            'start_time' => '10/06/2016 11:09',
            'end_time' => '10/06/2016 12:19',
        ]
       ); 
         
        Room::create([
            'name' => 'Gully',
            'conference_id' => '1',
            
        ]); 
        
        Room::insert([
            'name' => 'Gaza',
            'conference_id' => '2',
            
        ]); 
         
        Room::insert([
            'name' => 'Weebledon',
            'conference_id' => '1',
            
        ]); 
         
        Presentation::create(
        [
            'room_id' => '1',
            'conference_id' => '1',
            'title' => 'Brap!',
            'abstract' => 'Getsuga Tenshou',
            'keywords' => 'No words',
			
        ]); 
        
        Presentation::insert(
        [
            'room_id' => '2',
            'conference_id' => '2',
            'title' => 'Patter!',
            'abstract' => 'Kuzu Ryu-Sen',
            'keywords' => 'Hurting',
			
        ]); 
          
           Speaker::create([
            'name' => 'That Liar',
            'email' => 'thatemail@dot.com',
            'affiliation' => 'That Affiliation',
            'telephone' => '123-4567',
            'image_path' => 'thisisapath.jpg',
			
        ]); 
           
           Speaker::insert([
            'name' => 'The Speaker',
            'email' => 'theemail@dot.com',
            'affiliation' => 'The Affiliation',
            'telephone' => '123-5467',
            'image_path' => 'thisisapath.jpg',
			
        ]); 
           
           
		
		/*
		Empty Strings work.
		
		Duplicate attendee ID values don't work.
		NULL/null values don't work.
		Values longer than the attribute limit get cut off.
		Attendee ID can be manipulated to be out of sequence, but are in sequence when displayed in database.	
		Minus number Attendee ID values get ignored. Default rules apply here.
		Attendee ID # defaults to highest possible when query is added that is higher than 1 000 000
		Text Strings need the quotes.
		Triple escaped quotes of either variety (''""'', ""''"" or "'""'") give an error upon executing the query
		*/
		
		/*Attendees::create([
            
			'name' => 'Wesley"s Theory',
            'email' => 'a',
			'salted_password' => '',
			
        ]); */
		
		/*   Attendees::create([
            'attendee_id' => NULL,
			'name' => '',
            'email' => 'wqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwtttttttttttttttttttttttttttttttttttttttttttttttttttttttttteeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeejjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjddddddddddddddddddddddddddddddddddddddddddddddddddddddppppppppppppppppppppppppppppppppppppppppppppppppppppppoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooozzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
			'salted_password' => '',
			
        ]);   */

      /* 
		
	  
		Attendees::create([
			'attendee_id' => 'NULL',
            'name' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabcdefghjikllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllliiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiipppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
            'email' => 'NULLA',
			'salted_password' => 'NULL',
			
        ]); */

        //... add more quotes if you want!
    }
}