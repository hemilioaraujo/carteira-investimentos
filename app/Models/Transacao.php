<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'tipo_ordem_id',
        'corretora_id',
        'ativo_id',
        'quantidade',
        'preco_unitario',
        'valor_total',
        'data',
        'observacoes',
    ];

    public function tipoOrdem()
    {
        return $this->belongsTo(TipoOrdem::class);
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
