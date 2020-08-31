<?php

namespace App\Http\Requests;

class InsertDeveloperRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'            => 'required',
            'sexo'            => 'required|in:M,F',
            'idade'           => 'int|required',
            'hobby'           => 'required',
            'datanascimento'  => 'required|date_format:"d/m/Y"'
        ];
    }

    public function messages()
    {
        return [
            'nome.required'              => trans('validation.required', ['attribute' => 'nome']),
            'sexo.required'              => trans('validation.required', ['attribute' => 'sexo']),
            'idade.required'             => trans('validation.required', ['attribute' => 'idade']),
            'hobby.required'             => trans('validation.required', ['attribute' => 'hobby']),
            'datanascimento.required'    => trans('validation.required', ['attribute' => 'datanascimento']),
            'sexo.in'                    => trans('validation.in', ['attribute' => 'sexo', 'value' => 'M ou F']),
            'idade.integer'              => trans('validation.integer', ['attribute' => 'idade']),
            'datanascimento.date_format' => trans('validation.date_format')
        ];
    }
}
