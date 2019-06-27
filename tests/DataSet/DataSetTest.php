<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\DataSet;

use webignition\BasilModel\DataSet\DataSet;
use webignition\BasilModel\DataSet\DataSetInterface;

class DataSetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getParameterValueDataProvider
     */
    public function testGetParameterValue(
        DataSetInterface $dataSet,
        string $parameterName,
        ?string $expectedParameterValue
    ) {
        $this->assertSame($expectedParameterValue, $dataSet->getParameterValue($parameterName));
    }

    public function getParameterValueDataProvider(): array
    {
        return [
            'parameter name not present' => [
                'dataSet' => new DataSet([]),
                'parameterName' => 'example',
                'expectedParameterValue' => null,
            ],
            'parameter name present, is string' => [
                'dataSet' => new DataSet([
                    'example' => 'value',
                ]),
                'parameterName' => 'example',
                'expectedParameterValue' => 'value',
            ],
            'parameter name present, is int' => [
                'dataSet' => new DataSet([
                    'example' => 15,
                ]),
                'parameterName' => 'example',
                'expectedParameterValue' => '15',
            ],
        ];
    }

    /**
     * @dataProvider getParameterNamesDataProvider
     */
    public function testGetParameterNames(DataSetInterface $dataSet, array $expectedParameterNames)
    {
        $this->assertSame($expectedParameterNames, $dataSet->getParameterNames());
    }

    public function getParameterNamesDataProvider()
    {
        return [
            'empty' => [
                'dataSet' => new DataSet([]),
                'expectedParameterNames' => [],
            ],
            'non-empty' => [
                'dataSet' => new DataSet([
                    '1' => 'value for one',
                    '2' => 'value for two',
                    'three' => 'value for three',
                ]),
                'expectedParameterNames' => [
                    '1',
                    '2',
                    'three',
                ],
            ],
        ];
    }
}
