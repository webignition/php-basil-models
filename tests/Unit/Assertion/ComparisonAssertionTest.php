<?php

declare(strict_types=1);

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ComparisonAssertion;
use webignition\BasilModel\Value\DomIdentifierValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class ComparisonAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        ValueInterface $examinedValue,
        string $comparison,
        ValueInterface $expectedValue
    ) {
        $assertion = new ComparisonAssertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getSource());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }

    public function createDataProvider(): array
    {
        $examinedValue = DomIdentifierValue::create('.examined');
        $expectedValue = DomIdentifierValue::create('.expected');

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
        $originalExaminedValue = DomIdentifierValue::create('.original');
        $newExaminedValue = DomIdentifierValue::create('.new');
        $expectedValue = new LiteralValue('value');

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
        $examinedValue = DomIdentifierValue::create('.selector');
        $originalExpectedValue = new LiteralValue('value');
        $newExpectedValue = new LiteralValue('value');

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
