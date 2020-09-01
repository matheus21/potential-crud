<?php


namespace Tests\Unit\Requests;


use App\Http\Requests\UpdateDeveloperRequest;

class UpdateDeveloperRequestTest extends AbstractRequestTest
{
    public function setUp(): void
    {
        parent::setUp();

        $request = new UpdateDeveloperRequest();
        $this->actualRules = $request->rules();
        $this->actualMessages = $request->messages();
    }

    public function rules(): array
    {
        $this->createApplication();

        return [
            [['nome'            => 'nullable']],
            [['hobby'           => 'nullable']],
            [['sexo'            => 'in:M,F']],
            [['idade'           => 'int']],
            [['datanascimento'  => 'date_format:"Y-m-d"']],
            [['id'              => 'exists:developers,id']]
        ];
    }

    public function messages(): array
    {
        $this->createApplication();

        return [
            [['sexo.in'                    => trans('validation.in', ['attribute' => 'sexo', 'value' => 'M ou F'])]],
            [['idade.integer'              => trans('validation.integer', ['attribute' => 'idade'])]],
            [['datanascimento.date_format' => trans('validation.date_format')]],
            [['id.exists'                  => trans('validation.exists')]]
        ];
    }
}
