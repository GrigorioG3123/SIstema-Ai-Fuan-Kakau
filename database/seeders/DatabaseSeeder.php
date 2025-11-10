<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            KafeTipuSeeder::class,
            ArmajenSeeder::class,
            ProdutorSeeder::class,
            UserSeeder::class,
        ]);
    }
}
