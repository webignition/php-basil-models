<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertableComparisonAssertion;
use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Value\Assertion\AssertableExaminedValue;
use webignition\BasilModel\Value\Assertion\AssertableExaminedValueInterface;
use webignition\BasilModel\Value\Assertion\AssertableExpectedValue;
use webignition\BasilModel\Value\Assertion\AssertableExpectedValueInterface;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Identifier\ElementIdentifier;

class AssertableComparisonAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        AssertableExaminedValueInterface $examinedValue,
        string $comparison,
        AssertableExpectedValueInterface $expectedValue
    ) {
        $assertion = new AssertableComparisonAssertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new AssertableExaminedValue(
            new ElementValue(
                new ElementIdentifier(
                    new ElementExpression('.examined', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $expectedValue = new AssertableExpectedValue(
            new ElementValue(
                new ElementIdentifier(
                    new ElementExpression('.expected', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        return [
            'is comparison' => [
                'assertionString' => '".examined" is ".expected"',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::IS,
                'expectedValue' => $expectedValue,
            ],
            'is-not comparison' => [
                'assertionString' => '".examined" is-not ".expected"',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::IS_NOT,
                'expectedValue' => $expectedValue,
            ],
            'includes comparison' => [
                'assertionString' => '".examined" includes ".expected"',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::INCLUDES,
                'expectedValue' => $expectedValue,
            ],
            'excludes comparison' => [
                'assertionString' => '".examined" excludes ".expected"',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::EXCLUDES,
                'expectedValue' => $expectedValue,
            ],
            'matches comparison' => [
                'assertionString' => '".examined" matches ".expected"',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::MATCHES,
                'expectedValue' => $expectedValue,
            ],
        ];
    }
}
