<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the sample data into category table, category array
        $categories = [
            'Electronics',
            'Clothing',
            'Books',
            'Home & Kitchen',
            'Sports'
        ];

        // Insert catergories into table using for loop
        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
