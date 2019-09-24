<?php

namespace webignition\BasilModel\Tests\Unit\Exception;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Value\PageElementReference;

class InvalidAssertionExaminedValueExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new PageElementReference(
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $exception = new InvalidAssertionExaminedValueException($value);

        $this->assertSame($value, $exception->getValue());
    }
}
