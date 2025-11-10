<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transasaun extends Model
{
    use HasFactory;

    protected $table = 'transasauns';
    protected $primaryKey = 'id_transasaun';
    public $timestamps = true;

    protected $fillable = [
        'id_produtor',
        'id_tipu',
        'id_armajen',
        'data_transasaun',
        'tipo',
        'kilo',
        'folin_unitariu',
        'status'
    ];

    protected $casts = [
        'data_transasaun' => 'date',
        'data_registu' => 'datetime',
        'kilo' => 'decimal:2',
        'folin_unitariu' => 'decimal:2'
    ];

    public function produtor()
    {
        return $this->belongsTo(Produtor::class, 'id_produtor');
    }

    public function kafeTipu()
    {
        return $this->belongsTo(KafeTipu::class, 'id_tipu');
    }

    public function armajen()
    {
        return $this->belongsTo(Armajen::class, 'id_armajen');
    }
}
