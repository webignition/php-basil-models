<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Tests\DataProvider\Assertion\ExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\Assertion\ExpectedValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ValueInterface;

class ExpectedValueTest extends \PHPUnit\Framework\TestCase
{
    use ExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertionExaminedValueDataProvider
     * @dataProvider createSuccessDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new ExpectedValue($value);

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
        $assertionExpectedValue = new ExpectedValue(
            new ExpectedValue(
                new PageElementReference(
                    'page_import_name.elements.element_name',
                    'page_import_name',
                    'element_name'
                )
            )
        );

        $this->expectException(InvalidAssertionExpectedValueException::class);

        $assertionExpectedValue->getExpectedValue();
    }
}
