<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOrdem extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'tipos_ordens';

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
