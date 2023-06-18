<?php

namespace Database\Seeders;

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
        //Roda o seeder de estados
//        $this->call(Estados::class);
        //Roda o seeder de cidades
//        $this->call(Cidades::class);
        //Roda a factory UserFactory
       \App\Models\User::factory(10)->create();
    }
}
