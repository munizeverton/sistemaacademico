<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TipoPagamento.
 *
 * @property int $id
 * @property string $nome
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TipoPagamento onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoPagamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoPagamento whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TipoPagamento withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TipoPagamento withoutTrashed()
 * @mixin \Eloquent
 */
class TipoPagamento extends Model
{
    protected $table = 'tipos_pagamento';

    public $timestamps = false;

    protected $fillable = [
        'id',
    ];

    const MATRICULA = 1;
    const MENSALIDADE = 2;
}
