<?php

namespace webignition\BasilModel\Tests\Unit\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\PageElementReference;

class InvalidAssertionExpectedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new PageElementReference(
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $exception = new InvalidAssertionExpectedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
