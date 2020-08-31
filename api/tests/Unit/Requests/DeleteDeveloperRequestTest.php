<?php


namespace Tests\Unit\Requests;


use App\Http\Requests\DeleteDeveloperRequest;

class DeleteDeveloperRequestTest extends AbstractRequestTest
{
    public function setUp(): void
    {
        parent::setUp();

        $request = new DeleteDeveloperRequest();
        $this->actualRules = $request->rules();
        $this->actualMessages = $request->messages();
    }

    public function rules(): array
    {
        $this->createApplication();

        return [
            [['id' => 'exists:developers,id']]
        ];
    }

    public function messages(): array
    {
        $this->createApplication();

        return [
            [['id.exists' => trans('validation.exists')]]
        ];
    }
}
