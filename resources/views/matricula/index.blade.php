@extends('template.default')

<?php
/** @var $matriculas \App\Models\Matricula[] */
?>

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Matrículas</h1>
        <a href="{{route('matriculas.create')}}" class="btn btn-primary">Nova</a><br><br>
        @if (empty($matriculas))
            <div class="alert alert-warning">Nenhum curso encontrado</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Curso</th>
                        <th>Aluno</th>
                        <th width="15%">Pagamento pendente</th>
                        <th width="15%">Ativa</th>
                        <th width="10%">Visualizar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matriculas as $matricula)
                        <tr>

                            <td>{{$matricula->ano}}</td>
                            <td>{{$matricula->curso->nome}}</td>
                            <td>{{$matricula->aluno->nome}}</td>
                            <td>
                                @if($matricula->isPagamentoPendente())
                                    <img src="/icons/icon-active.png" title="Ativa" data-toggle="tooltip" class="table-icon">
                                @else
                                    <img src="/icons/icon-inactive.png" title="Inativa" data-toggle="tooltip" class="table-icon">
                                @endif
                            </td>
                            <td>
                                @if($matricula->isAtiva())
                                    <img src="/icons/icon-active.png" title="Ativa" data-toggle="tooltip" class="table-icon">
                                @else
                                    <img src="/icons/icon-inactive.png" title="Inativa" data-toggle="tooltip" class="table-icon">
                                @endif
                            </td>
                            <td>
                                <a href="{{route('matriculas.show',['matricula'=>$matricula->id])}}">
                                <span title="Visualizar" class="glyphicon glyphicon-open"
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection