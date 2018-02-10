<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Service\CursoService;

class CursoController extends Controller
{
    /**
     * @var CursoService
     */
    private $cursoService;

    /**
     * CursoController constructor.
     * @param CursoService $cursoService
     */
    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    /**
     * Action que monta a lista de cursos
     */
    public function index()
    {
        $cursos = $this->cursoService->list(false);

        return view('curso.index', [
            'cursos' => $cursos,
        ]);
    }

    /**
     * Monta o formulário de criação de curso
     */
    public function create()
    {
        return view('curso.create', ['curso' => new Curso()]);
    }

    /**
     * Recebe o POST do formulário e cria o curso
     * @param CursoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CursoRequest $request)
    {
        $this->cursoService->store($request->all());

        return redirect(route('cursos.index'))->with('flash-message', 'Curso cadastrado com sucesso');
    }

    /**
     * Monta o formulário de update de curso
     * @param integer $cursoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit($cursoId)
    {
        $curso = $this->cursoService->show($cursoId);

        return view('curso.edit', ['curso' => $curso]);
    }

    /**
     * Recebe o PUT e atualiza o curso
     * @param CursoRequest $request
     * @param $cursoId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CursoRequest $request, $cursoId)
    {
        $this->cursoService->update($cursoId, $request->all());

        return redirect(route('cursos.index'))->with('flash-message', 'Curso alterado com sucesso');
    }

    public function show($cursoId)
    {
        try {
            $curso = $this->cursoService->show($cursoId);
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('cursos.index'))->with('flash-message', $e->getMessage());
        }

        return view('curso.show', ['curso' => $curso]);
    }

    public function destroy($cursoId)
    {
        try {
            $this->cursoService->delete($cursoId);
        } catch (\Exception $e) {
            \Session::flash('alert-type', 'danger');
            return redirect(route('cursos.index'))->with('flash-message', $e->getMessage());
        }

        return redirect(route('cursos.index'))->with('flash-message', 'Curso excluído com sucesso');
    }
}
