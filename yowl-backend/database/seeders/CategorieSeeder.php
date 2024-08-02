<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Technology related news',
                'parent_id' => null,
            ],
            [
                'name' => 'Programming',
                'description' => 'Programming related news',
                'parent_id' => 1,
            ],
            [
                'name' => 'Laravel',
                'description' => 'Laravel related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'VueJS',
                'description' => 'VueJS related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'ReactJS',
                'description' => 'ReactJS related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'JavaScript',
                'description' => 'JavaScript related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Python',
                'description' => 'Python related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Django',
                'description' => 'Django related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'PHP',
                'description' => 'PHP related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Java',
                'description' => 'Java related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'C#',
                'description' => 'C# related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'C++',
                'description' => 'C++ related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Ruby',
                'description' => 'Ruby related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Go',
                'description' => 'Go related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Rust',
                'description' => 'Rust related news',
                'parent_id' => 2,
            ],
            [
                'name' => 'Swift',
                'description' => 'Swift related news',
                'parent_id' => 2,
            ],
        ];

        foreach ($categories as $category) {
            Categorie::create($category);
        }
    }
}
