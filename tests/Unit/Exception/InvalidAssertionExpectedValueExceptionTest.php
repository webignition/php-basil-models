<?php

namespace webignition\BasilModel\Tests\Unit\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class InvalidAssertionExpectedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR);

        $exception = new InvalidAssertionExpectedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
