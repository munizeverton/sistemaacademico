<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Periodo.
 *
 * @property int $id
 * @property string $nome
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodo onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Periodo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Periodo whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodo withoutTrashed()
 * @mixin \Eloquent
 */
class Periodo extends Model
{
    protected $table = 'periodos';

    protected $fillable = [
        'id',
        'nome',
    ];

    public $timestamps = false;

    public function __toString()
    {
        return $this->nome;
    }
}
