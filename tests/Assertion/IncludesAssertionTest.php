<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Assertion\IncludesAssertion;

class IncludesAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" includes "foo"';
        $this->assertion = new IncludesAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }

    public function testCreate()
    {
        parent::testCreate();

        $this->assertSame(AssertionComparisons::INCLUDES, $this->assertion->getComparison());
    }
}
