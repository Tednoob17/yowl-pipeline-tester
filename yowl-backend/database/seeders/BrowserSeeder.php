<?php

namespace Database\Seeders;

use App\Models\Browser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrowserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Browser::factory()
            ->count(50)
            ->create();
    }
}
