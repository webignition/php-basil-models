<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;

class AssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $assertionString = '.foo is "foo"';
        $identifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.foo')
        );
        $comparison = AssertionComparisons::IS;
        $value = new Value(ValueTypes::STRING, 'foo');

        $assertion = new Assertion($assertionString, $identifier, $comparison, $value);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($identifier, $assertion->getIdentifier());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($value, $assertion->getValue());
    }
}
