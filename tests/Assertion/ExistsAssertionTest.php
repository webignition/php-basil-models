<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Assertion;

use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Assertion\ExistsAssertion;

class ExistsAssertionTest extends AbstractAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" exists';
        $this->assertion = new ExistsAssertion($this->assertionString, $this->examinedValue);
    }

    public function testCreate()
    {
        parent::testCreate();

        $this->assertSame(AssertionComparisons::EXISTS, $this->assertion->getComparison());
    }
}
