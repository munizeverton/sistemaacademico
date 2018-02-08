<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
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
        $alunos = $this->alunoService->list();

        return view('aluno.index', [
            'alunos' => $alunos,
        ]);
    }

    /**
     * Action que monta o formulário de criação de aluno
     */
    public function create()
    {

    }

    /**
     * Action que recebe o POST do formulário e cria o aluno
     * @param AlunoRequest $request
     */
    public function store(AlunoRequest $request)
    {

    }
}
