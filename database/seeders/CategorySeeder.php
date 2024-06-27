<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            ['name' => 'Для женщин'],
            ['name' => 'Для мужчин'],
            ['name' => 'Для детей'],
            ['name' => 'Для дома'],
            ['name' => 'Техника'],
            ['name' => '18+'],
            ['name' => 'Другое'],
            ['name' => 'Витамины'],
            ['name' => 'Продукты'],
            ['name' => 'Универсальный'],
         ];

        Category::insert($categories);
    }
}
