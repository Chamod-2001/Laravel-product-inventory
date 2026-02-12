<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert the sample data into tag table, tag array
        $tags = [
            'New',
            'Sale',
            'Winter'
        ];

        // Insert tags into table using for loop
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag
            ]);
        }
    }
}
