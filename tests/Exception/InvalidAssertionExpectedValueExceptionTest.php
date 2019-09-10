<?php

namespace webignition\BasilModel\Tests\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\CssSelector;

class InvalidAssertionExpectedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new CssSelector('.selector');

        $exception = new InvalidAssertionExpectedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
