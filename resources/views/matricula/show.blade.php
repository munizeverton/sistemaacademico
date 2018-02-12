@extends('template.default')

@section('specific-styles')
    <link href="/css/sweetalert.css" rel="stylesheet">
@endsection

<?php
/** @var $matricula \App\Models\Matricula */
?>

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard de Matrícula</h1>
        <div class="row">
            <div class="col-sm-9">
                <a class="btn btn-danger" @if(!$matricula->isAtiva()) disabled @endif href="@if($matricula->isAtiva()){{ route('matriculas.cancelar',['matricula' => $matricula->id]) }}@endif">Cancelar Matrícula</a>
                @if($matricula->isPagamentoPendente())<span class="label label-warning">Pagamento pendente</span>@endif
                @if(!$matricula->isAtiva()) <span class="label label-danger">Inativa</span>@endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h3>Dados do aluno</h3>
                @php
                    $aluno = $matricula->aluno
                @endphp
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row" width="20%">Nome</th>
                        <td>{{$aluno->nome}}</td>
                    </tr>
                    <tr>
                        <th scope="row">CPF</th>
                        <td>{{$aluno->cpf}}</td>
                    </tr>
                    <tr>
                        <th scope="row">RG</th>
                        <td>{{$aluno->rg}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de nascimento</th>
                        <td>{{$aluno->data_nascimento}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone</th>
                        <td>{{$aluno->telefone}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <h3>Dados do curso</h3>
                @php
                    $curso = $matricula->curso
                @endphp
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row" width="20%">Nome</th>
                        <td>{{$curso->nome}}</td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Valor da mensalidade</th>
                        <td>{{$curso->valor_mensalidade_formatted}}</td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Valor da matrícula</th>
                        <td>{{$curso->valor_matricula_formatted}}</td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Período</th>
                        <td>{{$curso->periodo}}</td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Duração</th>
                        <td>{{$curso->duracao}} meses</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Dados de pagamento</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Vencimento</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Data de pagamento</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matricula->pagamentos as $pagamento)

                        <tr>
                            <td>{{$pagamento->data_formatted}}</td>
                            <td>{{$pagamento->tipo->nome}}</td>
                            <td>R$ {{$pagamento->valor_formatted}}</td>
                            <td>
                                @if(!empty($pagamento->data_pagamento_formatted))
                                    {{$pagamento->data_pagamento_formatted}}
                                @else
                                    <a class="btn btn-primary" @if(!$matricula->isAtiva()) disabled @endif href="@if($matricula->isAtiva())/matriculas/pagamento/{{$pagamento->id}}@endif">Pagar</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('specific-scripts')
    <script src="/js/sweetalert.min.js"></script>
@endsection