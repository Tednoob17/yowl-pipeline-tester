<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = [
            [
                'stars' => 5,
                'user_from' => 1,
                'user_to' => 2
            ],
        ];

        foreach ($notes as $note) {
            Note::create($note);
        }
    }
}
