<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Category;  
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder  
{
    public function run()
    {
        factory(App\Models\Category::class, 50)->create(); 
	
    }
}