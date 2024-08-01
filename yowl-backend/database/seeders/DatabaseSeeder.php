<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->withPersonalTeam()->create();

        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Georges AYENI',
        //     'email' => 'admin@mail.com',
        // ]);

        $this->call([
            // NoteSeeder::class,
            ReportSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
