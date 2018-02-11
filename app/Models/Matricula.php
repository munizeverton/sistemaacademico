<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Matricula
 *
 * @property int $id
 * @property int $curso_id
 * @property int $aluno_id
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Aluno $aluno
 * @property-read \App\Models\Curso $curso
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Matricula onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereAlunoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereCursoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Matricula withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Matricula withoutTrashed()
 * @mixin \Eloquent
 * @property int $ano
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereAno($value)
 * @property string|null $data_cancelamento
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Matricula whereDataCancelamento($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pagamento[] $pagamentos
 */
class Matricula extends Model
{
    use SoftDeletes;

    protected $table = 'matriculas';

    protected $fillable = [
        'id',
        'aluno_id',
        'curso_id',
        'ano',
        'data_cancelamento',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }

    public function isPagamentoPendente()
    {
        $matricula = Pagamento::whereMatriculaId($this->id)
            ->where('tipo_pagamento_id', TipoPagamento::MATRICULA)
            ->where('data_pagamento', null)
            ->first();

        if (!empty($matricula)) {
            return true;
        }

        $pagamentosVencidos = Pagamento::whereMatriculaId($this->id)
            ->where('tipo_pagamento_id', TipoPagamento::MENSALIDADE)
            ->where('data_pagamento', null)
            ->where('data', '>', (new \DateTime()))
            ->get();

        if (!empty($pagamentosVencidos->all())) {
            return true;
        }

        return false;
    }

    public function isAtiva()
    {
        if (!empty($this->data_cancelamento)) {
            return false;
        }

        $inicioCurso = (new \DateTime('first day of January ' . $this->ano));
        $fimCurso = clone $inicioCurso;
        $fimCurso = $fimCurso->modify(sprintf('+%s month', $this->curso->duracao));

        if (time() > $fimCurso->getTimestamp()) {
            return false;
        }

        if (time() < $inicioCurso->getTimestamp()) {
            return false;
        }

        return true;
    }
}
