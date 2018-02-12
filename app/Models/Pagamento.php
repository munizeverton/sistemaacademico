<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Pagamento
 *
 * @property int $id
 * @property string $data
 * @property float $valor
 * @property string $data_pagamento
 * @property float $valor_pago
 * @property int $matricula_id
 * @property int $tipo_pagamento_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereDataPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereMatriculaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereTipoPagamentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pagamento whereValorPago($value)
 * @mixin \Eloquent
 * @property-read mixed $data_formatted
 * @property-read mixed $data_pagamento_formatted
 * @property-read mixed $valor_formatted
 * @property-read \App\Models\Matricula $matricula
 * @property-read \App\Models\TipoPagamento $tipo
 */
class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $fillable = [
        'id',
        'data',
        'valor',
        'data_pagamento',
        'valor_pago',
        'matricula_id',
        'tipo_pagamento_id',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoPagamento::class, 'tipo_pagamento_id', 'id');
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function getValorFormattedAttribute()
    {
        $value = $this->valor;
        if ($value === null) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function getDataFormattedAttribute()
    {
        $value = $this->data;
        if (empty($value)){
            return null;
        }

        return (new \DateTime($value))->format('d/m/Y');
    }

    public function getDataPagamentoFormattedAttribute()
    {
        $value = $this->data_pagamento;
        if (empty($value)){
            return null;
        }

        return (new \DateTime($value))->format('d/m/Y');
    }
}
