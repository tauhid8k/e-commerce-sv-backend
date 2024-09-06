<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'parent_id' => null,  // Root category
                'name' => 'Men',
                'slug' => str()->slug('Men'),
                'is_visible' => true,
            ],
            [
                'parent_id' => 1,  // Child of Men Category
                'name' => 'T-Shirt',
                'slug' => str()->slug('T-Shirt'),
                'is_visible' => true,
            ],
        ]);
    }
}
