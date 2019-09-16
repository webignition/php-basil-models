<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ComparisonAssertion;
use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Value\Assertion\ExaminedValue;
use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;
use webignition\BasilModel\Value\Assertion\ExpectedValue;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\DomIdentifierValue;
use webignition\BasilModel\Value\LiteralValue;

class ComparisonAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison,
        ExpectedValue $expectedValue
    ) {
        $assertion = new ComparisonAssertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier(
                    new ElementExpression('.examined', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $expectedValue = new ExpectedValue(
            new DomIdentifierValue(
                new DomIdentifier(
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

    public function testWithExaminedValue()
    {
        $originalExaminedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier(
                    new ElementExpression('.original', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $newExaminedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier(
                    new ElementExpression('.new', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $expectedValue = new ExpectedValue(
            new LiteralValue("value")
        );

        $assertion = new ComparisonAssertion(
            '".selector" is "value"',
            $originalExaminedValue,
            AssertionComparison::IS,
            $expectedValue
        );

        $mutatedAssertion = $assertion->withExaminedValue($newExaminedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertSame($newExaminedValue, $mutatedAssertion->getExaminedValue());
    }

    public function testWithExpectedValue()
    {
        $examinedValue = new ExaminedValue(
            new DomIdentifierValue(
                new DomIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $originalExpectedValue = new ExpectedValue(
            new LiteralValue("value")
        );

        $newExpectedValue = new ExpectedValue(
            new LiteralValue("value")
        );

        $assertion = new ComparisonAssertion(
            '".selector" is "value"',
            $examinedValue,
            AssertionComparison::IS,
            $originalExpectedValue
        );

        $mutatedAssertion = $assertion->withExpectedValue($newExpectedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertSame($newExpectedValue, $mutatedAssertion->getExpectedValue());
    }
}
