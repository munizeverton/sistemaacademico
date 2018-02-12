@extends('template.default')

@section('specific-styles')
    <link href="/css/sweetalert.css" rel="stylesheet">
@endsection

<?php
/** @var $pagamento \App\Models\Pagamento */
/** @var $matricula \App\Models\Matricula */
$matricula = $pagamento->matricula;
?>

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Pagamento de Mensalidade</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-9">
                <a class="btn btn-primary" href="/matriculas/{{$matricula->id}}">Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3>Dados do pagamento</h3>
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
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="20%">Data de vencimento</th>
                        <th width="20%">Tipo de pagamento</th>
                        <th width="20%">Valor</th>
                        <th width="30%">Valor entregue pelo aluno</th>
                        <th width="10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$pagamento->data_formatted}}</td>
                        <td>{{$pagamento->tipo->nome}}</td>
                        <td>{{$pagamento->valor_formatted}}</td>
                        <td>
                            <form class="form-inline" method="post" id="form-pagamento">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <input type="hidden" name="pagamento" value="{{$pagamento->id}}" id="pagamento-id">
                                    <label class="sr-only" for="exampleInputAmount">Valor entregue</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">R$</div>
                                        <input class="form-control money" name="valor_entregue" id="valor_entregue">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="btn-calcular-troco">Calcular Troco</button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" id="btn-pagar">Pagar</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
@section('specific-scripts')
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {
            $('.money').mask("#.##0,00", {reverse: true});
        });

        $('#btn-calcular-troco').on('click', function () {
            $.ajax({
                url: '/matriculas/calculo-troco',
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'pagamento': $('#pagamento-id').val(),
                    'valor_entregue': $('#valor_entregue').val()
                },
                success: function (data) {
                    swal('Troco', data, 'info');
                },
                error: function(err) {
                    swal('Troco', err.responseJSON.error, 'warning');
                }
            });
        });

        $('#btn-pagar').on('click', function () {
            $('#form-pagamento').submit();
        });
    </script>
@endsection