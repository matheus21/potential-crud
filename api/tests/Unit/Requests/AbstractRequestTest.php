<?php

namespace Tests\Unit\Requests;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Tests\TestCase;

abstract class AbstractRequestTest extends TestCase
{
    use ArraySubsetAsserts;

    /**
     * @var array
     */
    protected $actualRules = [];

    /**
     * @var array
     */
    protected $actualMessages = [];

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    /**
     * @test
     */
    public function shouldHaveTheSameNumberOfRules()
    {
        $countRulesExpectedStructure = count($this->rules());
        $countRulesActualStructure = count($this->actualRules);

        $this->assertEquals($countRulesExpectedStructure, $countRulesActualStructure);
    }

    /**
     * @test
     * @dataProvider rules
     */
    public function shouldHaveTheDefinedRules($expectedRule)
    {
        $field = key($expectedRule);
        $actualRule = [$field => $this->actualRules[$field]];

        $this->assertArraySubset($expectedRule, $actualRule);
    }

    /**
     * @test
     * @dataProvider messages
     */
    public function shouldHaveTheDefinedMessages($expectedMessage)
    {
        $field = key($expectedMessage);
        $actualMessage = [$field => $this->actualMessages[$field]];

        $this->assertArraySubset($expectedMessage, $actualMessage);
    }
}
