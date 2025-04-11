<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model
{
    protected $fillable = ['nome'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
