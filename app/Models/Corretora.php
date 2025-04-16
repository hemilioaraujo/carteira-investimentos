<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corretora extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cnpj'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
