<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\ValueComparisonAssertionInterface;
use webignition\BasilModel\Value\AssertionExpectedValue;
use webignition\BasilModel\Value\LiteralValue;

abstract class AbstractValueComparisonAssertionTest extends AbstractAssertionTest
{
    /**
     * @var AssertionExpectedValue
     */
    protected $expectedValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedValue = new AssertionExpectedValue(new LiteralValue('foo'));
    }

    public function testCreate()
    {
        $this->assertSame($this->assertionString, $this->assertion->getAssertionString());
        $this->assertSame($this->examinedValue, $this->assertion->getExaminedValue());

        if ($this->assertion instanceof ValueComparisonAssertionInterface) {
            $this->assertSame($this->expectedValue, $this->assertion->getExpectedValue());
        }
    }

    public function testWithExpectedValue()
    {
        $newExpectedValue = new AssertionExpectedValue(new LiteralValue('bar'));

        if ($this->assertion instanceof ValueComparisonAssertionInterface) {
            $newAssertion = $this->assertion->withExpectedValue($newExpectedValue);

            $this->assertNotSame($this->assertion, $newAssertion);
            $this->assertEquals($this->assertionString, $this->assertion->getAssertionString());
            $this->assertEquals($this->assertionString, $newAssertion->getAssertionString());
            $this->assertSame($this->expectedValue, $this->assertion->getExpectedValue());
            $this->assertSame($newExpectedValue, $newAssertion->getExpectedValue());
        }
    }
}
