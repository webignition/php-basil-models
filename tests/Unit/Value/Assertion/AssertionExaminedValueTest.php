<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;
use webignition\BasilModel\Tests\DataProvider\AssertionExaminedValueDataProviderTrait;
use webignition\BasilModel\Value\Assertion\AssertionExaminedValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class AssertionExaminedValueTest extends \PHPUnit\Framework\TestCase
{
    use AssertionExaminedValueDataProviderTrait;

    /**
     * @dataProvider assertionExaminedValueDataProvider
     */
    public function testCreate(ValueInterface $value)
    {
        $assertionExaminedValue = new AssertionExaminedValue($value);

        $this->assertSame($value, $assertionExaminedValue->getExaminedValue());
        $this->assertSame($value->isEmpty(), $assertionExaminedValue->isEmpty());
        $this->assertSame($value->isActionable(), $assertionExaminedValue->isActionable());
        $this->assertSame((string) $value, (string) $assertionExaminedValue);
    }

    public function testGetExaminedValueThrowsException()
    {
        $assertionExaminedValue = new AssertionExaminedValue(new LiteralValue('value'));

        $this->expectException(InvalidAssertionExaminedValueException::class);

        $assertionExaminedValue->getExaminedValue();
    }
}
