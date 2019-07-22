<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\EnvironmentValue;
use webignition\BasilModel\Value\ValueTypes;

class EnvironmentValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $valueString,
        string $objectName,
        string $objectProperty,
        ?string $default,
        string $expectedString
    ) {
        $value = new EnvironmentValue($valueString, $objectName, $objectProperty, $default);

        $this->assertSame(ValueTypes::ENVIRONMENT_PARAMETER, $value->getType());
        $this->assertSame($valueString, $value->getValue());
        $this->assertSame($objectName, $value->getObjectName());
        $this->assertSame($objectProperty, $value->getObjectProperty());
        $this->assertSame($default, $value->getDefault());
        $this->assertSame($expectedString, (string) $value);
    }

    public function createDataProvider(): array
    {
        return [
            'no default' => [
                'valueString' => '$env.KEY',
                'objectName' => 'env',
                'objectProperty' => 'KEY',
                'default' => null,
                'expectedString' => '$env.KEY',
            ],
            'has default' => [
                'valueString' => '$env.KEY',
                'objectName' => 'env',
                'objectProperty' => 'KEY',
                'default' => 'default_value',
                'expectedString' => '$env.KEY|"default_value"',
            ],
            'default contains double quotes' => [
                'valueString' => '$env.KEY',
                'objectName' => 'env',
                'objectProperty' => 'KEY',
                'default' => '"default"',
                'expectedString' => '$env.KEY|"\"default\""',
            ],
        ];
    }
}