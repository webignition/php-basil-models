<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Assertion\NotExistsAssertion;

class NotExistsAssertionTest extends AbstractAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" not-exists';
        $this->assertion = new NotExistsAssertion($this->assertionString, $this->examinedValue);
    }

    public function testCreate()
    {
        parent::testCreate();

        $this->assertSame(AssertionComparisons::NOT_EXISTS, $this->assertion->getComparison());
    }
}
