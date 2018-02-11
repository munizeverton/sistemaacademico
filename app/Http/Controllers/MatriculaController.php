<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Service\MatriculaService;

class MatriculaController extends Controller
{
    /**
     * @var MatriculaService
     */
    private $matriculaService;

    /**
     * MatriculaController constructor.
     * @param MatriculaService $matriculaService
     */
    public function __construct(MatriculaService $matriculaService)
    {
        $this->matriculaService = $matriculaService;
    }

    /**
     * Action que monta a lista de matriculas
     */
    public function index()
    {
        return view('matricula.dashboard');
    }

    public function create()
    {
        return view('matricula.create');
    }

    public function store(MatriculaRequest $request)
    {
        $matricula = $this->matriculaService->store($request->get('aluno_id'), $request->get('curso_id'));

        return redirect(route('matriculas.dashboard'))->with('flash-message', sprintf('O aluno <b>%s</b> foi matriculado no curso <b>%s</b> com sucesso!', $matricula->aluno->nome, $matricula->curso->nome));
    }
}
