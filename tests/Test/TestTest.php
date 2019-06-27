<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Test;

use webignition\BasilModel\Step\Step;
use webignition\BasilModel\Test\Configuration;
use webignition\BasilModel\Test\Test;
use webignition\BasilModel\Test\TestInterface;

class TestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $name, Configuration $configuration, array $steps, TestInterface $expectedTest)
    {
        $test = new Test($name, $configuration, $steps);

        $this->assertEquals($expectedTest, $test);
    }

    public function createDataProvider()
    {
        return [
            'no steps' => [
                'name' => 'no steps',
                'configuration' => new Configuration('chrome', 'http://example.com'),
                'steps' => [],
                'expectedTest' => new Test(
                    'no steps',
                    new Configuration('chrome', 'http://example.com'),
                    []
                ),
            ],
            'invalid steps' => [
                'name' => 'invalid steps',
                'configuration' => new Configuration('chrome', 'http://example.com'),
                'steps' => [
                    1,
                    'foo',
                ],
                'expectedTest' => new Test(
                    'invalid steps',
                    new Configuration('chrome', 'http://example.com'),
                    []
                ),
            ],
            'has steps' => [
                'name' => 'has steps',
                'configuration' => new Configuration('chrome', 'http://example.com'),
                'steps' => [
                    new Step([], []),
                ],
                'expectedTest' => new Test(
                    'has steps',
                    new Configuration('chrome', 'http://example.com'),
                    [
                        new Step([], []),
                    ]
                ),
            ],
        ];
    }
}
