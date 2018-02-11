@component('form.form_group',['field' => 'nome'])
    {{ \Form::label('nome','Nome *',['class' => 'control-label']) }}
    {{ \Form::text('nome',null,['class' => 'form-control']) }}
@endcomponent

@component('form.form_group',['field' => 'valor_mensalidade'])
    {{ \Form::label('valor_mensalidade', 'Valor da mensalidade *',['class' => 'control-label']) }}
    {{ \Form::text('valor_mensalidade', null,['class' => 'form-control money'])}}
@endcomponent

@component('form.form_group',['field' => 'valor_matricula'])
    {{ \Form::label('valor_matricula', 'Valor da matrícula *',['class' => 'control-label']) }}
    {{ \Form::text('valor_matricula', null,['class' => 'form-control money'])}}
@endcomponent

@php
    $arrayPeriodos[''] = 'Selecione o período';
    foreach (\App\Models\Periodo::all() as $periodo) {
        $arrayPeriodos[$periodo->id] = $periodo->nome;
    }
@endphp

@component('form.form_group',['field' => 'periodo_id'])
    {{ \Form::label('periodo_id', 'Período *',['class' => 'control-label']) }}
    {{Form::select('periodo_id', $arrayPeriodos, null, ['class' => 'form-control'])}}
@endcomponent

@component('form.form_group',['field' => 'duracao'])
    {{ \Form::label('duracao', 'Meses de duração *',['class' => 'control-label']) }}
    {{ \Form::number('duracao', null,['class' => 'form-control money'])}}
@endcomponent

