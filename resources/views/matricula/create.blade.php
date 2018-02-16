@extends('template.default')

@section('specific-styles')
    <link href="/js/chosen_v1.0.0/chosen.css" rel="stylesheet">
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
        @endphp

        @component('form.form_group',['field' => 'aluno_id'])
            {{ \Form::label('aluno_id', 'Aluno *',['class' => 'control-label']) }}
            {{Form::select('aluno_id', $arrayAlunos, null, ['class' => 'form-control choosen-ajax'])}}
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
    <script src="/js/chosen_v1.0.0/chosen.jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function () {
            $('.choosen').chosen();

            $('.choosen-ajax').select2({
                ajax: {
                    url: '/alunos/find/autocomplete',
                    dataType: 'json'
                },
                minimumInputLength: 2
            });
        })
    </script>
@endsection