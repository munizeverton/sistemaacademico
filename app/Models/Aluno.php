<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Aluno
 *
 * @property int $id
 * @property string $cpf
 * @property string|null $rg
 * @property string|null $data_nascimento
 * @property string $nome
 * @property string|null $telefone
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aluno onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereDataNascimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Aluno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aluno withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aluno withoutTrashed()
 * @mixin \Eloquent
 */
class Aluno extends Model
{
    use SoftDeletes;

    protected $table = 'alunos';

    protected $fillable = [
        'id',
        'cpf',
        'nome',
    ];

    public function getDataNascimentoAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return (new \DateTime($value))->format('d/m/Y');
    }
}
