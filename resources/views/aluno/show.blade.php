@extends('template.default')

@section('specific-styles')
    <link href="/css/sweetalert.css" rel="stylesheet">
    @endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Ver aluno</h1>
        <a class="btn btn-primary" href="{{ route('alunos.edit',['aluno' => $aluno->id]) }}">Editar</a>
        <a class="btn btn-danger" href="{{ route('alunos.destroy',['aluno' => $aluno->id]) }}"
           onclick="event.preventDefault();destroyAluno()">Excluir</a>
        {{Form::open(['route' => ['alunos.destroy',$aluno->id],'method' => 'DELETE', 'id' => 'form-delete'])}}
        {{Form::close()}}
        <br/><br/>
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
@endsection
@section('specific-scripts')
    <script src="/js/sweetalert.min.js"></script>
    <script>
        function destroyAluno() {
            swal({
                title: "Tem certeza?",
                text: "Tem certeza que deseja excluir esse aluno",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, excluir aluno",
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