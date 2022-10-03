<?php

namespace Database\Seeders\data;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
          'category_id' => 1,
          'titulo' => 'Conferencias Uagrm',
          'descripcion' => 'Bienvenidos a las conferencias uagrm, para un mejor desarollo',
          'tipo' => 'fotos',
          'fecha' => now()->format("Y-m-d H:i:s"),
        ]);
        Event::create([
          'category_id' => 1,
          'titulo' => 'Concierto Rock',
          'descripcion' => 'El mejor concierto de todos',
          'tipo' => 'asistencia',
          'fecha' => now()->format("Y-m-d H:i:s"),
        ]);
        Event::create([
          'category_id' => 1,
          'titulo' => 'Conferencia',
          'descripcion' => 'confraternizacion',
          'tipo' => 'publico',
          'fecha' => now()->format("Y-m-d H:i:s"),
        ]);
    }
}
