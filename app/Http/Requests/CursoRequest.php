<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
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

        $rules = [
            'nome' => 'required|max:255',
            'valor_mensalidade' => 'required|min:0',
            'valor_matricula' => 'required|min:0',
            'periodo_id' => 'required',
            'duracao' => 'required|numeric|min:0'
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'nome.required' => 'O campo Nome é obrigatório',
            'valor_mensalidade.required' => 'O campo Valor da Mensalidade é obrigatório',
            'valor_mensalidade.numeric' => 'O campo Valor da Mensalidade precisa ser um número',
            'valor_mensalidade.min' => 'O campo Valor da Mensalidade precisa ser maior que 0',
            'valor_matricula.required' => 'O campo Valor da Matrícula é obrigatório',
            'valor_matricula.numeric' => 'O campo Valor da Matrícula precisa ser um número',
            'valor_matricula.min' => 'O campo Valor da Matrícula precisa ser maior que 0',
            'periodo_id.required' => 'O campo Período é obrigatório',
            'duracao.required' => 'O campo Duração precisa ser um número',
            'duracao.numeric' => 'O campo Meses de Duração precisa ser um número',
            'duracao.min' => 'O campo Meses de Duração precisa ser maior que 0',
        ];

        return $messages;
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['valor_mensalidade'] = isset($input['valor_mensalidade']) ? (float) str_replace(',', '.', str_replace('.', '', $input['valor_mensalidade'])) : null;
        $input['valor_matricula'] = isset($input['valor_matricula']) ? (float) str_replace(',', '.', str_replace('.', '', $input['valor_matricula'])) : null;

        $this->replace($input);
    }
}
