<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
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

        $this->assertEquals(AssertionComparison::NOT_EXISTS, $this->assertion->getComparison());
    }
}
