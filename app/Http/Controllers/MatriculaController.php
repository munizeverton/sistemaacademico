<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Models\Matricula;
use App\Models\Pagamento;
use App\Service\CalculoTroco;
use App\Service\MatriculaService;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('matricula.index', [
            'matriculas' => $this->matriculaService->list($request->all()),
        ]);
    }

    /**
     * Monta o formulário de matrículas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('matricula.create');
    }

    /**
     * Grava a matrícula
     * @param MatriculaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(MatriculaRequest $request)
    {
        $matricula = $this->matriculaService->store($request->get('aluno_id'), $request->get('curso_id'));

        return redirect(route('matriculas.dashboard'))->with('flash-message', sprintf('O aluno <b>%s</b> foi matriculado no curso <b>%s</b> com sucesso!', $matricula->aluno->nome, $matricula->curso->nome));
    }

    /**
     * Mostra os detalhes da matrícula
     * @param Matricula $matricula
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Matricula $matricula)
    {
        return view('matricula.show', ['matricula' => $matricula]);
    }

    public function pagamento(Pagamento $pagamento)
    {
        return view('matricula.pagamento', ['pagamento' => $pagamento]);
    }

    public function calculoTroco(Request $request)
    {
        $valorCobrado = Pagamento::find($request->get('pagamento'))->valor;
        $valorPago = str_replace(',', '.', str_replace('.','', $request->get('valor_entregue')));

        if ($valorCobrado == $valorPago) {
            return response()->json(['error' => 'Não será necessário troco'], 400);
        }

        if ($valorCobrado > $valorPago) {
            return response()->json(['error' => 'O valor precisa ser igual ou maior que o valor cobrado'], 400);
        }

        return $this->matriculaService->calculaTroco($valorCobrado, $valorPago);
    }

    public function pagar(Request $request)
    {
        $matricula = $this->matriculaService->storePagamento($request->all());

        return redirect(route('matriculas.show', ['matricula' => $matricula->id]))->with('flash-message', 'Pagamento registrado com sucesso');
    }
}
