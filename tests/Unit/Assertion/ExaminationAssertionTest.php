<?php

declare(strict_types=1);

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\Value\DomIdentifierValue;
use webignition\BasilModel\Value\ValueInterface;

class ExaminationAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        ValueInterface $examinedValue,
        string $comparison
    ) {
        $assertion = new ExaminationAssertion($assertionString, $examinedValue, $comparison);

        $this->assertSame($assertionString, $assertion->getSource());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
    }

    public function createDataProvider(): array
    {
        $examinedValue = DomIdentifierValue::create('.examined');

        return [
            'exists comparison' => [
                'assertionString' => '$".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::EXISTS,
            ],
            'not-exists comparison' => [
                'assertionString' => '$".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::NOT_EXISTS,
            ],
        ];
    }

    public function testWithExaminedValue()
    {
        $originalExaminedValue = DomIdentifierValue::create('.original');
        $newExaminedValue = DomIdentifierValue::create('.new');

        $assertion = new ExaminationAssertion(
            '$".selector" exists',
            $originalExaminedValue,
            AssertionComparison::IS
        );

        $mutatedAssertion = $assertion->withExaminedValue($newExaminedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertSame($newExaminedValue, $mutatedAssertion->getExaminedValue());
    }
}
