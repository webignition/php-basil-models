<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Tests\DataProvider\AssertionExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\AssertionExpectedValue;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class AssertionExpectedValueTest extends \PHPUnit\Framework\TestCase
{
    use AssertionExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertionExaminedValueDataProvider
     * @dataProvider createSuccessDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new AssertionExpectedValue($value);

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
        $assertionExpectedValue = new AssertionExpectedValue(
            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
        );

        $this->expectException(InvalidAssertionExpectedValueException::class);

        $assertionExpectedValue->getExpectedValue();
    }
}
