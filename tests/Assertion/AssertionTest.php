<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ValueTypes;

class AssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $assertionString = '.selector is "foo"';
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));

        $examinedValue = new ElementValue($identifier);

        $comparison = AssertionComparisons::IS;
        $expectedValue = LiteralValue::createStringValue('foo');

        $assertion = new Assertion($assertionString, $examinedValue, $comparison, $expectedValue);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
        $this->assertSame($expectedValue, $assertion->getExpectedValue());
    }

    public function testWithExaminedValue()
    {
        $assertionString = 'page_import_name.elements.element_name exists';
        $comparison = AssertionComparisons::EXISTS;

        $originalExaminedValue = new ObjectValue(
            ValueTypes::PAGE_ELEMENT_REFERENCE,
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $assertion = new Assertion(
            $assertionString,
            $originalExaminedValue,
            $comparison
        );

        $elementValue = new ElementValue(
            new ElementIdentifier(
                LiteralValue::createCssSelectorValue('.selector')
            )
        );

        $mutatedAssertion = $assertion->withExaminedValue($elementValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertEquals($assertionString, $assertion->getAssertionString());
        $this->assertEquals($assertionString, $mutatedAssertion->getAssertionString());
        $this->assertEquals($comparison, $assertion->getComparison());
        $this->assertEquals($comparison, $mutatedAssertion->getComparison());
        $this->assertSame($originalExaminedValue, $assertion->getExaminedValue());
        $this->assertSame($elementValue, $mutatedAssertion->getExaminedValue());
    }

    public function testWithExpectedValue()
    {
        $assertionString = '".selector" is page_import_name.elements.element_name';
        $comparison = AssertionComparisons::EXISTS;

        $originalExpectedValue = new ObjectValue(
            ValueTypes::PAGE_ELEMENT_REFERENCE,
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $examinedValue = LiteralValue::createCssSelectorValue('.selector');

        $assertion = new Assertion(
            $assertionString,
            $examinedValue,
            $comparison,
            $originalExpectedValue
        );

        $newExpectedValue = new ElementValue(
            new ElementIdentifier(
                LiteralValue::createCssSelectorValue('.selector')
            )
        );

        $mutatedAssertion = $assertion->withExpectedValue($newExpectedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertEquals($assertionString, $assertion->getAssertionString());
        $this->assertEquals($assertionString, $mutatedAssertion->getAssertionString());
        $this->assertEquals($comparison, $assertion->getComparison());
        $this->assertEquals($comparison, $mutatedAssertion->getComparison());
        $this->assertSame($originalExpectedValue, $assertion->getExpectedValue());
        $this->assertSame($newExpectedValue, $mutatedAssertion->getExpectedValue());
    }
}
