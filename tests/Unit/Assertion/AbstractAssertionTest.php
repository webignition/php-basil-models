<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionInterface;
use webignition\BasilModel\Assertion\ComparisonAssertionInterface;
use webignition\BasilModel\Value\AssertionExaminedValue;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Identifier\ElementIdentifier;

abstract class AbstractAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    protected $assertionString;

    /**
     * @var AssertionExaminedValue
     */
    protected $examinedValue;

    /**
     * @var AssertionInterface|ComparisonAssertionInterface
     */
    protected $assertion;

    protected function setUp(): void
    {
        parent::setUp();

        $identifier = new ElementIdentifier(new CssSelector('.selector'));

        $this->examinedValue = new AssertionExaminedValue(new ElementValue($identifier));
    }

    public function testCreate()
    {
        $this->assertSame($this->assertionString, $this->assertion->getAssertionString());
        $this->assertSame($this->examinedValue, $this->assertion->getExaminedValue());
    }

    public function testWithExaminedValue()
    {
        $newExaminedValueIdentifier = new ElementIdentifier(new CssSelector('.new'));
        $newExaminedValue = new AssertionExaminedValue(new ElementValue($newExaminedValueIdentifier));

        $newAssertion = $this->assertion->withExaminedValue($newExaminedValue);

        $this->assertNotSame($this->assertion, $newAssertion);
        $this->assertEquals($this->assertionString, $this->assertion->getAssertionString());
        $this->assertEquals($this->assertionString, $newAssertion->getAssertionString());
        $this->assertSame($this->examinedValue, $this->assertion->getExaminedValue());
        $this->assertSame($newExaminedValue, $newAssertion->getExaminedValue());
    }
}
