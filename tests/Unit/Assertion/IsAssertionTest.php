<?php

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\IsAssertion;

class IsAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" is "foo"';
        $this->assertion = new IsAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }
}
