<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Value\Assertion\ExaminedValue;
use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;
use webignition\BasilModel\Value\DomIdentifierValue;

class ExaminationAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        $assertion = new ExaminationAssertion($assertionString, $examinedValue, $comparison);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier('.examined')
            )
        );

        return [
            'exists comparison' => [
                'assertionString' => '".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::EXISTS,
            ],
            'not-exists comparison' => [
                'assertionString' => '".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::NOT_EXISTS,
            ],
        ];
    }

    public function testWithExaminedValue()
    {
        $originalExaminedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier('.original')
            )
        );

        $newExaminedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier('.new')
            )
        );

        $assertion = new ExaminationAssertion(
            '".selector" exists',
            $originalExaminedValue,
            AssertionComparison::IS
        );

        $mutatedAssertion = $assertion->withExaminedValue($newExaminedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertSame($newExaminedValue, $mutatedAssertion->getExaminedValue());
    }
}
