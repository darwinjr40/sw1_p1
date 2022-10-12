<?php

namespace Database\Seeders\data;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      User::create([
        'name'=> 'admin',
        'email'=> 'admin@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);
      User::create([
        'name'=> 'darwin',
        'email'=> 'darwin@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);

      User::create([
        'name'=> 'darwin mamani',
        'email'=> 'darwinjr40@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);


      User::create([
        'name'=> 'fotografo',
        'email'=> 'fotografo@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);

      User::create([
        'name'=> 'fotografo2',
        'email'=> 'fotografo2@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);

      User::create([
        'name'=> 'invitado2',
        'email'=> 'invitado2@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);

      User::create([
        'name'=> 'messi',
        'email'=> 'messi@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);

      User::create([
        'name'=> 'cr7',
        'email'=> 'cr7@gmail.com',
        'password'=> Hash::make('0000'),
        // 'rol_id'=> 1
      ]);
    }
}
