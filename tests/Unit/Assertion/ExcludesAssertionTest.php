<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\ExcludesAssertion;

class ExcludesAssertionTest extends AbstractValueComparisonAssertionTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertionString = '".selector" excludes "foo"';
        $this->assertion = new ExcludesAssertion($this->assertionString, $this->examinedValue, $this->expectedValue);
    }
}
