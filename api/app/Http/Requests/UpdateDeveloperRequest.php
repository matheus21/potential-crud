<?php

namespace App\Http\Requests;

class UpdateDeveloperRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'            => 'nullable',
            'hobby'           => 'nullable',
            'sexo'            => 'in:M,F',
            'idade'           => 'int',
            'datanascimento'  => 'date_format:"Y-m-d"',
            'id'              => 'exists:developers,id'
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all();
        $data['id'] = $this->route('id');

        return $data;
    }

    public function messages()
    {
        return [
            'sexo.in'                    => trans('validation.in', ['attribute' => 'sexo', 'value' => 'M ou F']),
            'idade.integer'              => trans('validation.integer', ['attribute' => 'idade']),
            'datanascimento.date_format' => trans('validation.date_format'),
            'id.exists'                  => trans('validation.exists')
        ];
    }
}
