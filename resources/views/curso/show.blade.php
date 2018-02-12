@extends('template.default')

@section('specific-styles')
    <link href="/css/sweetalert.css" rel="stylesheet">
    @endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Ver curso</h1>
        <a class="btn btn-primary" href="{{ route('cursos.edit',['curso' => $curso->id]) }}">Editar</a>
        <a class="btn btn-danger" href="{{ route('cursos.destroy',['curso' => $curso->id]) }}"
           onclick="event.preventDefault();destroyAluno()">Excluir</a>
        {{Form::open(['route' => ['cursos.destroy',$curso->id],'method' => 'DELETE', 'id' => 'form-delete'])}}
        {{Form::close()}}
        <br/><br/>
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
@endsection
@section('specific-scripts')
    <script src="/js/sweetalert.min.js"></script>
    <script>
        function destroyAluno() {
            swal({
                title: "Tem certeza?",
                text: "Tem certeza que deseja excluir esse curso",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, excluir curso",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    swal("Aguarde...");
                    $('#form-delete').submit();
                }
            });
        }
    </script>
@endsection