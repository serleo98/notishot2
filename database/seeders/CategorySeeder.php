<?php

namespace Database\Seeders;
use App\Models\Note\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('description' , "Covid");
        is_null($category)? : Category::create(['description' => "Covid",'status' => true]);
    }
}
