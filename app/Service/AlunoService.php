<?php
/**
 * Created by PhpStorm.
 * User: evertonmuniz
 * Date: 07/02/18
 * Time: 22:44
 */

namespace App\Service;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Collection;

class AlunoService
{
    /**
     * Insere um aluno no banco
     *
     * @param array $data
     * @return Aluno
     * @throws \Exception
     */
    public function store(array $data): Aluno
    {
        $aluno = new Aluno();

        try {
            $aluno->cpf = $data['cpf'];
            $aluno->nome = $data['nome'];
            $aluno->rg = $data['rg'];
            $aluno->data_nascimento = $data['data_nascimento'];
            $aluno->telefone = $data['telefone'];

            $aluno->save();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao gravar o aluno');
        }

        return $aluno;
    }

    /**
     * Recupera um aluno no banco
     *
     * @param int $id
     * @return Aluno
     * @throws \Exception
     */
    public function show(int $id)
    {
        try {
            return Aluno::find($id);
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao buscar o aluno');
        }
    }

    /**
     * Retorna um array de alunos
     *
     * @param bool $paginate
     * @param int $pageSize
     * @return Collection
     * @throws \Exception
     */
    public function list($paginate = true, $pageSize = 10)
    {
        try {
            $aluno = Aluno::query();
            if ($paginate) {
                return $aluno->paginate($pageSize);
            }
            return $aluno->get();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao listar os alunos');
        }
    }

    /**
     * Atualiza um aluno no banco
     *
     * @param int $id
     * @param $data
     * @return Aluno
     * @throws \Exception
     */
    public function update(int $id, $data)
    {
        $aluno = Aluno::find($id);

        if (empty($aluno)) {
            throw new \Exception('Aluno não encotrado');
        }

        try {
            $aluno->cpf = $data['cpf'];
            $aluno->nome = $data['nome'];
            $aluno->rg = $data['rg'];
            $aluno->data_nascimento = $data['data_nascimento'];
            $aluno->telefone = $data['telefone'];

            $aluno->save();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao atualizar o aluno');
        }

        return $aluno;
    }

    /**
     * Deleta um aluno do banco com softdelete
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        try {
            return Aluno::find($id)->delete();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao deletar os alunos');
        }
    }
}