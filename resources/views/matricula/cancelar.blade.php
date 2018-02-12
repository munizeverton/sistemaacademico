@extends('template.default')

@section('specific-styles')
    <link href="/css/sweetalert.css" rel="stylesheet">
@endsection

<?php
/** @var $matricula \App\Models\Matricula */
?>

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cancelar Matrícula</h1>
        <div class="row">
            <div class="col-sm-9">
                <a class="btn btn-primary" href="/matriculas/{{$matricula->id}}">Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3>Dados da matrícula</h3>
                @php
                    $aluno = $matricula->aluno;
                    $curso = $matricula->curso;
                @endphp
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row" width="20%">Aluno</th>
                        <td>{{$aluno->nome}}</td>
                    </tr>
                    <tr>
                        <th scope="row" width="20%">Curso</th>
                        <td>{{$curso->nome}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Será cobrada uma multa de <span class="label label-info">R$ {{number_format($multaCancelamento, 2, ',', '.')}}</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-danger" href="{{ route('matriculas.destroy',['matricula' => $matricula->id]) }}"
                   onclick="event.preventDefault();destroyAluno()">Cancelar Matrícula</a>
                {{Form::open(['route' => ['matriculas.destroy',$matricula->id],'method' => 'DELETE', 'id' => 'form-delete'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@section('specific-scripts')
    <script src="/js/sweetalert.min.js"></script>
    <script>
        function destroyAluno() {
            swal({
                title: "Tem certeza?",
                text: "Tem certeza que deseja cancelar essa matrícula",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, cancelar matrícula",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("Aguarde...");
                    $('#form-delete').submit();
                }
            });
        }
    </script>
@endsection