<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\LiteralValue;

class AssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $assertionString = '.selector is "foo"';
        $identifier = new ElementIdentifier(new CssSelector('.selector'));

        $examinedValue = new ElementValue($identifier);

        $comparison = AssertionComparisons::IS;
        $expectedValue = new LiteralValue('foo');

        $assertion = new Assertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }

    public function testWithExaminedValue()
    {
        $assertionString = '"value" exists';
        $comparison = AssertionComparisons::EXISTS;

        $originalValue = new LiteralValue('value');
        $newValue = new LiteralValue('new value');

        $assertion = new Assertion(
            '"value" exists',
            $originalValue,
            AssertionComparisons::EXISTS
        );

        $newAssertion = $assertion->withExaminedValue($newValue);

        $this->assertNotSame($assertion, $newAssertion);
        $this->assertEquals($assertionString, $assertion->getAssertionString());
        $this->assertEquals($assertionString, $newAssertion->getAssertionString());
        $this->assertEquals($comparison, $assertion->getComparison());
        $this->assertEquals($comparison, $newAssertion->getComparison());
        $this->assertSame($originalValue, $assertion->getExaminedValue());
        $this->assertSame($newValue, $newAssertion->getExaminedValue());
    }

    public function testWithExpectedValue()
    {
        $assertionString = '"examined-value" is "expected-value"';
        $comparison = AssertionComparisons::IS;

        $originalValue = new LiteralValue('expected-value');
        $newValue = new LiteralValue('new expected-value');

        $assertion = new Assertion(
            $assertionString,
            new LiteralValue('examined-value'),
            $comparison,
            $originalValue
        );

        $newAssertion = $assertion->withExpectedValue($newValue);

        $this->assertNotSame($assertion, $newAssertion);
        $this->assertEquals($assertionString, $assertion->getAssertionString());
        $this->assertEquals($assertionString, $newAssertion->getAssertionString());
        $this->assertEquals($comparison, $assertion->getComparison());
        $this->assertEquals($comparison, $newAssertion->getComparison());
        $this->assertSame($originalValue, $assertion->getExpectedValue());
        $this->assertSame($newValue, $newAssertion->getExpectedValue());
    }
}
