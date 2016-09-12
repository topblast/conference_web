<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Attendee;  
use Illuminate\Database\Seeder;

class AttendeeTableSeeder extends Seeder  
{
    public function run()
    {
        factory(App\Models\Attendee::class, 50)->create(); 
       
    }
}