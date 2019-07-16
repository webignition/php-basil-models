<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\DataSet;

use webignition\BasilModel\DataSet\DataSet;

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
        $dataSet = new DataSet($data);

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
        $dataSet = new DataSet($data);

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
}
