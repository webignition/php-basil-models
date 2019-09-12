<?php

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\IncludesAssertion;

class IncludesAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" includes "foo"';
        $this->assertion = new IncludesAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }
}
