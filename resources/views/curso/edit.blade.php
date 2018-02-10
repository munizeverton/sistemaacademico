@extends('template.default')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cursos</h1>
        @include('form.form_errors')

        @php
            $curso->valor_mensalidade = !empty($curso->valor_mensalidade) ? number_format($curso->valor_mensalidade, 2, ',', '.') : null;
            $curso->valor_matricula = !empty($curso->valor_matricula) ? number_format($curso->valor_matricula, 2, ',', '.') : null;
        @endphp

        {{ Form::model($curso, ['route' => ['cursos.update',$curso->id], 'method' => 'PUT']) }}
        @include('curso.form')
        <button type="submit" class="btn btn-primary">Alterar</button>
        {{ Form::close() }}
    </div>
@endsection

@section('specific-scripts')
    <script src="/js/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {
            $('.money').mask("#.##0,00", {reverse: true});
        });
    </script>
@endsection