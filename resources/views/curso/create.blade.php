@extends('template.default')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cursos</h1>
        @include('form.form_errors')
        {{ Form::open(['route' => 'cursos.store']) }}
        @include('curso.form')
        <button type="submit" class="btn btn-primary">Criar</button>
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