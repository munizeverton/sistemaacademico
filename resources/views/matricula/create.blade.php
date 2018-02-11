@extends('template.default')

@section('specific-styles')
    <link href="/css/chosen.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Nova Matrícula</h1>
        {{ Form::open(['route' => 'matriculas.store']) }}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            $arrayAlunos[''] = 'Selecione o aluno';
            foreach (\App\Models\Aluno::orderBy('nome')->get() as $aluno) {
                $arrayAlunos[$aluno->id] = $aluno->nome;
            }
        @endphp

        @component('form.form_group',['field' => 'aluno_id'])
            {{ \Form::label('aluno_id', 'Aluno *',['class' => 'control-label']) }}
            {{Form::select('aluno_id', $arrayAlunos, null, ['class' => 'form-control choosen'])}}
        @endcomponent

        @php
            $arrayCursos[''] = 'Selecione o curso';
            foreach (\App\Models\Curso::orderBy('nome')->get() as $curso) {
                $arrayCursos[$curso->id] = $curso->nome;
            }
        @endphp

        @component('form.form_group',['field' => 'curso_id'])
            {{ \Form::label('curso_id', 'Curso *',['class' => 'control-label']) }}
            {{Form::select('curso_id', $arrayCursos, null, ['class' => 'form-control choosen'])}}
        @endcomponent

        <button type="submit" class="btn btn-primary">Salvar</button>
        {{ Form::close() }}
    </div>
@endsection

@section('specific-scripts')
    <script src="/js/chosen.jquery.min.js"></script>
    <script>
        $(function () {
            $('.choosen').chosen();
        })
    </script>
@endsection