<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierTypes;

class AssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $assertionString = '.selector is "foo"';
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.selector'
        );

        $examinedValue = new ElementValue($identifier);

        $comparison = AssertionComparisons::IS;
        $expectedValue = LiteralValue::createStringValue('foo');

        $assertion = new Assertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }
}
