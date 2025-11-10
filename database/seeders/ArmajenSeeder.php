<?php

namespace Database\Seeders;

use App\Models\Armajen;
use Illuminate\Database\Seeder;

class ArmajenSeeder extends Seeder
{
    public function run()
    {
        $armajens = [
            [
                'naran_armajen' => 'Armajen Central Dili',
                'lokalisasaun' => 'Dili, Timor-Leste',
                'kapasidade_max' => 10000.00,
                'kapasidade_atual' => 0.00,
                'status' => 'ativu'
            ],
            [
                'naran_armajen' => 'Armajen Baucau',
                'lokalisasaun' => 'Baucau, Timor-Leste',
                'kapasidade_max' => 5000.00,
                'kapasidade_atual' => 0.00,
                'status' => 'ativu'
            ],
            [
                'naran_armajen' => 'Armajen Ermera',
                'lokalisasaun' => 'Ermera, Timor-Leste',
                'kapasidade_max' => 3000.00,
                'kapasidade_atual' => 0.00,
                'status' => 'ativu'
            ]
        ];

        foreach ($armajens as $armajen) {
            Armajen::create($armajen);
        }
    }
}
