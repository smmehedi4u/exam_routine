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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ],
        [
            'name' => 'mehedi',
            'email' => 'mehedi@gmail.com',
        ],
        [
            'name' => 'siam',
            'email' => 'siam@gmail.com',
        ],
    );
    }
}
