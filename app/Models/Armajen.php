<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armajen extends Model
{
    use HasFactory;

    protected $table = 'armajens';

    protected $primaryKey = 'id_armajen';

    protected $fillable = [
        'naran_armajen',
        'lokalisasaun',
        'kapasidade_max',
        'kapasidade_atual',
        'status',
    ];

    protected $casts = [
        'kapasidade_max' => 'decimal:2',
        'kapasidade_atual' => 'decimal:2',
    ];
}
