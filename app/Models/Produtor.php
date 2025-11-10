<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtor extends Model
{
    use HasFactory;

    protected $table = 'produtors';
    protected $primaryKey = 'id_produtor';
    public $timestamps = true;

    protected $fillable = [
        'naran_produtor',
        'telefone',
        'suku',
        'data_rejistu'
    ];

    protected $casts = [
        'data_rejistu' => 'datetime'
    ];

    public function transasauns()
    {
        return $this->hasMany(Transasaun::class, 'id_produtor');
    }

    public function totalProdusaun()
    {
        return $this->transasauns()
            ->where('tipo', 'produsaun')
            ->where('status', 'complete')
            ->sum('kilo');
    }
}
