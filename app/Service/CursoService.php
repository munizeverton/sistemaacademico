<?php
/**
 * Created by PhpStorm.
 * User: evertonmuniz
 * Date: 07/02/18
 * Time: 22:44
 */

namespace App\Service;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

class CursoService
{
    /**
     * Insere um curso no banco
     *
     * @param array $data
     * @return Curso
     * @throws \Exception
     */
    public function store(array $data): Curso
    {
        $curso = new Curso();

        try {
            $curso->nome = $data['nome'];
            $curso->valor_matricula = $data['valor_matricula'];
            $curso->valor_mensalidade = $data['valor_mensalidade'];
            $curso->duracao = $data['duracao'];
            $curso->periodo_id = $data['periodo_id'];

            $curso->save();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao gravar o curso' . $e->getMessage());
        }

        return $curso;
    }

    /**
     * Recupera um curso no banco
     *
     * @param int $id
     * @return Curso
     * @throws \Exception
     */
    public function show(int $id)
    {
        try {
            $curso = Curso::find($id);
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao buscar o curso');
        }

        if (empty($curso)) {
            throw new \Exception('Curso não encontrado');
        }

        return $curso;
    }

    /**
     * Retorna um array de cursos
     *
     * @param bool $paginate
     * @param int $pageSize
     * @return Collection
     * @throws \Exception
     */
    public function list($paginate = true, $pageSize = 10)
    {
        try {
            $curso = Curso::query();

            if ($paginate) {
                return $curso->paginate($pageSize);
            }
            return $curso->get();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao listar os cursos');
        }
    }

    /**
     * Atualiza um curso no banco
     *
     * @param int $id
     * @param $data
     * @return Curso
     * @throws \Exception
     */
    public function update(int $id, $data)
    {
        $curso = Curso::find($id);

        if (empty($curso)) {
            throw new \Exception('Curso não encontrado');
        }

        try {
            $curso->nome = $data['nome'];
            $curso->valor_matricula = $data['valor_matricula'];
            $curso->valor_mensalidade = $data['valor_mensalidade'];
            $curso->duracao = $data['duracao'];
            $curso->periodo_id = $data['periodo_id'];

            $curso->save();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao atualizar o curso');
        }

        return $curso;
    }

    /**
     * Deleta um curso do banco com softdelete
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $curso = Curso::find($id);

        if (empty($curso)) {
            throw new \Exception('Curso não encontrado');
        }

        try {
            return $curso->delete();
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro ao deletar os cursos');
        }
    }
}