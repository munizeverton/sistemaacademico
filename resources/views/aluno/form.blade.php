
@component('form.form_group',['field' => 'nome'])
    {{ \Form::label('nome','Nome *',['class' => 'control-label']) }}
    {{ \Form::text('nome',null,['class' => 'form-control']) }}
@endcomponent

@component('form.form_group',['field' => 'cpf'])
    {{ \Form::label('cpf', 'CPF *',['class' => 'control-label']) }}
    {{ \Form::text('cpf', null,['class' => 'form-control'])}}
@endcomponent

@component('form.form_group',['field' => 'rg'])
    {{ \Form::label('rg', 'RG',['class' => 'control-label']) }}
    {{ \Form::text('rg', null,['class' => 'form-control'])}}
@endcomponent

@component('form.form_group',['field' => 'data_nascimento'])
    {{ \Form::label('data_nascimento', 'Data de nascimento *',['class' => 'control-label date']) }}
    {{ \Form::text('data_nascimento', null,['class' => 'form-control'])}}
@endcomponent

@component('form.form_group',['field' => 'telefone'])
    {{ \Form::label('telefone', 'Telefone',['class' => 'control-label telefone']) }}
    {{ \Form::text('telefone', null,['class' => 'form-control'])}}
@endcomponent