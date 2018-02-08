@extends('template.default')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Alunos</h1>
        <a href="/users/create" class="btn btn-primary">Novo</a>
        @if (empty($alunos))
            <div class="alert alert-warning">Nenhum aluno encontrado</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Data de nascimento</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td><a href="/alunos/{{$aluno->id}}">{{$aluno->nome}}</a></td>
                            <td>{{$aluno->cpf}}</td>
                            <td>{{$aluno->rg}}</td>
                            <td>{{(new \DateTime($aluno->data_nascimento))->format( 'd/m/Y')}}</td>
                            <td>{{$aluno->telefone}}</td>
                            <td>
                                <a href="/alunos/{{$aluno->id}}">
                                    <span title="Visualizar" class="glyphicon glyphicon-search"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                                &nbsp;
                                <a href="/alunos/{{$aluno->id}}">
                                    <span title="Editar" class="glyphicon glyphicon-pencil"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                                &nbsp;
                                <a href="/alunos/{{$aluno->id}}">
                                    <span title="Excluir" class="glyphicon glyphicon-trash"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $alunos->links() }}
        @endif
    </div>
@endsection

@section('specific-scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection