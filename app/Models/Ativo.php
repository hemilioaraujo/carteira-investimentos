<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'descricao'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
