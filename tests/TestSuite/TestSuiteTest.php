<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\TestSuite;

use webignition\BasilModel\Test\Configuration;
use webignition\BasilModel\Test\Test;
use webignition\BasilModel\TestSuite\TestSuite;

class TestSuiteTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $name, array $tests, array $expectedTests)
    {
        $testSuite = new TestSuite($name, $tests);

        $this->assertSame($name, $testSuite->getName());
        $this->assertSame($expectedTests, $testSuite->getTests());
    }

    public function createDataProvider()
    {
        $testOne = new Test(
            'test one',
            new Configuration('chrome', 'http://example.com/one'),
            []
        );

        $testTwo = new Test(
            'test two',
            new Configuration('chrome', 'http://example.com/two'),
            []
        );

        return [
            'no tests' => [
                'name' => 'no tests',
                'tests' => [],
                'expectedTests' => [],
            ],
            'non-test tests' => [
                'name' => 'non-test tests',
                'tests' => [
                    1,
                    true,
                    'string',
                ],
                'expectedTests' => [],
            ],
            'has tests' => [
                'name' => 'has tests',
                'tests' => [
                    $testOne,
                    $testTwo,
                ],
                'expectedTests' => [
                    $testOne,
                    $testTwo,
                ],
            ],
        ];
    }
}
