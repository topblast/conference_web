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
        factory(App\Models\Conference::class, 50)->create(); 
        
    }
}