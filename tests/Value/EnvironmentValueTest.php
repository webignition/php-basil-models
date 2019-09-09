<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\EnvironmentValue;

class EnvironmentValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $reference, string $objectProperty, ?string $default)
    {
        $value = new EnvironmentValue($reference, $objectProperty, $default);

        $this->assertSame($reference, $value->getReference());
        $this->assertSame($objectProperty, $value->getProperty());
        $this->assertSame($default, $value->getDefault());
        $this->assertSame($reference, (string) $value);
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
    }

    public function createDataProvider(): array
    {
        return [
            'no default' => [
                'reference' => '$env.KEY',
                'objectProperty' => 'KEY',
                'default' => null
            ],
            'has default' => [
                'reference' => '$env.KEY|"default_value"',
                'objectProperty' => 'KEY',
                'default' => 'default_value'
            ],
            'default contains double quotes' => [
                'reference' => '$env.KEY|"\"default\""',
                'objectProperty' => 'KEY',
                'default' => '"default"'
            ],
        ];
    }
}
