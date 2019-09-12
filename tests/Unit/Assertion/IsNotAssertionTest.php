<?php

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\IsNotAssertion;

class IsNotAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" is-not "foo"';
        $this->assertion = new IsNotAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }
}
