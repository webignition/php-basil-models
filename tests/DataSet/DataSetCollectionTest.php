<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\DataSet;

use webignition\BasilModel\DataSet\DataSet;
use webignition\BasilModel\DataSet\DataSetCollection;

class DataSetCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $dataSets, array $expectedDataSets)
    {
        $expectedCount = count($expectedDataSets);

        $dataSetCollection = new DataSetCollection($dataSets);

        $this->assertSame($expectedCount, count($dataSetCollection));

        foreach ($dataSetCollection as $dataSetIndex => $dataSet) {
            $expectedDataSet = $expectedDataSets[$dataSetIndex];

            $this->assertEquals($expectedDataSet, $dataSet);
        }
    }

    public function createDataProvider(): array
    {
        return [
            'empty' => [
                'dataSets' => [],
                'expectedDataSets' => [],
            ],
            'invalid items' => [
                'dataSets' => [
                    1,
                    true,
                    new \stdClass(),
                ],
                'expectedDataSets' => [],
            ],
            'valid items, numerical indices' => [
                'dataSets' => [
                    0 => new DataSet(
                        '0',
                        [
                            'username' => 'user1',
                            'role' => 'user',
                        ]
                    ),
                    1 => new DataSet(
                        '1',
                        [
                            'username' => 'user2',
                            'role' => 'admin',
                        ]
                    ),
                ],
                'expectedDataSets' => [
                    new DataSet(
                        '0',
                        [
                            'username' => 'user1',
                            'role' => 'user',
                        ]
                    ),
                    new DataSet(
                        '1',
                        [
                            'username' => 'user2',
                            'role' => 'admin',
                        ]
                    ),
                ],
            ],
            'valid items, string indices' => [
                'dataSets' => [
                    'set1' => new DataSet(
                        'set1',
                        [
                            'username' => 'user1',
                            'role' => 'user',
                        ]
                    ),
                    'set2' => new DataSet(
                        'set2',
                        [
                            'username' => 'user2',
                            'role' => 'admin',
                        ]
                    ),
                ],
                'expectedDataSets' => [
                    new DataSet(
                        'set1',
                        [
                            'username' => 'user1',
                            'role' => 'user',
                        ]
                    ),
                    new DataSet(
                        'set2',
                        [
                            'username' => 'user2',
                            'role' => 'admin',
                        ]
                    ),
                ],
            ],
        ];
    }

    public function testFromArray()
    {
        $dataSetCollection = DataSetCollection::fromArray([
            1,
            [
                'foo' => 'bar',
            ],
            'string',
            new \stdClass(),
        ]);

        $this->assertEquals(
            new DataSetCollection([
                1 => new DataSet(
                    '1',
                    [
                        'foo' => 'bar',
                    ]
                ),
            ]),
            $dataSetCollection
        );
    }
}
