<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KafeTipu extends Model
{
    use HasFactory;

    protected $table = 'kafe_tipus';

    protected $primaryKey = 'id_tipu';

    protected $fillable = [
        'naran_tipu',
        'deskrisaun',
        'folin_base',
        'kategoria',
        'status',
    ];

    protected $casts = [
        'folin_base' => 'decimal:2',
    ];

    public function transasauns()
    {
        return $this->hasMany(Transasaun::class, 'id_tipu', 'id_tipu');
    }
}
