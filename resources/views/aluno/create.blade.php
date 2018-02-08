@extends('template.default')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Alunos</h1>
        @include('form.form_errors')
        {{ Form::open(['route' => 'alunos.store']) }}
        @include('aluno.form')
        <button type="submit" class="btn btn-primary">Criar</button>
        {{ Form::close() }}
    </div>
@endsection

@section('specific-scripts')
    <script src="/js/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {
            $('#cpf').mask('000.000.000-00', {reverse: true});
            var telefoneBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                options = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(telefoneBehavior.apply({}, arguments), options);
                    }
                };

            $('#telefone').mask(telefoneBehavior, options);
        });
    </script>
@endsection