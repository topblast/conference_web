<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Presentation;  
use Illuminate\Database\Seeder;

class PresentationTableSeeder extends Seeder  
{
    public function run()
    {
        factory(App\Models\Presentation::class, 50)->create(); 
        
    }
}