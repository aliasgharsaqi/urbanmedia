<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'DJ Night'],
            ['name' => 'Karaoke Night'],
            ['name' => 'Bollywood Night'],
            ['name' => 'EDM'],
            ['name' => 'Ladies Night'],
            ['name' => 'Band Performance'],
            ['name' => 'Comedy Night'],
            ['name' => 'Concert'],
            ['name' => 'Exclusive Night'],
            ['name' => 'Offers'],
            ['name' => 'Outdoor Adventure'],
            ['name' => 'Highape Premium'],
            ['name' => 'Fine Dine'],
            ['name' => 'Indoor Adventures'],
            ['name' => 'Nation Wide'],
            ['name' => 'Others'],
        ];

        // This will check if a category with the given name exists.
        // If it does, it does nothing. If it doesn't, it creates it.
        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']]);
        }
    }
}
