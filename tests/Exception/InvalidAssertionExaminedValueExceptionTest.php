<?php

namespace webignition\BasilModel\Tests\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\CssSelector;

class InvalidAssertionExaminedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new CssSelector('.selector');

        $exception = new InvalidAssertionExaminedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
