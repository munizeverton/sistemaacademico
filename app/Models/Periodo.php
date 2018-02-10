<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Periodo
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
    use SoftDeletes;

    protected $table = 'periodos';

    protected $fillable = [
        'id',
        'nome',
    ];

    public $timestamps = false;
}
