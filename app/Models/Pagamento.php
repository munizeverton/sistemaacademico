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
}
