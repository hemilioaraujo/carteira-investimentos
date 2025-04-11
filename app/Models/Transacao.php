<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'tipo_id',
        'corretora_id',
        'ativo_id',
        'quantidade',
        'preco_unitario',
        'valor_total',
        'observacoes',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function corretora()
    {
        return $this->belongsTo(Corretora::class);
    }

    public function ativo()
    {
        return $this->belongsTo(Ativo::class);
    }
}
