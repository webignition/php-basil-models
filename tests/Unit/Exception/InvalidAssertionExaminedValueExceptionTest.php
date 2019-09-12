<?php

namespace webignition\BasilModel\Tests\Unit\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class InvalidAssertionExaminedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR);

        $exception = new InvalidAssertionExaminedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
