<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Tests\DataProvider\Assertion\AssertableExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\Assertion\AssertableExpectedValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ValueInterface;

class AssertableExpectedValueTest extends \PHPUnit\Framework\TestCase
{
    use AssertableExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertableExaminedValueDataProvider
     * @dataProvider createSuccessDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new AssertableExpectedValue($value);

        $this->assertSame($value, $assertionExaminedValue->getExpectedValue());
        $this->assertSame($value->isEmpty(), $assertionExaminedValue->isEmpty());
        $this->assertSame($value->isActionable(), $assertionExaminedValue->isActionable());
        $this->assertSame((string) $value, (string) $assertionExaminedValue);
    }

    public function createSuccessDataProvider(): array
    {
        return [
            'literal value' => [
                'value' => new LiteralValue('value'),
            ],
        ];
    }


    public function testGetExpectedValueThrowsException()
    {
        $assertionExpectedValue = new AssertableExpectedValue(
            new PageElementReference(
                'page_import_name.elements.element_name',
                'page_import_name',
                'element_name'
            )
        );

        $this->expectException(InvalidAssertableExpectedValueException::class);

        $assertionExpectedValue->getExpectedValue();
    }
}
