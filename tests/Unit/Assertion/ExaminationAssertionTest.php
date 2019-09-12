<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\Value\AssertionExaminedValue;
use webignition\BasilModel\Value\AssertionExaminedValueInterface;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Identifier\ElementIdentifier;

class ExaminationAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        AssertionExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        $assertion = new ExaminationAssertion($assertionString, $examinedValue, $comparison);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new AssertionExaminedValue(
            new ElementValue(
                new ElementIdentifier(
                    new CssSelector('.examined')
                )
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
