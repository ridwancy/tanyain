<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\User;
use App\Models\Question;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        Subject::create([
            'name_subject' => 'Matematika',
            'slug' => 'matematika'
        ]);

        Subject::create([
            'name_subject' => 'Kimia',
            'slug' => 'kimia'
        ]);

        Subject::create([
            'name_subject' => 'Fisika',
            'slug' => 'fisika'
        ]);

        Subject::create([
            'name_subject' => 'Biologi',
            'slug' => 'biologi'
        ]);

        Subject::create([
            'name_subject' => 'Ekonomi',
            'slug' => 'ekonomi'
        ]);

        Subject::create([
            'name_subject' => 'Sosiologi',
            'slug' => 'sosiologi'
        ]);

        Subject::create([
            'name_subject' => 'Pertanian',
            'slug' => 'pertanian'
        ]);

        Question::factory(20)->create();
        Answer::factory(30)->create();
        Comment::factory(45)->create();
    }
}