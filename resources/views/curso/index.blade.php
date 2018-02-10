@extends('template.default')

@section('specific-styles')
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cursos</h1>
        <a href="{{route('cursos.create')}}" class="btn btn-primary">Novo</a><br><br>
        @if (empty($cursos))
            <div class="alert alert-warning">Nenhum curso encontrado</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor mensalidade</th>
                        <th>Valor matrícula</th>
                        <th>Periodo</th>
                        <th>Duração</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td><a href="{{route('cursos.show',['curso'=>$curso->id])}}">{{$curso->nome}}</a></td>
                            <td>R$ {{$curso->valor_mensalidade_formatted}}</td>
                            <td>R$ {{$curso->valor_matricula_formatted}}</td>
                            <td>{{$curso->periodo}}</td>
                            <td>{{$curso->duracao}} meses</td>
                            <td>
                                <a href="{{route('cursos.show',['curso'=>$curso->id])}}">
                                    <span title="Visualizar" class="glyphicon glyphicon-search"
                                          aria-hidden="true" data-toggle="tooltip"></span>
                                </a>
                                &nbsp;
                                <a href="{{route('cursos.edit',['curso'=>$curso->id])}}">
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