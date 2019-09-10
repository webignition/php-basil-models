<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Assertion\IsNotAssertion;

class IsNotAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" is-not "foo"';
        $this->assertion = new IsNotAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }

    public function testCreate()
    {
        parent::testCreate();

        $this->assertSame(AssertionComparisons::IS_NOT, $this->assertion->getComparison());
    }
}
