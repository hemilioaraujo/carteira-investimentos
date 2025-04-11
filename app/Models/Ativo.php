<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    protected $fillable = ['codigo', 'descricao'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
