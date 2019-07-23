<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Value\AbstractValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueTypes;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;

class AssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $assertionString = '.selector is "foo"';
        $identifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new LiteralValue('.selector')
        );
        $comparison = AssertionComparisons::IS;
        $value = new LiteralValue('foo');

        $assertion = new Assertion($assertionString, $identifier, $comparison, $value);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($identifier, $assertion->getIdentifier());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($value, $assertion->getValue());
    }
}
