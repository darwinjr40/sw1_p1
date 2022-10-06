<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Database\Seeders\data\PaperSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(UserSeeder::class);
        $this->call('Database\Seeders\data\UserSeeder');
        $this->call('Database\Seeders\data\CategorySeeder');
        $this->call('Database\Seeders\data\EventSeeder');
        $this->call('Database\Seeders\data\EventFileSeeder');
        $this->call(PaperSeeder::class);
    }
}
