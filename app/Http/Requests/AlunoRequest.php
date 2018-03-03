<?php

namespace App\Http\Requests;

use App\Models\Aluno;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sanitize();

        $aluno = $this->route('aluno');
        $alunoId = ! empty($aluno) ? $aluno : '';

        $rules = [
            'nome' => 'required|max:255',
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('alunos')->ignore($alunoId, 'id'),
            ],
            'data_nascimento' => 'date_format:d/m/Y',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nome.required' => 'O campo Nome é obrigatório',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.unique' => 'O CPF informado já está cadastrado',
            'cpf.cpf' => 'O CPF deve ser valido',
            'data_nascimento.date' => 'O campo Data de nascimento precisa ser uma data válida',
        ];

        return $messages;
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['rg'] = isset($input['rg']) ? filter_var($input['rg'], FILTER_SANITIZE_STRING) : null;
        $input['nome'] = isset($input['nome']) ? filter_var($input['nome'], FILTER_SANITIZE_STRING) : null;

        $this->replace($input);
    }
}
