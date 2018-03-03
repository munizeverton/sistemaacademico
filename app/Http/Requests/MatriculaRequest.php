<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
        $rules = [
            'aluno_id' => 'required',
            'curso_id' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'aluno_id.required' => 'O campo Aluno é obrigatório',
            'curso_id.required' => 'O campo Curso é obrigatório',

        ];

        return $messages;
    }
}
