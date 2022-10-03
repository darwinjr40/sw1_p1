<?php

namespace Database\Seeders\data;


use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::create([
        'nombre'=> 'publico',
        'descripcion'=> 'para las confraternizaciones',
      ]);

      Category::create([
        'nombre'=> 'sociable',
        'descripcion'=> 'para reuniones publicas',
      ]);

      Category::create([
        'nombre'=> 'privado',
        'descripcion'=> 'reuniones importantes',
      ]);
    }
}
