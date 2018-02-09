<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Service\AlunoService;

class AlunoController extends Controller
{
    /**
     * @var AlunoService
     */
    private $alunoService;

    /**
     * AlunoController constructor.
     * @param AlunoService $alunoService
     */
    public function __construct(AlunoService $alunoService)
    {
        $this->alunoService = $alunoService;
    }

    /**
     * Action que monta a lista de alunos
     */
    public function index()
    {
        $alunos = $this->alunoService->list(false);

        return view('aluno.index', [
            'alunos' => $alunos,
        ]);
    }

    /**
     * Monta o formulário de criação de aluno
     */
    public function create()
    {
        return view('aluno.create', ['aluno' => new Aluno()]);
    }

    /**
     * Recebe o POST do formulário e cria o aluno
     * @param AlunoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AlunoRequest $request)
    {
        try {
            $this->alunoService->store($request->all());
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('alunos.index'))->with('flash-message', $e->getMessage());
        }

        return redirect(route('alunos.index'))->with('flash-message', 'Aluno cadastrado com sucesso');
    }

    /**
     * Monta o formulário de update de aluno
     * @param integer $alunoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($alunoId)
    {
        try {
            $aluno = $this->alunoService->show($alunoId);
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('alunos.index'))->with('flash-message', $e->getMessage());
        }

        return view('aluno.edit', ['aluno' => $aluno]);
    }

    /**
     * Recebe o PUT e atualiza o aluno
     * @param AlunoRequest $request
     * @param $alunoId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AlunoRequest $request, $alunoId)
    {
        try {
            $this->alunoService->update($alunoId, $request->all());
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('alunos.index'))->with('flash-message', $e->getMessage());
        }

        return redirect(route('alunos.index'))->with('flash-message', 'Aluno alterado com sucesso');
    }

    public function show($alunoId)
    {
        try {
            $aluno = $this->alunoService->show($alunoId);
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('alunos.index'))->with('flash-message', $e->getMessage());
        }

        return view('aluno.show', ['aluno' => $aluno]);
    }

    public function destroy($alunoId)
    {
        try {
            $this->alunoService->delete($alunoId);
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('alunos.index'))->with('flash-message', $e->getMessage());
        }

        return redirect(route('alunos.index'))->with('flash-message', 'Aluno excluído com sucesso');
    }
}
