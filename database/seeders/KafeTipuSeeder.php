<?php

namespace Database\Seeders;

use App\Models\KafeTipu;
use Illuminate\Database\Seeder;

class KafeTipuSeeder extends Seeder
{
    public function run()
    {
        $kafeTipus = [
            [
                'naran_tipu' => 'Arabica Organic',
                'deskrisaun' => 'Kafé Arabika organiku ho sertifikasaun internasionál',
                'folin_base' => 8.50,
                'kategoria' => 'Premium'
            ],
            [
                'naran_tipu' => 'Robusta Select',
                'deskrisaun' => 'Kafé Robusta ho kualidade aas ba merkadu lokal',
                'folin_base' => 6.00,
                'kategoria' => 'Standard'
            ],
            [
                'naran_tipu' => 'Timor Hybrid',
                'deskrisaun' => 'Kafé híbridu karakterístiku Timór nian',
                'folin_base' => 7.50,
                'kategoria' => 'Premium'
            ]
        ];

        foreach ($kafeTipus as $kafe) {
            KafeTipu::firstOrCreate(['naran_tipu' => $kafe['naran_tipu']], $kafe);
        }
    }
}
