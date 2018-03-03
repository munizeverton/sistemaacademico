<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Curso.
 *
 * @property int $id
 * @property string $nome
 * @property float $valor_mensalidade
 * @property float $valor_matricula
 * @property int $periodo_id
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso wherePeriodoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereValorMatricula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereValorMensalidade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso withoutTrashed()
 * @mixin \Eloquent
 * @property int $duracao Duração do curso em meses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Curso whereDuracao($value)
 * @property-read mixed $valor_matricula_formatted
 * @property-read mixed $valor_mensalidade_formatted
 * @property-read \App\Models\Periodo $periodo
 */
class Curso extends Model
{
    use SoftDeletes;

    protected $table = 'cursos';

    protected $fillable = [
        'id',
        'nome',
        'valor_matricula',
        'valor_mensalidade',
        'duracao',
        'periodo_id',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function getValorMatriculaFormattedAttribute()
    {
        $value = $this->valor_matricula;
        if ($value === null) {
            return;
        }

        return number_format($value, 2, ',', '.');
    }

    public function getValorMensalidadeFormattedAttribute()
    {
        $value = $this->valor_mensalidade;
        if ($value === null) {
            return;
        }

        return number_format($value, 2, ',', '.');
    }
}
