<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Tests\DataProvider\Assertion\ExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\Assertion\ExaminedValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class ExaminedValueTest extends \PHPUnit\Framework\TestCase
{
    use ExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertionExaminedValueDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new ExaminedValue($value);

        $this->assertSame($value, $assertionExaminedValue->getExaminedValue());
        $this->assertSame($value->isEmpty(), $assertionExaminedValue->isEmpty());
        $this->assertSame($value->isActionable(), $assertionExaminedValue->isActionable());
        $this->assertSame((string) $value, (string) $assertionExaminedValue);
    }

    public function testGetExaminedValueThrowsException()
    {
        $assertionExaminedValue = new ExaminedValue(new LiteralValue('value'));

        $this->expectException(InvalidAssertionExaminedValueException::class);

        $assertionExaminedValue->getExaminedValue();
    }
}
