<?php

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\MatchesAssertion;

class MatchesAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" matches "foo"';
        $this->assertion = new MatchesAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }

    public function testCreate()
    {
        parent::testCreate();

        $this->assertEquals(AssertionComparison::MATCHES, $this->assertion->getComparison());
    }
}
