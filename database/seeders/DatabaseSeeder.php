<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Department::factory()->create(
            [
                "name" => "CSE"
            ]
        );
        \App\Models\Department::factory()->create(
            [
                "name" => "EEE"
            ]
        );

        \App\Models\Department::factory()->create(
            [
                "name" => "CIVIL"
            ]
        );

        \App\Models\Batch::factory(10)->create();
        \App\Models\Subject::factory(100)->create();
        \App\Models\Teacher::factory(40)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
