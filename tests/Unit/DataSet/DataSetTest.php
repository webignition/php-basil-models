<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\DataSet;

use webignition\BasilModel\DataSet\DataSet;
use webignition\BasilModel\DataSet\DataSetInterface;

class DataSetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getParameterValueDataProvider
     */
    public function testGetParameterValue(
        array $data,
        string $parameterName,
        ?string $expectedParameterValue
    ) {
        $dataSet = new DataSet('0', $data);

        $this->assertSame($expectedParameterValue, $dataSet->getParameterValue($parameterName));
    }

    public function getParameterValueDataProvider(): array
    {
        return [
            'parameter name not present' => [
                'data' => [],
                'parameterName' => 'example',
                'expectedParameterValue' => null,
            ],
            'parameter name present, is string' => [
                'data' => [
                    'example' => 'value',
                ],
                'parameterName' => 'example',
                'expectedParameterValue' => 'value',
            ],
            'parameter name present, is int' => [
                'data' => [
                    'example' => 15,
                ],
                'parameterName' => 'example',
                'expectedParameterValue' => '15',
            ],
        ];
    }

    /**
     * @dataProvider getParameterNamesDataProvider
     */
    public function testGetParameterNames(array $data, array $expectedParameterNames)
    {
        $dataSet = new DataSet('0', $data);

        $this->assertSame($expectedParameterNames, $dataSet->getParameterNames());
    }

    public function getParameterNamesDataProvider()
    {
        return [
            'empty' => [
                'data' => [],
                'expectedParameterNames' => [],
            ],
            'non-empty' => [
                'data' => [
                    '1' => 'value for one',
                    '2' => 'value for two',
                    'three' => 'value for three',
                ],
                'expectedParameterNames' => [
                    '1',
                    '2',
                    'three',
                ],
            ],
            'names are sorted' => [
                'data' => [
                    'bear' => 'like a large dog',
                    'zebra' => 'stripey horse',
                    'aardvark' => 'first animal in the alphabet',
                ],
                'expectedParameterNames' => [
                    'aardvark',
                    'bear',
                    'zebra',
                ],
            ],
        ];
    }

    /**
     * @dataProvider hasParameterNamesDataProvider
     */
    public function testHasParameterNames(
        DataSetInterface $dataSet,
        array $parameterNames,
        bool $expectedHasParameterNames
    ) {
        $this->assertSame($expectedHasParameterNames, $dataSet->hasParameterNames($parameterNames));
    }

    public function hasParameterNamesDataProvider(): array
    {
        return [
            'empty data set, empty parameter names' => [
                'dataSet' => new DataSet('0', []),
                'parameterNames' => [],
                'expectedHasParameterNames' => true,
            ],
            'empty data set, non-empty parameter names' => [
                'dataSet' => new DataSet('0', []),
                'parameterNames' => [
                    'foo',
                ],
                'expectedHasParameterNames' => false,
            ],
            'non-empty data set, no matching parameter names' => [
                'dataSet' => new DataSet(
                    '0',
                    [
                        'key1' => 'value1',
                        'key2' => 'value2',
                        'key3' => 'value3',
                    ]
                ),
                'parameterNames' => [
                    'key4',
                    'key5',
                ],
                'expectedHasParameterNames' => false,
            ],
            'has parameter names' => [
                'dataSet' => new DataSet(
                    '0',
                    [
                        'key1' => 'value1',
                        'key2' => 'value2',
                        'key3' => 'value3',
                    ]
                ),
                'parameterNames' => [
                    'key1',
                    'key2',
                ],
                'expectedHasParameterNames' => true,
            ],
        ];
    }

    /**
     * @dataProvider getNameDataProvider
     */
    public function testGetName(string $name)
    {
        $dataSet = new DataSet($name, []);

        $this->assertSame($name, $dataSet->getName());
    }

    public function getNameDataProvider(): array
    {
        return [
            'integer string' => [
                'name' => '0',
            ],
            'alpha string' => [
                'name' => 'data set 1',
            ],
        ];
    }
}
