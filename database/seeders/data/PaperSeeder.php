<?php

namespace Database\Seeders\data;

use App\Models\Paper;
use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paper::create([
          'user_id' => '1',
          'event_id' => '1',
          'tipo' => 'fotografo',
        ]);
        Paper::create([
          'user_id' => '2',
          'event_id' => '1',
          'tipo' => 'invitado',
        ]);
        Paper::create([
          'user_id' => '3',
          'event_id' => '1',
          'tipo' => 'invitado',
        ]);

    }
}
