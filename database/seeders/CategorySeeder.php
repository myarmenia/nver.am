<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Для женщин'],
            ['name' => 'Для мужчин'],
            ['name' => 'Для детей'],
            ['name' => 'Для дому'],
            ['name' => 'Техника'],
            ['name' => '+18'],
            ['name' => 'Другое'],
            ['name' => 'Витамины'],
            ['name' => 'Продукты'],
        ];

        Category::insert($categories);
    }
}
