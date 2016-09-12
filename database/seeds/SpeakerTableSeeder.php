<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Speaker;  
use Illuminate\Database\Seeder;

class SpeakerTableSeeder extends Seeder  
{
    public function run()
    {
        factory(App\Models\Speaker::class, 50)->create(); 
       
    }
}