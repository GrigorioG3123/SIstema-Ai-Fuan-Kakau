<?php

namespace Database\Seeders;

use App\Models\Produtor;
use Illuminate\Database\Seeder;

class ProdutorSeeder extends Seeder
{
    public function run()
    {
        $produtors = [
            [
                'naran_produtor' => 'João Silva',
                'telefone' => '+670 123 4567',
                'suku' => 'Tetum'
            ],
            [
                'naran_produtor' => 'Maria Santos',
                'telefone' => '+670 234 5678',
                'suku' => 'Mambai'
            ],
            [
                'naran_produtor' => 'Pedro Costa',
                'telefone' => '+670 345 6789',
                'suku' => 'Makassae'
            ]
        ];

        foreach ($produtors as $produtor) {
            Produtor::create($produtor);
        }
    }
}
