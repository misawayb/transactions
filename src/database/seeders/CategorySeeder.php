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
            ['name' =>'給与', 'type' => '収入'],
            ['name' => '賞与', 'type' => '収入'],
            ['name' => '食費', 'type' => '支出'],
            ['name' => '住宅', 'type' => '支出'],
            ['name' => '光熱費', 'type' => '支出'],
            ['name' => 'その他', 'type' => '収入'],
            ['name' => 'その他', 'type' => '支出'],
        ];

        foreach ($categories as $category){
            Category::firstOrCreate($category);
        }
    }
}
