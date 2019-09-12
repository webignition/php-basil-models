<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExaminedValueException;
use webignition\BasilModel\Tests\DataProvider\Assertion\AssertableExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\Assertion\AssertableExaminedValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class AssertableExaminedValueTest extends \PHPUnit\Framework\TestCase
{
    use AssertableExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertableExaminedValueDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new AssertableExaminedValue($value);

        $this->assertSame($value, $assertionExaminedValue->getExaminedValue());
        $this->assertSame($value->isEmpty(), $assertionExaminedValue->isEmpty());
        $this->assertSame($value->isActionable(), $assertionExaminedValue->isActionable());
        $this->assertSame((string) $value, (string) $assertionExaminedValue);
    }

    public function testGetExaminedValueThrowsException()
    {
        $assertionExaminedValue = new AssertableExaminedValue(new LiteralValue('value'));

        $this->expectException(InvalidAssertableExaminedValueException::class);

        $assertionExaminedValue->getExaminedValue();
    }
}
