<?php

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\AssertionComparisons;
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

        $this->assertSame(AssertionComparisons::MATCHES, $this->assertion->getComparison());
    }
}
