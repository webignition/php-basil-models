<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertableExaminationAssertion;
use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Value\Assertion\AssertableExaminedValue;
use webignition\BasilModel\Value\Assertion\AssertableExaminedValueInterface;
use webignition\BasilModel\Value\DomIdentifierValue;

class AssertableExaminationAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        AssertableExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        $assertion = new AssertableExaminationAssertion($assertionString, $examinedValue, $comparison);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new AssertableExaminedValue(
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
}
