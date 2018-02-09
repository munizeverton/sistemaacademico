@extends('template.default')

@section('specific-styles')
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Alunos</h1>
        <a href="{{route('alunos.create')}}" class="btn btn-primary">Novo</a><br><br>
        @if (empty($alunos))
            <div class="alert alert-warning">Nenhum aluno encontrado</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped datatable">
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
                            <td><a href="{{route('alunos.show',['aluno'=>$aluno->id])}}">{{$aluno->nome}}</a></td>
                            <td>{{$aluno->cpf}}</td>
                            <td>{{$aluno->rg}}</td>
                            <td>{{$aluno->data_nascimento}}</td>
                            <td>{{$aluno->telefone}}</td>
                            <td>
                                <a href="{{route('alunos.show',['aluno'=>$aluno->id])}}">
                                    <span title="Visualizar" class="glyphicon glyphicon-search"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                                &nbsp;
                                <a href="{{route('alunos.edit',['aluno'=>$aluno->id])}}">
                                    <span title="Editar" class="glyphicon glyphicon-pencil"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('specific-scripts')
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('.datatable').DataTable({
                "language": {
                    "url": "js/Portuguese-Brasil.json"
                }
            });
            $('[data-toggle="tooltip"]').tooltip()

        })
    </script>
@endsection